<?php
//This page display the profile of an user
include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>User Profile</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:40px;margin-top:-5px;"> How To Do Something?</span>
	    </div>
        <div class="content">
<?php
if(isset($_SESSION['username']))
{

?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <a href="users.php">Users</a> &gt; Profile of an user
    </div>
	<div class="box_right">
    	<a class="pure-material-button-contained" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> <a class="pure-material-button-contained" href="login.php">Logout</a>
    </div>
    <div class="clean"></div>
</div>
<?php
}
else
{
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <a href="users.php">User Profile</a> &gt; Profile of an user
    </div>
	<div class="box_right">
    	<a href="signup.php">Sign Up</a> - <a href="login.php">Login</a>
    </div>
    <div class="clean"></div>
</div>
<?php
}
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn = mysqli_query($con,'select username, email, avatar, signup_date from users where id="'.$id.'"');
	if(mysqli_num_rows($dn)>0)
	{
		$dnn = mysqli_fetch_array($dn);
?>
This is the profile of "<?php echo htmlentities($dnn['username']); ?>" :
<?php
if($_SESSION['userid']==$id)
{
?>
<br /><div class="center"><a href="edit_profile.php" class="button">Edit my profile</a></div>
<?php
}
?>
<table style="width:500px;">
	<tr>
    	<td><?php
if($dnn['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
else
{
	echo 'This user has no avatar.';
}
?></td>
    	<td class="left"><h1><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
    	Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br />
        This user joined the website on <?php echo date('Y/m/d',$dnn['signup_date']); ?></td>
    </tr>
</table>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']!=$dnn['username'])
{
?>
<br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['username']); ?>" class="big">  "<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>"</a>
<?php
}
	}
	else
	{
		echo 'This user doesn\'t exist.';
	}
}
else
{
	echo 'The ID of this user is not defined.';
}
?>
		</div>
		</body>
</html>
