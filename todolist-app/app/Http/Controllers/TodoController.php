<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', [
            'datas' => Todo::latest()->get(),
            'uncompleteDatas' => Todo::where('status', 0)->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Todo::create([
            'title' => $request->input('title')
        ]);
        return redirect('/')->with('storeTodo', 'Berhasil Menambah Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return redirect('/')->with('updateTodo', "Berhasil Update Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        Todo::destroy($todo->id);
        return redirect('/')->with('deleteTodo', 'Berhasil Menghapus Data');
    }

    public function complete($id)
    {
        $todo = Todo::find($id);
        $todo->update([
            'status' => 1
        ]);
        return redirect('/')->with('completeTodo', 'Berhasil Update Data');
    }
}
