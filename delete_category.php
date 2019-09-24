<?php
//This page let delete a category
include('config.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysqli_fetch_array(mysqli_query($con,'select count(id) as nb1, name, position from categories where id="'.$id.'" group by id'));
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
        <title>Delete a category - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:350%;margin-top:-5px;"> How To Do Something</span>
	    </div>
        <div class="content">
<?php
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> &gt; Delete the category
    </div>
	<div class="box_right">
    	<a class="pure-material-button-contained" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> <a class="pure-material-button-contained" href="login.php">Logout</a>
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['confirm']))
{
	if(mysqli_query($con,'delete from categories where id="'.$id.'"') and mysqli_query($con,'delete from topics where parent="'.$id.'"') and mysqli_query($con,'update categories set position=position-1 where position>"'.$dn1['position'].'"'))
	{
	?>
	<div class="message">The category and it topics have successfully been deleted.<br />
	<a href="<?php echo $url_home; ?>">Go to the forum index</a></div>
	<?php
	}
	else
	{
		echo 'An error occured while deleting the category and it topics.';
	}
}
else
{
?>
<form action="delete_category.php?id=<?php echo $id; ?>" method="post">
	Are you sure you want to delete this category and all it topics?
    <input type="hidden" name="confirm" value="true" />
    <input type="submit" value="Yes" /> <input type="button" value="No" onclick="javascript:history.go(-1);" />
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
	echo '<h2>The category you want to delete doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>The ID of the category you want to delete is not defined.</h2>';
}
?>
