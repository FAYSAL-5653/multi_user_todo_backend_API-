<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class TodoItemController extends Controller
{

    public function index(Request $request)
    {
        $email = $request->header('email');
        User::where('email', '=', $email);
        $todos = TodoItem::all();
        return response()->json($todos);

    }

    public function store(Request $request)
    {
        try {
            $email = $request->header('email');
            User::where('email', '=', $email);

            TodoItem::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'completed' => $request->input('completed'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed',
            ]);
        }

    }

    public function update(Request $request, $id)
    {

        $email = $request->header('email');
        User::where('email', '=', $email);
        $todo = TodoItem::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $todo->update([
            'task' => $request->input('task'),
            'completed' => $request->input('completed'),
        ]);

        return response()->json(['message' => 'Task updated successfully', 'data' => $todo], 200);
    }

    public function destroy(Request $request, $id)
    {
        $email = $request->header('email');
        User::where('email', '=', $email);
        $todo = TodoItem::find($id);
        if (!$todo) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $todo->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
