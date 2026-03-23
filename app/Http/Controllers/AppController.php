<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AppController extends Controller
{
    // LOGIN PAGE
    public function loginPage() {
        return view('login');
    }

    // LOGIN
    public function login(Request $req) {

        $user = DB::table('users')->where('email', $req->email)->first();

        if ($user && Hash::check($req->password, $user->password)) {

            Session::put('user', $user->name);
            Session::put('role', $user->role);
            Session::put('user_id', $user->id);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    // REGISTER PAGE
    public function registerPage() {
        return view('register');
    }

    // REGISTER
    public function register(Request $req) {

        $check = DB::table('users')->where('email', $req->email)->first();

        if ($check) {
            return back()->with('error', 'Email already exists');
        }

        DB::table('users')->insert([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'role' => 'user'
        ]);

        // 🔥 MAIL SEND
        Mail::raw('Welcome! Your account has been created successfully.', function ($msg) use ($req) {
            $msg->to($req->email)
                ->subject('Registration Successful');
        });

        return redirect('/login')->with('success', 'Registered successfully! Mail sent.');
    }

    // DASHBOARD
    public function dashboard() {

        if (!Session::has('user')) {
            return redirect('/login');
        }

        $role = Session::get('role');
        $user_id = Session::get('user_id');

        if ($role == 'admin') {
            $items = DB::select("SELECT * FROM items ORDER BY position ASC");
        } else {
            $items = DB::select("SELECT * FROM items WHERE user_id=? ORDER BY position ASC", [$user_id]);
        }

        return view('dashboard', compact('items'));
    }

    // ADD ITEM
    public function addItem(Request $req) {

        if (!$req->hasFile('image')) {
            return back()->with('error', 'Image required');
        }

        $file = $req->file('image');
        $name = time().'_'.$file->getClientOriginalName();

        $path = public_path('uploads');

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $file->move($path, $name);

        DB::table('items')->insert([
            'name' => $req->name,
            'position' => $req->position,
            'image' => $name,
            'user_id' => Session::get('user_id')
        ]);

        return redirect('/dashboard');
    }

    // DELETE ITEM
    public function deleteItem(Request $req) {

        if (Session::get('role') == 'admin') {
            DB::table('items')->where('id', $req->id)->delete();
        }

        return redirect('/dashboard');
    }

    // ADMIN
    public function admin()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        if (Session::get('role') != 'admin') {
            return redirect('/dashboard')->with('error', 'Access Denied');
        }

        return view('admin');
    }

    // MANAGER
    public function manager()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        if (!in_array(Session::get('role'), ['admin', 'manager'])) {
            return redirect('/dashboard')->with('error', 'Access Denied');
        }

        return view('manager');
    }

    // USER
    public function user()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        return view('user');
    }

    // LOGOUT
    public function logout() {
        Session::flush();
        return redirect('/login');
    }
}