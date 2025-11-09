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

        // Use prepend mode to add the new task at the top of the list
        return hyper()
            ->fragment('tasks.task-item', 'task-item', compact('task'), [
                'selector' => '#task-list',
                'mode' => 'prepend'
            ])
            ->signals([
                'title' => '',
                'tasks' => $tasks,
                'errors' => [],
                'alert' => [
                    'show' => true,
                    'message' => 'Task "' . $task->title . '" created successfully!',
                    'type' => 'success'
                ]
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

            $tasks = auth()->user()->tasks()->latest()->get();

            // Use outer mode to morph just this specific task item
            return hyper()
                ->fragment('tasks.task-item', 'task-item', compact('task'), [
                    'selector' => '#task-item-' . $task->id,
                    'mode' => 'outer'
                ])
                ->signals([
                    'tasks' => $tasks,
                    'alert' => [
                        'show' => true,
                        'message' => 'Task updated successfully!',
                        'type' => 'success'
                    ]
                ]);
        }

        // Toggle completion from checkbox
        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        $tasks = auth()->user()->tasks()->latest()->get();
        
        $message = $task->is_completed 
            ? 'Task marked as completed!' 
            : 'Task marked as incomplete!';

        // Use outer mode to morph just this specific task item
        return hyper()
            ->fragment('tasks.task-item', 'task-item', compact('task'), [
                'selector' => '#task-item-' . $task->id,
                'mode' => 'outer'
            ])
            ->signals([
                'tasks' => $tasks,
                'alert' => [
                    'show' => true,
                    'message' => $message,
                    'type' => 'info'
                ]
            ]);
    }

    #[Route(middleware: 'auth')]
    public function destroy(Task $task)
    {
        // Ensure user owns this task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $taskId = $task->id;
        $taskTitle = $task->title;
        $task->delete();

        $tasks = auth()->user()->tasks()->latest()->get();

        // Use the remove action to delete the element
        return hyper()
            ->remove('#task-item-' . $taskId)
            ->signals([
                'tasks' => $tasks,
                'alert' => [
                    'show' => true,
                    'message' => 'Task "' . $taskTitle . '" deleted successfully!',
                    'type' => 'success'
                ]
            ]);
    }
}
