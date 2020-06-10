<?php

namespace App\Http\Controllers;
use App\Status;

class WelcomeController extends Controller {
    public function index() {
        
        $status = Status::orderBy('id', 'desc')->get();

        return view( 'public', ['status' => $status] );
    }
}
