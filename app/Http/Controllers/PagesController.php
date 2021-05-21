<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * @group  returning static pages
 *
 */
class PagesController extends Controller
{
    //
    /**
    * return the home view
    *  <br>
    *  route : route('home'),
    *  the index blade /resources/views/StaticPages/home.blade.php --> add your component their
    */
    public function home(){
        return view('FrontPreview.StaticPages.home')
    }
    /**
    * return the services view
    *  <br>
    *  route : route('services'),
    *  the index blade /resources/views/StaticPages/services.blade.php --> add your component their
    */
    public function services(){
        return view('FrontPreview.StaticPages.services');
    }
    /**
    * return the about view
    *  <br>
    *  route : route('about'),
    *  the index blade /resources/views/StaticPages/about.blade.php --> add your component their
    */
    public function about(){
        return view('FrontPreview.StaticPages.about');
    }
    /**
    * return the contact view
    *  <br>
    *  route : route('contact'),
    *  the index blade /resources/views/StaticPages/contactUs.blade.php --> add your component their
    */
    public function contactUs(){
        return view('FrontPreview.StaticPages.contactUs');
    }
}
