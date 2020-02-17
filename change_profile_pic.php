

<?php

    $id_user = $_GET['id_user'];

    if(isset($_POST['submit_profile']))
    {
            $db = mysqli_connect('localhost', 'root', '', 'socialwebsite');
                    $imageName = mysqli_real_escape_string($db, $_FILES["profile_image"]["name"]);
                    $imageData = mysqli_real_escape_string($db, file_get_contents($_FILES["profile_image"]["tmp_name"]));
                    $imageType = mysqli_real_escape_string($db, $_FILES["profile_image"]["type"]);
                    $update = "UPDATE users SET poza_profil ='$imageData' WHERE id = '$id_user' ";

                        mysqli_query($db, $update);
                    
                    mysqli_close($db);
                    header("location: index.php");

                }
            ?>

