<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        
        $systemMsg = session()->pull('system_message');
        
        return view('front.contact.index',[
            'system_message' => $systemMsg
        ]);
        
    }
    
    public function sendMessage(Request $request) 
    {
        
        $formData = $request->validate([
            'contact_person' => ['required','string','min:5','max:255'],
            'contact_email' => ['required','email','max:255'],
            'contact_message' => ['required','string','min:50','max:500'],
            'g-recaptcha-response' => ['required'],
        ]);
        
        
        \Mail::to('pedjakisic@gmail.com')->send(new ContactFormMail(
                $formData['contact_person'],
                $formData['contact_email'],
                $formData['contact_message']
        ));
        
        session()->flash(
        'system_message',
        __('Your message has been sent!'),
        );
        
        return redirect()->back();
        
    }
}
