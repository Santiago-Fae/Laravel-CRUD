<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //filtra todos usuários
    public function index() {

        $listUsers = DB::table('users')
        ->get()
        ->where('exl', 0);

        return view('index', ['usuarios' => $listUsers]);

    }

    public function store(Request $request) {

        //verifica se usuário já existe, se sim atualiza, senão cria.
        if ($request->id) {
            return self::update($request);
        }
        else {
            return self::create($request);
        }

    }

    //cria usuário com verificações de campos
    public function create($request) {
        $user = New User;
        if (($msg = self::verifyNewUser($request->name, $request->email, $request->contact))) {
            return redirect('./user')->with('msgFalse', $msg);
        };

        $user->name = $request->name;
        $user->contact = preg_replace("/[^0-9]/", "", $request->contact);
        $user->email = $request->email;

        $user->save();
        
        return redirect('/')->with('msgTrue', "Usuário cadastrado com sucesso!");
    }

    //lê usuario
    public function read($id = false) {
        if (!$id) {
            return view('user');
        }

        $user = User::findOrFail($id);      
        return view('user', ['user' => $user]);
        
    }

    //deleta usuário lógicamente
    public function destroy($id) {
      $user = User::findOrFail($id);      
        $user->exl = 1;
        $user->save();
        
        //User::findOrFail($id)->delete();
        return redirect('/')->with('msgTrue', "Usuário apagado com sucesso!");
    }

    //atualiza
    public function update($request) {
        
        //TODO: Verificar porquê não salva alterações de contato utilizando o metodo comentado abaixo.
        //$user = User::findOrFail(intval($request->id))->update($request->all());   

        $user = User::findOrFail(intval($request->id));
        $user->name = $request->name;   
        $user->email = $request->email;   
        $user->contact = $request->contact;   
        $user->save();

        return redirect('/')->with('msgTrue', "Alterações do usuário salvas!");

    }

    //verifica campos
    public function verifyNewUser($name, $email, $contact) {
        //verifica se todos campos foram preenchidos
        if ($name && $email && $contact) {
            //verifica se já existem valores na tabela
            if (!DB::table('users')->where('email', $email)->where('exl', 0)->count() && !DB::table('users')->where('contact', $contact)->where('exl', 0)->count()) {
                //expressão regular para filtrar apenas números e verificar se tem apenas 9
                if (strlen(preg_replace("/[^0-9]/", "", $contact)) == 9) {
                    //verifica se nome tem mais de 5 letras
                    if (strlen($name) >= 5 ) {
                        return false;
                    }
                    return "Seu nome tem que conter mais de 5 letras!";
                }
                return "Seu celular tem que conter 9 numeros!";
            }
            return "Email ou celular já cadastrados!";
        }
        return "Preencha todos os campos!";
    }    

}
