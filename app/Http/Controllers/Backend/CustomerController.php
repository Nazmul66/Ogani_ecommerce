<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function manage()
    {
        $customers = DB::table("users")->where('status', 1)->get();
        return view('backend.pages.customer.manage', compact('customers'));
    }
}
