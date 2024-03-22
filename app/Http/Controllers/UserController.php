<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {

        $users = User::get(); //lista de todos os usuários
        

        // return view('users.index', [
        //     'users' => $users
        // ]); //podemos passar assim ou 

        return view('users.index', compact('users'));
    }

    public function show($id) {

        //recuperar o usuário pelo id
        //Primeira forma
        //$user = User::where('id', $id)->first(); //->get() me retorna uma collection, ou seja um array. 
                                                //Eu necessito que me retorne um objeto daquele usuário, nao um array, entao utilizamos o first()

        if(!$user = User::find($id)) {
            return redirect()->route('users.index');
        }
        
        return view('users.show', compact('user'));
    }
}
