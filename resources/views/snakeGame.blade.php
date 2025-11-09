<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datastar Learning Platform</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script type="module" src="{{ asset('datastar.js') }}"></script>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col items-center justify-between p-20 text-sm">

    <div data-show="!$game">Game Over</div>

    <div 
        data-signals="{
            box_size: 20,
            snake: [3,2,1],
            dir: 'right',
            food: 0,
            game: 'true'
        }"
        data-computed:size="$box_size**2"
        data-init="$food = getFood($snake, $size)"
        data-attr:class="`grid`"
        data-style:grid-template-columns="'1fr '.repeat($box_size).trim()"
        data-style:width="`${$size}px`"
        data-style:height="`${$size}px`"
        data-effect="drawGrid(el, $box_size, $snake, $food)"
        data-on-interval__duration.300ms="[$snake, $food, $game] = snakeMove($snake, $dir, $box_size, $food, $size)"
        data-on:keydown__window="$dir=evt.key.toLowerCase().substring(5)"
        
    >

    </div>

    <script>
        function drawGrid(el, bsize, snake, food){
            count = 1;
            el.textContent='';
            for(x=0; x<bsize; x++){
                for(y=0; y<bsize; y++){
                    cell = document.createElement('div');
                    cell.className = `border flex-1 size-[${bsize}px]`;
                    cell.id = count;
                    
                    if(snake.includes(parseInt(cell.id))){
                        if(snake[0]==cell.id){
                             cell.className = cell.className + ' bg-sky-500';
                        }else {
                             cell.className = cell.className + ' bg-sky-300';
                        }
                       
                    };

                    if(parseInt(cell.id) === food){
                        cell.className = cell.className + ' bg-green-500 rounded-full';
                    }

                    count++;

                    el.appendChild(cell);
                }
            }
        }
    
        function snakeMove(snake, dir, bsize, food, size){
            game = true;
            switch(dir){
                case 'right':
                    // snake.unshift((snake[0])%(bsize)+1);
                    if(snake[0]%bsize===0){
                        snake.unshift(snake[0]+1-bsize)
                    }else{
                        snake.unshift(snake[0]+1)
                    }
                    break;
                case 'left':
                    //snake.unshift((snake[0]+bsize-2)%(bsize)+1);
                    if(snake[0]%bsize===1){
                        snake.unshift(snake[0]-1+bsize)
                    }else{
                        snake.unshift(snake[0]-1)
                    }
                    break;
                case 'down':
                    snake.unshift((snake[0]+bsize-1)%(bsize**2)+1);
                    break;
                case 'up':
                    snake.unshift((snake[0]-bsize+bsize**2-1)%(bsize**2)+1);
                    break;
            }

            if(snake.filter((id)=>id===snake[0]).length > 1){
                game = false;
            }

            if(snake[0]===food){
                food = getFood(snake, size);
            }else{
                id = snake.pop();
            }

            return [snake, food, game];
        }

        function getFood(snake, size){
            do{
                food = Math.ceil(Math.random()*size);
            } while(snake.includes(food));

            return food;
        }
    </script>

    <pre data-json-signals="">
    </pre>
</body>
</html>