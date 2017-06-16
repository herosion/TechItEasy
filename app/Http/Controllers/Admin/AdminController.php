<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	/*
	 * The main application page 
	 */
    public function dashboard()
    {
    	$data = [
            'page' => "dashboard",
        ];
        return view('admin.dashboard', $data);
    }
    
}
