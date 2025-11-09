@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Manage Your Tasks</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <div data-signals="{title: '', tasks: {{ json_encode($tasks) }}, errors: {}}">
            
            <!-- Add Task Form -->
            <form class="bg-white rounded-lg shadow-lg p-6 mb-6"
                  data-on:submit__prevent="@postx('{{ route('tasks.store') }}')">
                <div class="flex gap-3">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            data-bind="title"
                            placeholder="Enter task" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                        <div data-error="title" class="text-red-500 text-xs mt-1"></div>
                    </div>
                    <button class="btn btn-primary px-6">
                        Add
                    </button>
                </div>
            </form>

            <!-- Tasks List -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div data-show="$tasks.length === 0" class="text-center text-gray-500 py-8">
                    No tasks yet. Add your first task above!
                </div>

                @fragment('task-list')
                <div id="task-list" class="space-y-3">
                    @foreach($tasks as $task)
                        @include('tasks.task-item', ['task' => $task])
                    @endforeach
                </div>
                @endfragment
            </div>

        </div>

    </div>
</div>
@endsection
