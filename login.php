<?php
//This page let log in
include('config.php');
if(isset($_SESSION['username']))  //logs out if comes in login after logged in.
{
	unset($_SESSION['username'], $_SESSION['userid']);
	setcookie('username', '', time()-100);
	setcookie('password', '', time()-100);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:350%;margin-top:-5px;"> How To Do Something?</span>
	    </div>
<div class="message">You have successfully been logged out.<br />
<a href="<?php echo $url_home; ?>">Home</a></div>
<?php
}
else
{
	$ousername = '';
	if(isset($_POST['username'], $_POST['password']))
	{
		if(get_magic_quotes_gpc()) //This is to prevent all sorts of injection security issues. replaced by backslashes('' "" 'null' "\")
		{
			$ousername = stripslashes($_POST['username']); //stripslashes removes the backslashes
			$username = mysqli_real_escape_string(stripslashes($con,$_POST['username'])); //res escapes special characters..
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysqli_real_escape_string($con,$_POST['username']);
			$password = $_POST['password'];
		}
		$req = mysqli_query($con,'select password,id from users where username="'.$username.'"');
		$dn = mysqli_fetch_array($req);
		if($dn['password']==sha1($password) and mysqli_num_rows($req)>0)
		{
			$form = false;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
			if(isset($_POST['memorize']) and $_POST['memorize']=='yes')
			{
				$one_year = time()+(60*60*24*365);
				setcookie('username', $_POST['username'], $one_year);
				setcookie('password', sha1($password), $one_year);
			}
?>
<!DOCTYPE html>
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:350%;margin-top:-5px;"> How To Do Something?</span>
	    </div>
<div class="message">You have successfully been logged.<br />
<a href="<?php echo $url_home; ?>">Go home</a></div>
<?php
		}
		else
		{
			$form = true;
			$message = 'Invalid username or password';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:350%;margin-top:-5px;"> How To Do Something?</span>
	    </div>
<?php
if(isset($message))
{
	echo '<div class="message">'.$message.'</div>';
}
?>
<div class="content">
<?php

?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; Login
    </div>
	<div class="box_right">
     </a>
    </div>
    <div class="clean"></div>
</div>
    <form action="login.php" method="post">
        Invalid inputs:<br />
        <div class="login">
            <label for="username">Username</label><input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
            <label for="password">Password</label><input type="password" name="password" id="password" /><br />
            <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" /><br />
            <input class="pure-material-button-contained" type="submit" value="Login" />
		</div>
    </form>
</div>
<?php
	}
}
?>
<div class="foot"><a href="http://www.mmhasanovee.xyz">Powered by Md Mehedi Hasan</div>
			</body>
</html>
