<html>
    <head>

    </head>
    <body onload="loadTasks()">
        <h1>Tasks</h1>
        <hr>
        New Task: <input id="task_name" type="text" name="task">
        <button onclick="addNewTask()">Add</button>
        <div>
            <ul id="task_list">
            </ul>
        </div>

        <script type="text/javascript">
            function loadTasks() {
                var request = new XMLHttpRequest();
                request.open("GET", "get_incomplete.php");

                request.onreadystatechange = function() {
                    if(this.readyState === 4 && this.status === 200) {
                        let data = JSON.parse(this.responseText);
                        let txt = "";
                        let row;
                        for(let i = 0; i < data.length; i++) {
                            row = data[i];
                            txt += "<li>" + row.name + "</li>";
                        }
                        document.getElementById("task_list").innerHTML = txt;
                    }
                };

                request.send();
            }

            function addNewTask() {
                var task = document.getElementById("task_name").value;
                var request = new XMLHttpRequest();
                request.open("POST", "add_task.php");
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                request.onreadystatechange = function() {
                    if(this.readyState === 4 && this.status === 200) {
                        let data = JSON.parse(this.responseText);
                        if(data.id != "") {
                            document.getElementById("task_name").value = "";
                            loadTasks();
                        }
                        else {
                            alert("Problem adding task");
                        }
                    }
                };

                request.send("task="+task);
            }
        </script>
    </body>
</html>
