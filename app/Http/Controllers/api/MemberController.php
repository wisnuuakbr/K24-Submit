<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\Member;

class MemberController extends Controller
{
    public function index()
    {
        // get data only role member
        $data = Member::where('role', 'member')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ]);
    }
}