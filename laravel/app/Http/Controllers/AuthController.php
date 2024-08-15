<?php

namespace App\Http\Controllers;

use App\Traits\HttpsResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

# Token - "" - User
# Token - "27|3JGISUDR5IBei2oGaRsmq65iBzerLWZ6MOooEpqf0373aef3" - Teste index

class AuthController extends Controller
{
    use HttpsResponses;
    public function login(Request $request) {

        if(Auth::attempt($request->only('email','password'))) {
            return $this->response('Autorizado', 200, [
                'token' => $request->user()->createToken('user', ['user-index'])->plainTextToken
                // depois do 'user', da para passar o nome que eu quiser, é o que o usuário vai poder fazer
            ]);
            //  vai retornar o token, a data de expiração dele, id do token, qnd foi criado, etc..
            // o principal: 			"plainTextToken": "1|kSwE81SG3sfGmmGONPE94jcjni46X2BYLHVqcjnq3dd35ae1"
        }
        return $this->response('Não Autorizado', 403);
        
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        
        return $this->response('Token Revogado',200);
    }
}
