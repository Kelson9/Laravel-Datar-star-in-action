<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyper Test</title>
    @hyper
</head>
<body>
    <div data-signals="{message: 'Hyper is working!'}">
        <h1 data-text="$message"></h1>
        <button data-on:click="$message = 'You clicked the button!'">
            Click Me
        </button>
    </div>
</body>
</html>