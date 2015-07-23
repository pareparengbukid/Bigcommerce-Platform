<?php

include'login.php'; 

if(isset($_SESSION['login_user'])){
	header("location: main.php");
}
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link type="text/css" rel="stylesheet" href="css/imonggo.css"  media="screen,projection"/>
     <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>

  <body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <div class="row">
    <form method="POST" class="col s12">

      <div class="row">
        <div class="row">
        <div class="input-field col s12">
          <input id="acct_id" name="acct_id" type="text" class="validate">
          <label for="acct_id">Account ID</label>
        </div>
      </div>
      </div>

      <div class="row">
        <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate">
          <label for="email" data-error="Invalid" data-success="right">Email</label>
        </div>
      </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light light-blue accent-3 btn" type="submit" name="login">Continue</button>
    </form>
  </div>

  </body>
</html>