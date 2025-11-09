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
                        <div>
                            <!-- View Mode -->
                            <div data-show="!$['editing_{{ $task->id }}']" class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                    <!-- Checkbox -->
                                    <input 
                                        type="checkbox"
                                        {{ $task->is_completed ? 'checked' : '' }}
                                        data-on:change="@patchx('/tasks/{{ $task->id }}')"
                                        class="w-5 h-5 text-sky-500 rounded focus:ring-sky-500 focus:ring-2 cursor-pointer">
                                    
                                    <!-- Task Title -->
                                    <span 
                                        style="text-decoration: {{ $task->is_completed ? 'line-through' : 'none' }}"
                                        class="flex-1">
                                        {{ $task->title }}
                                    </span>

                                    <!-- Edit Button -->
                                    <button 
                                        type="button"
                                        data-on:click="$['editing_{{ $task->id }}'] = true"
                                        class="text-blue-500 hover:text-blue-600 focus:outline-none cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <button 
                                        type="button"
                                        data-on:click="@deletex('/tasks/{{ $task->id }}')"
                                        class="text-red-500 hover:text-red-600 focus:outline-none cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Edit Mode -->
                                <div 
                                    data-show="$['editing_{{ $task->id }}']"
                                    class="flex items-center gap-3 p-3 border-2 border-sky-500 rounded-lg bg-sky-50 transition">
                                    
                                    <!-- Edit Input -->
                                    <input 
                                        type="text"
                                        id="edit-input-{{ $task->id }}"
                                        value="{{ $task->title }}"
                                        autofocus
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                                    
                                    <!-- Save Button (checkmark icon) -->
                                    <button 
                                        type="button"
                                        data-on:click="$title = document.getElementById('edit-input-{{ $task->id }}').value; @patchx('/tasks/{{ $task->id }}').then(() => { $['editing_{{ $task->id }}'] = false; $title = '' })"
                                        class="text-green-600 hover:text-green-700 focus:outline-none cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>

                                    <!-- Cancel Button (X icon) -->
                                    <button 
                                        type="button"
                                        data-on:click="$['editing_{{ $task->id }}'] = false"
                                        class="text-gray-500 hover:text-gray-600 focus:outline-none cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endfragment
            </div>

        </div>

    </div>
</div>
@endsection
