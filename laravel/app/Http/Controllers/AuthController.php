<?php

namespace App\Http\Controllers;

use App\Traits\HttpsResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Token - "6|sjRlcxWMxUoMrF7dVjdUE8uMzpUgKB1zgMuPI1KM5c535d17" - User
# Token - "7|mtd4WTFyY1ublTZ4cjxh0y2e87unAmfiRy77L3Rx08993f36" - Teste index

class AuthController extends Controller
{
    use HttpsResponses;
    public function login(Request $request) {

        if(Auth::attempt($request->only('email','password'))) {
            return $this->response('Autorizado', 200, [
                'token' => $request->user()->createToken('user', ['teste-index'])->plainTextToken
                // depois do 'user', da para passar o nome que eu quiser, é o que o usuário vai poder fazer
            ]);
            //  vai retornar o token, a data de expiração dele, id do token, qnd foi criado, etc..
            // o principal: 			"plainTextToken": "1|kSwE81SG3sfGmmGONPE94jcjni46X2BYLHVqcjnq3dd35ae1"
        }
        return $this->response('Não Autorizado', 403);
        
    }

    public function logout() {

    }
}
