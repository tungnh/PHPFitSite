<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function error403()
    {
        return view('admin.errors.403');
    }
    
    public function error404()
    {
        return view('admin.errors.404');
    }
}
