<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # Retorna somente os usuários, sem seus dados relacionados:
        return User::all();

        # Retorna todos os usuários (com os campos que eu quero) + os relacionados (student e teacher)
        // return User::select('id', 'name', 'email')
        // ->with(['student', 'teacher'])
        // ->get();

        # Retorna todos os usuários com seus dados relacionados (student e teacher)
        // return User::with(['student', 'teacher'])->get();
    }

    public function store(Request $request)
    {
        // Valida os dados de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type' => 'required|in:student,teacher',
        ]);

        // Criptografa a senha
        $validated['password'] = bcrypt($validated['password']);

        // Cria um novo usuário
        $user = User::create($validated);

        // Retorna o usuário criado com status 201 - Criado com Sucesso
        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'user' => $user,
        ], 201);
        
    }

    public function show(User $user)
    {
        // Carrega o usuário com os dados relacionados (student e teacher)
        return $user->load(['student', 'teacher']);
    }

    public function update(Request $request, User $user)
    {
        // Valida os dados de entrada para a atualização
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'string|min:8',
            'type' => 'in:student,teacher',
        ]);

        // Criptografa a nova senha, se fornecida
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // Atualiza o usuário
        $user->update($validated);

        // Retorna o usuário editado com status 200 - Editado com Sucesso
        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user,
        ], 200);
    }

    public function destroy(User $user)
    {
        // Salva o nome do usuário antes de deletá-lo
        $userName = $user->name;
    
        // Exclui o usuário
        $user->delete();
        
        // Retorna uma mensagem personalizada com o nome do usuário deletado
        return response()->json([
            'message' => "Usuário $userName deletado com sucesso!",
        ], 200);
    }    
}
