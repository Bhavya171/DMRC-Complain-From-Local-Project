<?php


if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin = true;
}
else {

  $loggedin = false;
}



echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/login/welcome.php">DMRC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    if(!$loggedin)
    {
  echo  '<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/login/login.php">login</a>
    </li>
  <li class="nav-item">
  <a class="nav-link" href="/login/signup.php">signup</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/login/admin_login.php">Admin login</a>
    </li>
    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/login/admin_signup.php">Admin signup</a>
    </li>';
  }
  if($loggedin)
  {

    echo '<li class="nav-item">
    <a class="nav-link" href="/login/logout.php">logout</a>
    </li>';
    }
        
        
      echo '</ul>
      
    </div>
  </div>
</nav>';
?>