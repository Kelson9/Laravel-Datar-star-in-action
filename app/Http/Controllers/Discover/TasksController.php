<?php

namespace App\Http\Controllers\Discover;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Dancycodes\Hyper\Routing\Attributes\Route;

class TasksController extends Controller
{
    #[Route(middleware: 'auth')]
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        
        return hyper()
            ->view('tasks', ['tasks' => $tasks])
            ->web(view('tasks', compact('tasks')));
    }

    #[Route(middleware: 'auth')]
    public function store()
    {
        $validated = signals()->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = auth()->user()->tasks()->create([
            'title' => $validated['title'],
            'is_completed' => false,
        ]);

        $tasks = auth()->user()->tasks()->latest()->get();

        return hyper()
            ->fragment('tasks', 'task-list', compact('tasks'))
            ->signals([
                'title' => '',
                'tasks' => $tasks,
                'errors' => [],
            ]);
    }

    #[Route(middleware: 'auth')]
    public function edit(Task $task)
    {
        // Ensure user owns this task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        // Return just HTML, no redirect
        return response()
            ->view('partials.task-edit-form', compact('task'))
            ->header('Content-Type', 'text/html');
    }

    #[Route(middleware: 'auth')]
    public function update(Task $task)
    {
        // Ensure user owns this task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if updating title from edit form (has 'title' field with value)
        if (request()->filled('title')) {
            $validated = signals()->validate([
                'title' => 'required|string|max:255',
            ]);

            $task->update([
                'title' => $validated['title'],
            ]);

            // Refresh the tasks list
            $tasks = auth()->user()->tasks()->latest()->get();

            return hyper()
                ->fragment('tasks', 'task-list', compact('tasks'))
                ->signals([
                    'tasks' => $tasks,
                ]);
        }

        // Toggle completion from checkbox
        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        $tasks = auth()->user()->tasks()->latest()->get();

        return hyper()
            ->fragment('tasks', 'task-list', compact('tasks'))
            ->signals([
                'tasks' => $tasks,
            ]);
    }

    #[Route(middleware: 'auth')]
    public function destroy(Task $task)
    {
        // Ensure user owns this task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        $tasks = auth()->user()->tasks()->latest()->get();

        return hyper()
            ->fragment('tasks', 'task-list', compact('tasks'))
            ->signals([
                'tasks' => $tasks,
            ]);
    }
}
