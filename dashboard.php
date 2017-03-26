<?php
session_start();

 require 'db.php';
 $querySelect = mysqli_query($connection, "SELECT * FROM tasks");

 ?>
 <?php
     if(isset($_SESSION['message']))
     {
          echo "<div id='error_msg'>".$_SESSION['message']."</div>";
          unset($_SESSION['message']);
     }
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>

</head>

<body>
  <h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
  <a href="logout.php">Log Out</a>

    <div class="container">
        <h2 style="text-align: center;">Kanban Dashboard</h2><br><br><br><br>
        <form method="POST" id="task">
          <div class="col-xs-2">
            <input class="form-control"  type="text" placeholder="Task Name" name="task_name" id="task_name">
          </div>
          <div class="col-xs-2">
            <input class="form-control" type="time" placeholder="Start Time" name="start_time" id="start_time">
          </div>
          <div class="col-xs-2">
            <input class="form-control" type="time" placeholder="finish Time" name="finish_time" id="finish_time">
          </div>
          <div class="col-xs-2">
            <input class="form-control"type="text" placeholder="Description" name="description" id="description">
          </div>
            <button class="btn btn-primary" type="submit" name="submit" class="btn-primary"> Add Task </button>

        </form>
        <div class="table table-striped">
          <table class="table">
              <thead>
                  <tr>
                      <th style="font-size: 18px;">Todo</th>
                      <th style="font-size: 18px;">Doing</th>
                      <th style="font-size: 18px;">Testing</th>
                      <th style="font-size: 18px;">Finish</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                  while ($row = mysqli_fetch_array($querySelect)) {
                      echo '<tr class="table-bordered" style="height: 120px; width:300px;">
                     <td style="border-left:1px ridge; border-right:1px ridge; width:75px;" id="finish" ondrop="drop(event)" ondragover="allowDrop(event)">';
                      if ($row['status'] == 'TODO') {
                          /*if($action == 'todo'){*/
                              echo'
                  <div class="note" draggable="true" ondragstart="drag(event)" id="drag1">
                    <div class="note_cnt">
                      <h5>'.$row['task_name'].'<br/>
                      Start Time '.$row['start_time'].'<br/>
                      Finish Time '.$row['finish_time'].'<br/>
                      Description '.$row['finish_time'].'</h5>

                    </div>
                  </div>';
                          /*}else {
                    echo'';
                  }
                }else{
                  echo '';*/
                          //$id = $row['id'];
                      }
                      /*if($action == 'doing'){
                  mysqli_query($con, "UPDATE tasks SET status='DOING' WHERE id='$id'");
                }*/
                      echo'
                </td>
                <td style="border-left:1px ridge; border-right:1px ridge; width:75px;" id="finish" ondrop="drop(event)" ondragover="allowDrop(event)">';
                      if ($row['status'] == 'DOING') {
                          /*if($action == 'doing'){*/
                              echo'
                  <div class="note" draggable="true" ondragstart="drag(event)" id="drag1">
                    <div class="note_cnt">
                    <h5>'.$row['task_name'].'<br/>
                    Start Time '.$row['start_time'].'
                    Finish Time '.$row['finish_time'].'
                    Description '.$row['finish_time'].'</h5>
                    </div>
                  </div>';
                          /*}else {
                    echo'';
                  }
                }
                else{
                  echo '';*/
                          //$id1 = $row['id'];
                      }
                      /*if($action == 'testing'){
                  mysqli_query($con, "UPDATE tasks SET status='TESTING' WHERE id='$id1'");
                }*/
                      echo'
                </td>
                <td style="border-left:1px ridge; border-right:1px ridge; width:75px;" id="testing" ondrop="drop(event)" ondragover="allowDrop(event)">';
                      if ($row['status'] == 'TESTING') {
                          echo'
                  <div class="note" draggable="true" ondragstart="drag(event)" id="drag1">
                    <div class="note_cnt">
                    <h5>'.$row['task_name'].'<br/>
                    Start Time '.$row['start_time'].'
                    Finish Time '.$row['finish_time'].'
                    Description '.$row['finish_time'].'</h5>
                    </div>
                  </div>';
                      }
                      echo'
                </td>
                <td style="border-left:1px ridge; border-right:1px ridge; width:75px;" id="finish" ondrop="drop(event)" ondragover="allowDrop(event)">';
                      if ($row['status'] == 'FINISH') {
                          echo'
                  <div class="note" draggable="true" ondragstart="drag(event)" id="drag1">
                    <div class="note_cnt">
                    <h5>'.$row['task_name'].'<br/>
                    Start Time '.$row['start_time'].'
                    Finish Time '.$row['finish_time'].'
                    Description '.$row['finish_time'].'</h5>
                    </div>
                  </div>';
                      }
                      echo'
                </td>
                </tr>';
                  }
                ?>
              </tbody>
          </table>


      </div>
  </div>

    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">

    $(function(){
      $('form#task').on("submit",function(event) {
        event.preventDefault();
          $.ajax({
            url: "./addTask.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
          
              location.reload();

            },
            error: function(){
              console.log('Error');

            }
          });
        });
      });

      $(function(){
        $('form#task').on("submit",function(event) {
          event.preventDefault();
            $.ajax({
              url: "./updateTask.php",
              type: "POST",
              data: $(this).serialize(),
              success: function(response){
                location.reload();
              },
              error: function(){
                console.log('Error');

              }
            });
          });
        });

    </script>
</body>

</html>
