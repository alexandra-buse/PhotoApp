<?php 
  session_start(); 
  $email1 = $_SESSION['email'];
  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login.php");
  }

?>

<?php
    $db = mysqli_connect('localhost', 'root', '', 'socialwebsite');
    $sql5 = "SELECT * FROM users WHERE email='$email1'";
    $result_user = mysqli_query($db, $sql5);
    $row_user = mysqli_fetch_assoc($result_user);
    $id_user=$row_user['id'];
    $prenume  = $row_user['prenume'];
    $nume  = $row_user['nume'];
    $sql = "SELECT * FROM poze WHERE id_user='$id_user' order by nr_likeuri DESC, times DESC";
    $result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="profilelook.css">
</head>
<body>

  <ul>
    <li>
      <a href="index.php">Home</a>
    </li>
    <li>
      <a href="profile.php">Profile</a>
    </li>
    <li>
      <a href="index.php?logout='1'">Logout</a>
    </li>
  </ul>

  <p class="heading"><?php echo $prenume ?> <?php echo $nume ?></p>
  <div class="profile-pic">
    <img class="profile-pic" src="getimage.php?email='<?php echo $email1; ?>'" alt="Profile pic">
  </div>
  <div class="gallery-image">
    <?php
          while( $row = mysqli_fetch_assoc($result)) {
            $id = $row['id_user'];
            $sql2 = "SELECT * FROM users where id=$id";
            $result_profile_info = mysqli_query($db, $sql2);
            $row_profile_info = mysqli_fetch_assoc($result_profile_info);
            ?>
    <div class="img-box">
      <img src="data:image/jpeg;base64, <?php echo base64_encode($row['poza']); ?>" alt="" />

      <div class="transparent-box">
        <div class="caption">
          <p><?php echo $row['nr_likeuri']; ?> Likes</p>
          <p class="opacity-low"><?php echo $row['times']; ?></p>
          <a href="delete.php?id_poza='<?php echo $row['id_poza']; ?>'">DELETE</a>
        </div>
      </div> 
    </div>

    <?php
      }
    ?>

   
  </div>
</body>
</html>