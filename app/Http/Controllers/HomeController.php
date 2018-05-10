<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\Contact;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use	Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('posts.index');
    }
    public function contact()
    {
        return view('contact');
    }
    public function send_mail(Request $request)
    {
        Mail::to(env('MAIL_ADMIN'))->send(new	Contact($request->message));
        return 'sending';
    }
}
