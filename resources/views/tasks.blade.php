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

        <div data-signals="{title: '', tasks: {{ json_encode($tasks) }}, errors: {}, alert: {show: false, message: '', type: 'success'}}">
            
            <!-- Alert/Toast Notification -->
            <div data-show="$alert.show" 
                 data-on:load="setTimeout(() => { $alert.show = false }, 3000)"
                 class="fixed top-4 right-4 z-50 max-w-md transition-all duration-300">
                
                <!-- Success Alert -->
                <div data-show="$alert.type === 'success'"
                     class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span data-text="$alert.message" class="flex-1 font-medium"></span>
                    <button data-on:click="$alert.show = false" class="hover:bg-white/20 rounded p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Error Alert -->
                <div data-show="$alert.type === 'error'"
                     class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span data-text="$alert.message" class="flex-1 font-medium"></span>
                    <button data-on:click="$alert.show = false" class="hover:bg-white/20 rounded p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Info Alert -->
                <div data-show="$alert.type === 'info'"
                     class="bg-blue-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span data-text="$alert.message" class="flex-1 font-medium"></span>
                    <button data-on:click="$alert.show = false" class="hover:bg-white/20 rounded p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Warning Alert -->
                <div data-show="$alert.type === 'warning'"
                     class="bg-yellow-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span data-text="$alert.message" class="flex-1 font-medium"></span>
                    <button data-on:click="$alert.show = false" class="hover:bg-white/20 rounded p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
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
