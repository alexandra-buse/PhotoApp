<?php

  $id_poza = $_GET['id_poza'];
  // do some validation here to ensure id is safe

  $link = mysqli_connect('localhost', 'root', '', 'socialwebsite');
  $sql = "SELECT * FROM poze WHERE id_poza=$id_poza";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="profilelook.css">
</head>
<body>

<p class="heading">Delete this photo?</p>
 <img class="photo-to-delete" src="data:image/jpeg;base64, <?php echo base64_encode($row['poza']); ?>" alt="" />
<a class="delete-btn" href="delete_this.php?id_poza=<?php echo $id_poza; ?>">
 <button class="btn yes">Yes</button>
</a>
 <button class="btn no" onclick="window.location.href = 'profile.php'">No</button>

</body>
</html>