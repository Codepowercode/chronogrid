<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccessCodeMail;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
//        $data = [
//            'name' => 'David',
//            'email' => 'david656558a@gmail.com',
//            'code' => '5651651654513645',
//        ];
//        $model = new AccessCodeMail($data);
//        Mail::to($data['email'])->send($model);

        return view('backend.dashboard');
    }
}
