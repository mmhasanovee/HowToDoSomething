<?php
//lets create a new category
include('config.php');
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>New Category</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:40px;margin-top:-5px;"> How To Do Something </span>
	    </div>
        <div class="content">
<?php

?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; New Category
    </div>
	<div class="box_right">
     <a class="pure-material-button-contained" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> <a class="pure-material-button-contained"  href="login.php">Logout</a>
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
	if(mysqli_query($con,'insert into categories (id, name, description, position) select ifnull(max(id), 0)+1, "'.$name.'", "'.$description.'", count(id)+1 from categories'))
	{
	?>
	<div class="message">The category have successfully been created.<br />
	<a href="<?php echo $url_home; ?>">Go to the forum index</a></div>
	<?php
	}
	else
	{
		echo 'An error occured while creating the category.';
	}
}
else
{
?>
<form action="new_category.php" method="post">
	<label for="name">Name</label><input type="text" name="name" id="name" /><br />
	<label for="description">Description</label>(html enabled)<br />
    <textarea name="description" id="description" cols="70" rows="6"></textarea><br />
    <input class="pure-material-button-contained" type="submit" value="Create" />
</form>
<?php
}
?>
		</div>
		<div class="foot"><a href="http://www.mmhasanovee.xyz">Powered by Md Mehedi Hasan</div>
	</body>
</html>
<?php
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
?>
