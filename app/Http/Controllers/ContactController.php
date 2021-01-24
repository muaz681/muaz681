<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Storage;

class ContactController extends Controller
{
    function index(){
      $contacts = Contact::all();
      return view('contact.index', compact('contacts'));
    }
    function contactdownload($file_name){
      return Storage::download("contact_file/".$file_name);
    }
}
