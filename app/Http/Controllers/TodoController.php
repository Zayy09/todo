<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $todos = Todo::when($search, function ($query) use ($search) {
            $query->where('task', 'like', "%{$search}%");
        })->latest()->get();

        return view('todo.app', compact('todos'));
    }

    public function store(TodoRequest $request)
    {

        Todo::create([
            'task' => $request->task,
            'is_done' => false,
        ]);

        return redirect()->route('todo')
            ->with('success', 'Data todo berhasil ditambahkan!');
    }

    public function update(TodoRequest $request, string $id)
    {

        $todo = Todo::findOrFail($id);

        $todo->update([
            'task' => $request->task,
            'is_done' => $request->is_done ?? 0,
        ]);

        return redirect()->route('todo')
            ->with('success', 'Data todo berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return redirect()->route('todo')
            ->with('success', 'Data todo berhasil dihapus!');
    }
}