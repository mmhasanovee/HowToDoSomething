<?php
//This page let an administrator edit a category
include('config.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysqli_fetch_array(mysqli_query($con,'select count(id) as nb1, name, description from categories where id="'.$id.'" group by id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Edit a category - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Forum" /></a>
	    </div>
        <div class="content">
<?php

?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> &gt; Edit the category
    </div>
	<div class="box_right">
    	<a class="pure-material-button-contained" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> <a class="pure-material-button-contained" href="login.php">Logout</a>
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	if(get_magic_quotes_gpc())
	{
		$name = stripslashes($name);
		$description = stripslashes($description);
	}
	$name = mysqli_real_escape_string($con,$name);
	$description = mysqli_real_escape_string($con,$description);
	if(mysqli_query($con,'update categories set name="'.$name.'", description="'.$description.'" where id="'.$id.'"'))
	{
	?>
	<div class="message">The category have successfully been edited..<br />
	<a href="<?php echo $url_home; ?>">Go to the forum index</a></div>
	<?php
	}
	else
	{
		echo 'An error occured while editing the category.';
	}
}
else
{
?>
<form action="edit_category.php?id=<?php echo $id; ?>" method="post">
	<label for="name">Name</label><input type="text" name="name" id="name" value="<?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>" /><br />
	<label for="description">Description</label>(html enabled)<br />
    <textarea name="description" id="description" cols="70" rows="6"><?php echo htmlentities($dn1['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br />
    <input type="submit" value="Edit" />
</form>
<?php
}
?>
		</div>
		</body>
</html>
<?php
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>The category you want to edit doesn\'t exist..</h2>';
}
}
else
{
	echo '<h2>The ID of the category you want to edit is not defined.</h2>';
}
?>
