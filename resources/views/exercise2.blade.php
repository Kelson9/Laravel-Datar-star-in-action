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


     <div class="flex-col align-center justify-center mt-2" data-attr:type="$type">
     <div class="form-elements mt-2"
        <label>
            Email
        </label>
        <input type="email" class="border rounded" data-bind:email>
        <span data-show="checkEmail($email)" class="bg-red">Please enter a valid email</span> 
     </div>

     <div class="mt-2"> 
        <label>
            Password
        </label>
        <input type="password" class="border rounded"  data-bind:password>
      <span data-show="checkPassword($password)">Please enter a valid email</span> 
    </div>
    <button class="border rounded cursor-pointer mt-2" $type=`hidden`>Create account</button>
    </div>

    <script>
        function checkEmail($email){ 
            return  $email.includes('@' && '.') ?  false: true;
        }
        
        function checkPassword($password){ 
            return  $password.length > 8 ?  false: true;
        }

    </script>
    </body>
</html>
