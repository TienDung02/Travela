<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactManagementController extends Controller
{
    public function index()
    {
        return view('backend.admin-contact.index', [
           
        ]);
    }

  
    
}
