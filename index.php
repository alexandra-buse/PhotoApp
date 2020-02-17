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
    $sql = "SELECT * FROM poze order by times DESC";
    $result = mysqli_query($db, $sql);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="feedlook.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		

	<div class="row">
    	<div class="column left">
    		<div class = "card">
    			<p> Hello, <?php echo $prenume ?> </p>
    			<img class="profile-pic" src="getimage.php?email='<?php echo $email1; ?>'" alt="Profile pic">
    		</div>
    		<div class = "card">
    			<p>Add a new photo</p>
    		<form class="upload" action = "submit.php?id_user=<?php echo $id_user; ?>" method="POST" enctype="multipart/form-data">
    			<button class="btn" type = "button">
    				<i class="fa fa-folder"></i>
    				<label for="img">Chose photo</label>
    			</button>
                <input type="file" name="image" id="img" style="display: none;">
                <button class="btn" type="submit" name="submit" value="Done"> <i class="fa fa-check">Done</i> </button>
            </form>
        	</div>

        	<div class="card">
        		<p>Change profile photo</p>
            <form class="upload" action = "change_profile_pic.php?id_user=<?php echo $id_user; ?>" method="POST" enctype="multipart/form-data">
            	<button class="btn" type = "button">
    				<i class="fa fa-folder"></i>
    				<label for="img1">Chose profile photo</label>
    			</button>
                <input type="file" name="profile_image" id="img1" style="display: none;">
                <button class="btn" type="submit" name="submit_profile" value="Done"> <i class="fa fa-check">Done</i> </button>
            </form>
            </div>	 
    	</div>

    	<div class="column right">
    		<?php
    			while( $row = mysqli_fetch_assoc($result)) {
    				$id = $row['id_user'];
    				$sql2 = "SELECT * FROM users where id=$id";
    				$result_profile_info = mysqli_query($db, $sql2);
    				$row_profile_info = mysqli_fetch_assoc($result_profile_info);
    				?>
    	<div class = "card-post">
    	<div class="entire_post">
    		<div class="post pic">
    			<img class="small_images" src="data:image/jpeg;base64, <?php echo base64_encode($row_profile_info['poza_profil']); ?>"
    			<p><?php echo $row_profile_info['prenume']; ?> <?php echo $row_profile_info['nume']; ?> </p>
    			<img class="wall_images" src="data:image/jpeg;base64, <?php echo base64_encode($row['poza']); ?>" >
    			<br>
    			<?php
    				$id_poza = $row['id_poza'];
    				$sql4 = "SELECT * FROM likeuri WHERE id_poza=$id_poza AND id_user=$id_user";
    				$result_likes = mysqli_query($db, $sql4);
    				if(! ($row_likes = mysqli_fetch_assoc($result_likes))) {
    					echo "<a class='p_like' href = 'like.php?id=$id_poza&id_user=$id_user'>
    						<button class='btn'><i class='fa fa-thumbs-up'></i> Like</button>
    					</a>"; 
    				} else{
    					if($row_likes['liked'] == 1){
    						echo "<a class='p_like' href = 'unlike.php?id=$id_poza&id_user=$id_user'>
    							<button class='btn'><i class='fa fa-thumbs-down'></i> Unlike</button>
    						</a>"; 
    					} else {
    						echo "<a class='p_like' href = 'like_again.php?id=$id_poza&id_user=$id_user'>
    							<button class='btn'><i class='fa fa-thumbs-up'></i> Like</button>
    						</a>";  
    					}
    				}
    			?>

    			<p class="p_like">    <?php echo $row['nr_likeuri']; ?> </p>

    		</div>

    		<div class ="post comm">
    			
    				<?php
    					$sql3 = "SELECT * FROM comentarii where id_poza=$id_poza";
    					$result_comm = mysqli_query($db, $sql3);
    					while( $row_comm = mysqli_fetch_assoc($result_comm)) {
    						$id_user_comm = $row_comm['id_user'];
    						$sql_comm_from = "SELECT * FROM users where id=$id_user_comm";
    						$result_comm_from = mysqli_query($db, $sql_comm_from);
    						$row_comm_from = mysqli_fetch_assoc($result_comm_from);
    						$email_comm = $row_comm_from['email'];
    					?>

    					<div class="card-comm">
    					<p><?php echo $row_comm_from['prenume']; ?> <?php echo $row_comm_from['nume']; ?> </p>
    					<img class="small_images" src="data:image/jpeg;base64, <?php echo base64_encode($row_comm_from['poza_profil']); ?>">
    					<p class="comment-text"><?php echo $row_comm['text']?></p>
    					</div>
      					<?php	
    					}
    				?>
    				
    				<form  action = "comment.php?id_user=<?php echo $id_user; ?>&id_poza=<?php echo $id_poza; ?>" method="POST" enctype="multipart/form-data">
                	<input type="text" name="comm">
                	<button class="btn" type="submit" name="submitcomm" value="Add Comment">
                		<i class='fa fa-comment'></i> Add Comment
                	</button>
            		</form>
    				
    		</div>

    	</div>
    	</div>
    		<?php

    			}

    		?>
    	</div>
	</div>
		
</body>
</html>