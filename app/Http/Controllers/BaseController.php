<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;


class BaseController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function response($status,$message,$code=200)
    {
        return response()->json([
            'success' => $status,
            'message' => $message
        ], $code);
    }
    //
}
