<?php

namespace App\Http\Controllers\client\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(){
        return response()->json([
            'name'=>'Huỳnh Như',
            'phone_number'=>'0987654321',
            'email'=>'hnhui.nguyen@gmail.com'
        ]);
    }
}
