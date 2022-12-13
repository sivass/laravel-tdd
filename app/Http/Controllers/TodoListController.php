<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    //
    public function index(){

        $list = TodoList::all();

        return response()->json($list);
    }

    public function show(TodoList $todoList){

        // $list = TodoList::find($id);  // We use route binding model controller method

        return response()->json($todoList);
    }
    public function store(Request $request){
        $request->validate(
            ['name' => ['required']]
        );
        $list = TodoList::create($request->all());
        return $list; //response($list, Response::HTTP_CREATED);
    }
}
