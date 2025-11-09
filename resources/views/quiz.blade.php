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
        <h1 class=text-center>Welcome to Quiz learning</h1>
     </header>

      <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg" data-signals="{todoInput:'', todos:[], tod:[] }">
        <h2>MCQ Questions</h2>
        <div class="questions">

      </div>
    </body>
    <pre data-json-signals></pre>
</html>