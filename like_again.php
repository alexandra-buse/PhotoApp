<?php


  $id = $_GET['id'];
  $id_user = $_GET['id_user'];
  // do some validation here to ensure id is safe

  $link = mysqli_connect('localhost', 'root', '', 'socialwebsite');
  $sql = "SELECT * FROM poze WHERE id_poza=$id";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  $likes = $row['nr_likeuri'] + 1;
  $sql2 = "UPDATE poze SET nr_likeuri = $likes WHERE id_poza = $id ";
  mysqli_query($link, $sql2);
  $sql3 = "UPDATE likeuri SET liked = 1 WHERE id_poza = $id AND id_user = $id_user";
  mysqli_query($link, $sql3);
  mysqli_close($link);
  header("location: index.php");
?>