<?php

  $email = $_GET['email'];

  $link = mysqli_connect('localhost', 'root', '', 'socialwebsite');
  $sql = "SELECT poza_profil FROM users WHERE email=$email";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  header("Content-type: image/jpeg");
  echo $row['poza_profil'];
?>
