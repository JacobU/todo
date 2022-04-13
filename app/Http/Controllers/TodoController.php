<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{

    public function single($id) {
        $todo = Todo::findOrFail($id);
        return response($todo, 200);
    }

    public function list() {
        $all_todos = Todo::all();
        return response($all_todos, 200);
    }

    public function add(Request $request) {
        // Not sure why Lavarel's validator doesnt work for booleans
        // but don't wanna waste my time with this lame framework
        $this->checkBoolean($request);
        
        $single_todo = Todo::create([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_complete' => $request->is_complete,
        ]);
        return response($single_todo, 201);
    }

    public function edit(Request $request, $id) {
        $this->checkBoolean($request);

        $updated_todo = Todo::findOrFail($id);

        Todo::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_complete' => $request->is_complete,
        ]);
        return response($updated_todo, 201);
    }

    public function delete($id) {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response($todo, 200);
    }

    private function checkBoolean(Request $request) {
        if($request->is_complete == 'false') {
            $request->is_complete = 0;
        } else {
            $request->is_complete = 1;
        }
    }
}
