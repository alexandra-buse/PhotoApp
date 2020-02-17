<?php

$id_poza = $_GET['id_poza'];
$link = mysqli_connect('localhost', 'root', '', 'socialwebsite');
$sql2 = "DELETE FROM likeuri WHERE id_poza=$id_poza";
$sql3 = "DELETE FROM comentarii WHERE id_poza=$id_poza";
$sql4 = "DELETE FROM poze WHERE id_poza=$id_poza";
mysqli_query($link, $sql2);
mysqli_query($link, $sql3);
mysqli_query($link, $sql4);
mysqli_close($link);
header("location: profile.php");



?>