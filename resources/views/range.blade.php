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

     <div class="border h-20" data-style:background-color="rgb('$($red),$($green),$($blue)')"> 
    </div>
    <div class="el">
    <div class="el">
        <h3>Red</div>
        <input type="range" class="accent-blue-500 w-300" data-bind:red>
         <span data:text="$redValue">
    </div>
        <div class="el1">
        <h3>Green</div>
        <input type="range" class="accent-blue-500 w-300" data-bind:green>
        <span data:text="$greenValue">
    </div>
        <div class="el1">
        <h3>Blue</div>
        <input type="range" class="accent-blue-500 w-300" data-bind:blue>
        <span data:text="$blueValue">
    </div>
    </div>
    <pre data-json-signals></pre>
    </body>
</html>
