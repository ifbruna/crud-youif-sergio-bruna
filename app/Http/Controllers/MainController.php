<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        return view("home-page");
    }

    public function newMedia() {
        return view('cadastro-midia');
    }

    public function viewMedia() {
        return view('midia-page');
    }

}





