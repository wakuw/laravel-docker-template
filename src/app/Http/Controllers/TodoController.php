<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        $todos = $todo->all();

        return view('todo.index', ['okabe' => $todos]); //②第一引数をtest.indexにするには？③変数名「okabe」で一覧表示
    }                             //↑こっちは送る先で使用する変数の名前

    public function create()
    {
        return view('todo.create',);
    }

    public function store(Request $request) //①代入されている値＋データ型調べる→object型ならnamespaceとクラス名
    {
        dd($request);
        $inputs = $request->all();

        $todo = new Todo();
        $todo->user_id = Auth::id();
        $todo->fill($inputs);
        $todo->save();

        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        $model = new Todo();
        $todo = $model->find($id);

        return view('todo.show', ['todo' => $todo]);
    }
}