<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    protected function validar(Request $request, $iduser = null)
    {
        $rules = [
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email' . ($iduser ? ",$iduser" : ''),
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if (!$iduser || $request->password) { 
            $rules['password'] = 'required|min:8';
        }

        $messages = [
            'nome.required' => 'O nome é um campo obrigatório.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
            
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Forneça um endereço de e-mail válido.',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',
            'email.unique' => 'Este e-mail já está registrado. Escolha outro.',
            
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',

            'profile_photo.image' => 'O arquivo deve ser uma imagem válida.',
            'profile_photo.mimes' => 'O formato da imagem deve ser jpeg, png, jpg, gif ou svg.',
            'profile_photo.max' => 'O tamanho da imagem não deve ultrapassar 2MB.'
        ];

        $request->validate($rules, $messages);
    }

    public function index()
    {
        $user = Auth::user();
        if($user->tipo_usuario == 1){
            return $this->edit($user->id);
        }
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validar($request);
        
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);  // Criptografando a senha
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('img/users/'), $filename);
            $user->profile_photo_path = $filename;
        }        
        $user->tipo_usuario = $request->tipo_usuario ?? 1;
        $user->save();

        return redirect('/users');
    }



    public function edit($iduser)
    {
        if (Auth::id() != $iduser && Auth::user()->tipo_usuario !== 2) {
            abort(403, 'Ação não autorizada.');
        }

        $user = User::find($iduser);
        return view('users.edit', ['user' => $user]);
    }


    public function update(Request $request, $iduser)
    {
        $this->validar($request, $iduser);
        $user = User::findOrFail($iduser);

        // Deleta a imagem antiga se houver uma nova imagem sendo enviada
        if ($user->profile_photo_path && file_exists(public_path($user->profile_photo_path))) {
            unlink(public_path($user->profile_photo_path));
        }

        $user->name = $request->nome;
        $user->email = $request->email;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);  // Criptografando a senha
        }
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('img/users/'), $filename);
            $user->profile_photo_path = $filename;
        }
             
        $user->tipo_usuario =  $request->tipo_usuario ?? 1;
        $user->save();

        return redirect('/users');
    }

}
