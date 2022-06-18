<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function review()
    {
        $reviews = new Contact();
        $reviews = DB::table('contacts')->orderBy('created_at', 'desc')->get();
        return view('review', ['reviews' => $reviews->all()]);

    }

    public function review_check(Request $request)
    {
        $valid = $request->validate([
            
            'subject' => 'required|min:4|max:100',
            'message' => 'required|min:15|max:500',
        ]);
        $review = new Contact();
      
        $review->subject = $request->input('subject');
        $review->message = $request->input('message');
        $review->user = Auth::user()->name;
        $review->save();

        return redirect()->route('review');
    }

}