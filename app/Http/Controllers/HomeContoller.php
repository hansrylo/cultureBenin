<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeContoller extends Controller
{
    //
    function edit($id){
        return view('langues.welcome' ,compact('id'));
    }

}    

