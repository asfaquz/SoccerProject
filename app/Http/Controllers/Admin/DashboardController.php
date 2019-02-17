<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends Controller {

    /**
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request) {
        return view('dashboard.index');
    }

}
