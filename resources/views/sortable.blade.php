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

      <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="block">
            <table class="border-collapse border-spacing-2 border border-gray-400 dark:border-gray-500" id="myTable2">
                <thead>
                    <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-5 cursor-pointer" data-effect="$name= sortTable(0)">Name</th>
                    <th class="border border-gray-300 p-5 cursor-pointer" data-effect="$age= sortTable(1)">Age</th>
                    <th class="border border-gray-300 p-5 cursor-pointer" data-effect="$email= sortTable(2)">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="border border-gray-300 p-5">Johnson</td>
                    <td class="border border-gray-300 p-5">20</td>
                    <td class="border border-gray-300 p-5">alice.johnson@gmail.com</td>
                    </tr>
                    <tr>
                    <td class="border border-gray-300 p-5">Bob Smith</td>
                    <td class="border border-gray-300 p-5">12</td>
                    <td class="border border-gray-300 p-5">bobsmith@gmail.com</td>
                    </tr>
                    <tr>
                    <td class="border border-gray-300 p-5">Charlie</td>
                    <td class="border border-gray-300 p-5">29</td>
                    <td class="border border-gray-300 p-5">charliej@gmail.com</td>
                    </tr>
                </tbody>
            </table>
      </div>
      <script>
        function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable2");
        switching = true;
        dir = "asc";
      
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
                }
            }
            }
            if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
            } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
            }
        }
        }
</script>
    </body>
        <pre data-json-signals></pre>
</html>