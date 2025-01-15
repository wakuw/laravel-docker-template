<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

use App\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        //$todo = new Todo();
        //$todos = $todo->all();
        $todo = $this->todo->all();

        return view('todo.index', ['okabe' => $todo]); //②第一引数をtest.indexにするには？③変数名「okabe」で一覧表示
    }                             //↑こっちは送る先で使用する変数の名前

    public function create()
    {
        return view('todo.create',);
    }

    //↓メゾットインジェクション：$request = new Request();を行っている
    public function store(TodoRequest $request) //①代入されている値＋データ型調べる→object型ならnamespaceとクラス名
    {
        $inputs = $request->all();

        // $todo = new Todo();
        // $todo->fill($inputs); //再追加課題：39行目前後の$todoの違い確認
        // $todo->save();

        $this->todo->fill($inputs);
        $this->todo->save();

        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();

        return redirect()->route('todo.index');
    }
}