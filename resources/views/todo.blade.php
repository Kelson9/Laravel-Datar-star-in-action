<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="{{ asset('datastar.js') }}"></script>
</head>
    <body>
      <header>
        <h1 class=text-center>Welcome to Datastar learning</h1>
     </header>

      <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg" data-signals="{todoInput:'', todos:[], tod:[] }">
        <div class="flex gap-2 mb-6">
          <input 
            type="text" 
            class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500" 
            placeholder="Enter a todo..."
            data-bind=todoInput>

          <button 
            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-medium cursor-pointer"
            data-on:click="$todos = addTodo($todoInput, $todos); $todoInput = ''; renderTodoList($todos)">
            Add
          </button>
        </div>
        <h3 data-show="$tod.length>0"><span data-text="$tod.length"></span> todo items</h3>
        <div class="search">
            <input type="text" data-bind=searchItem class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500"
                        placeholder="filter..." data-effect="$tod = filterTodo($searchItem, $todos); renderTodoList($tod)">
            <span data:text="$searchItem" >
        </div>
    
        <div class="space-y-2" id="todoList">
        </div>
      </div>

      <script>
        function addTodo(input, todos) {
            if (input.trim()) {
                return [{id: Date.now(), text: input}, ...todos];
            }
            return todos;
        }
        
        function removeTodo(index, todos) {
            return todos.filter((_, i) => i !== index);
        }

        function renderTodoList(todos) {
            const todoList = document.getElementById('todoList');
            if (!todoList) return '';
            
            todoList.innerHTML = todos.map((todo, index) => `
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded border border-gray-200">
                    <span class="flex-1">${todo.text}</span>
                    <button 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded text-sm font-medium cursor-pointer ml-3"
                        data-on:click="$todos = removeTodo(${index}, $todos); renderTodoList($todos)">
                        Remove
                    </button>
                </div>
            `).join('');
            return '';
        }

        function filterTodo(searchItem, todos) {
            return todos.filter(t => t.text.toLowerCase().includes(searchItem.toLowerCase()));
        }
    </script>
    </body>
    <pre data-json-signals></pre>
</html>