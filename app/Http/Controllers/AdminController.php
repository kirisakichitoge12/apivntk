<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   
    public function dashboard()
    {
        // truyền dữ liệu nếu cần
        return view('admin.dashboard');
    }
    public function viewhoadon()
    {
        return view("emails.email-invoid");
    }
}
