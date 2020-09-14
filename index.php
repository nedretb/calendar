<?php
  include "calendar.php";
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <title>some page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST">
  <input name="sub" type="submit" value="NAZAD">
  <input name="reset" type="submit" value="DANAS">
  <input name="add" type="submit" value="NAPRIJED">
</form>
<?php
  if(isset($_POST['reset'])){
    $_SESSION['month'] = 9;
    $_SESSION['year'] = 2020;
  }
  else if(isset($_POST['add'])){
    ++$_SESSION['month'];
  }
  else if(isset($_POST['sub'])){
    --$_SESSION['month'];
  }

  if($_SESSION['month'] < 1){
    --$_SESSION['year'];
    $_SESSION['month'] = 12;
  }
  else if($_SESSION['month'] > 12){
    ++$_SESSION['year'];
    $_SESSION['month'] = 1;
  }
  $calendar = new Calendar($_SESSION['month'], $_SESSION['year']);
  $calendar->show();
?>
</body>
</html>