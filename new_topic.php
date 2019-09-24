<?php
//This page let users create new topics
include('config.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
if(isset($_SESSION['username']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($con,'select count(c.id) as nb1, c.name from categories as c where c.id="'.$id.'"'));
if($dn1['nb1']>0)
{
?>
<!DOCTYPE>
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>New Topic - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
		<script type="text/javascript" src="functions.js"></script>
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
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <a href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; New Topic
    </div>
	<div class="box_right">
    	<a class="pure-material-button-contained" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> <a class="pure-material-button-contained" href="login.php">Logout</a>
    </div>
	<div class="clean"></div>
</div>
<?php
if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
	include('bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysqli_real_escape_string($con,$title);
	$message = mysqli_real_escape_string($con,bbcode_to_html($message));
	if(mysqli_query($con,'insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$id.'", ifnull(max(id), 0)+1, "1", "'.$title.'", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics'))
	{
	?>
	<div class="message">The topic have successfully been created.<br />
	<a href="list_topics.php?parent=<?php echo $id; ?>">Go to the forum</a></div>
	<?php
	}
	else
	{
		echo 'An error occurred while creating the topic.';
	}
}
else
{
?>
<form action="new_topic.php?parent=<?php echo $id; ?>" method="post">
	<label for="title">Title</label><input type="text" name="title" id="title"  /><br />
    <label for="message">Message</label><br />
    <div class="message_buttons">
        <input type="button" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" /><!--
        --><input type="button" value="Link" onclick="javascript:insert('[url]', '[/url]', 'message');" /><!--
        --><input type="button" value="Left" onclick="javascript:insert('[left]', '[/left]', 'message');" /><!--
        --><input type="button" value="Center" onclick="javascript:insert('[center]', '[/center]', 'message');" /><!--
        --><input type="button" value="Right" onclick="javascript:insert('[right]', '[/right]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input class="pure-material-button-contained" type="submit" value="Send" />
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
	echo '<h2>The category you want to add a topic doesn\'t exist.</h2>';
}
}
else
{
?>
<h2>You must be logged to access this page.</h2>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Username</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>
<?php
}
}
else
{
	echo '<h2>The ID of the category you want to add a topic is not defined.</h2>';
}
?>
