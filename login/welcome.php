<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome - <?php $_SESSION['username']?></title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $issue = $_POST['issue'];
    
    
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "complain_form";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if(!$conn)
    {
      die("The server couldnt connect because " . mysqli_connect_error());
       
    }
    else
    {
      $sql = "INSERT INTO `dmrc_complain` ( `Name`, `email`, `date`, `department`, `issue`) VALUES ('$name', '$email', current_timestamp(), '$department', '$issue')";

      $result = mysqli_query($conn,$sql);

      if($result)
      {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully! 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
      else
      {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
      }
    }
    }

?>
    <div class="container mt-3">
<h1>Contact us for your concerns</h1>
    <form action="/login/welcome.php" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"> 
    </div>
    <div class="form-group">
        <label for="date">date</label>
        <input type="date" name="date" class="form-control" id="date" aria-describedby="emailHelp"> 
    </div>
    <div class="form-group">
        <label for="department">department</label>
        <textarea class="form-control" name="department" id="department" cols="10" rows="1"></textarea> 
    </div>
    <!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" name="department" id="department" data-bs-toggle="dropdown" aria-expanded="false">
    Department
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">IT</a></li>
    <li><a class="dropdown-item" href="#">SnT</a></li>
    <li><a class="dropdown-item" href="#">Others</a></li>
  </ul> -->
<!-- </div> -->
    <div class="form-group">
        <label for="issue">issue</label>
        <textarea class="form-control" name="issue" id="issue" cols="30" rows="10"></textarea> 
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>