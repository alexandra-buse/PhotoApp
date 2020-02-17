<?php

    $id_user = $_GET['id_user'];
    $id_poza = $_GET['id_poza'];

    if(isset($_POST['submitcomm']))
    {
            $db = mysqli_connect('localhost', 'root', '', 'socialwebsite');
                    $date = date("Y-m-d H:i:s");
                    $text = mysqli_real_escape_string($db, $_POST['comm']);
                    $insertcomm = "INSERT INTO comentarii VALUES ('', '$id_poza', '$id_user', '$text', '$date')";
                    mysqli_query($db, $insertcomm);
                    mysqli_close($db);
                    header("location: index.php");

                }
            ?>