<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function aboutUs()
    {
        
        return view('front.pages.about_us',[
            
        ]);
        
    }
    
    public function terms()
    {
        return view('front.pages.terms',[
            
        ]);
    }
}
