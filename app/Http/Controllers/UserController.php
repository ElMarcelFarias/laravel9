<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $user){
        $this->model = $user;
    }

    public function index(Request $request) {


        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();
        $search = $request->search;
        $users = $this->model->getUsers(search: $request->search ?? '');



        //$users = $this->model->get(); //lista de todos os usuários
        

        // return view('users.index', [
        //     'users' => $users
        // ]); //podemos passar assim ou 

        return view('users.index', compact('users'));
    }

    public function show($id) {

        //recuperar o usuário pelo id
        //Primeira forma
        //$user = $this->model->where('id', $id)->first(); //->get() me retorna uma collection, ou seja um array. 
                                                //Eu necessito que me retorne um objeto daquele usuário, nao um array, entao utilizamos o first()

        if(!$user = $this->model->find($id)) {
            return redirect()->route('users.index');
        }
        
        return view('users.show', compact('user'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(StoreUpdateFormRequest $request) {
        //$request->all();
        // $request->only([
        //     'name', 'email', 'password'
        // ]);

        //controller tem que ser simples, n pode ter lógica


        $data = $request->all();
        $data['password'] = bcrypt($request->password);


        //dd($request->image);

        if($request->image) {
            $path = $request->image->store('users');
            $data['image'] = $path;

            //$extension = $request->image->getClientOriginalExtension();
            //$data['image'] = $request->image->storeAs('users', now(). ".{$extension}");
        }

        $user = $this->model->create($data);

        return redirect()->route('users.index');
        //return redirect()->route('users.show', $user->id);

        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
    }

    public function edit($id) {
        if(!$user = $this->model->find($id)) {
            return redirect()->route('users.index');
        }

        return view('users.edit', compact('user'));
    }


    public function update(StoreUpdateFormRequest $request, $id) {
        if(!$user = $this->model->find($id)) {
            return redirect()->route('users.index');
        }
        //$data = $request->all();
        $data = $request->only('name', 'email');
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if($request->image) {

            if($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            } //deletar a imagem antiga

            $path = $request->image->store('users');
            $data['image'] = $path;

            //mudar a imagem

            //$extension = $request->image->getClientOriginalExtension();
            //$data['image'] = $request->image->storeAs('users', now(). ".{$extension}");
        }
        

        $user->update($data);

        return redirect()->route('users.index');

        //$user->update($request->all());

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();

        //dd($request->all());
    }

    public function destroy($id) {
        if(!$user = $this->model->find($id)) {
            return redirect()->route('users.index');
        }

        $user->delete();

        return redirect()->route('users.index');

    }

}
