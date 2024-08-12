<?php

namespace App\Http\Controllers;

use App\Traits\HttpsResponses;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    use HttpsResponses;
    public function index() {
        return $this->response('Autorizado',200);
    }

    public function store() {

    }
}
