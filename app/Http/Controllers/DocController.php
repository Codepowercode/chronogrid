<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexFrontend()
    {
        return view('doc.app-frontend');
    }

    public function indexBackend()
    {
        return view('doc.app-backend');
    }

    public function downloadPostMan()
    {
        return 1;
    }

    public function home()
    {
        return view('home');
    }


    public function getToken()
    {
        return response()->json(csrf_token(), 200);
    }


}
