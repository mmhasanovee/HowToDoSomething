<?php

include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
         <link rel="icon" href="default/images/icon.png" type="image" sizes="16x16">
        <title>Forum</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"> <span class="headtext" style="font-size:350%;margin-top:-5px;"> How To Do Something?</span>
	    </div>
        <div class="content">
<?php
if(isset($_SESSION['username'])) //if already logged in
{

?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a>
    </div>
	<div class="box_right">
    	<a class="pure-material-button-contained" href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> <a class="pure-material-button-contained" href="login.php">Logout</a>
    </div>
	<div class="clean"></div>
</div>
<?php
}
else //not logged in, so prompt the log in/sign up box always...
{
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a>
    </div>
	<div class="box_right">
    	<a class="pure-material-button-contained" href="signup.php">Sign Up</a> - <a class="pure-material-button-contained"  href="login.php">Login</a>
    </div>
	<div class="clean"></div>
</div>
<?php
}
if(isset($_SESSION['username']) and $_SESSION['username']==$admin) //when logged in as admin, New category button will be available..
{
?>
	<a href="new_category.php" class="pure-material-button-contained">Add New Category</a>
  <span><a href="search.php" style="text-align: right;float: right;" class="pure-material-button-contained" target="_blank">Search Forum</a> </span>
<?php
}
?>

<?php
if(isset($_SESSION['username']) and $_SESSION['username']!=$admin) //logged in as user, so no button for new cat..
{
?>
	<span><a href="search.php" style="text-align: right;float: right;" class="pure-material-button-contained" target="_blank">Search Forum</a> </span>
<?php
}
?>

<table class="categories_table">
	<tr>
    	<th class="forum_cat">Category</th>
    	<th class="forum_ntop">Topics</th>
    	<th class="forum_nrep">Replies</th>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    	<th class="forum_act">Action</th>
<?php
}
?>
	</tr>
<?php
$dn1 = mysqli_query($con,'select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$nb_cats = mysqli_num_rows($dn1);
while($dnn1 = mysqli_fetch_array($dn1))
{
?>
	<tr>
    	<td class="forum_cat"><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <div class="description"><?php echo $dnn1['description']; ?></div></td>
    	<td><?php echo $dnn1['topics']; ?></td>
    	<td><?php echo $dnn1['replies']; ?></td>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    	<td><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/delete.png" alt="Delete" /></a>
		<?php if($dnn1['position']>1){ ?><a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/up.png" alt="Move Up" /></a><?php } ?>
		<?php if($dnn1['position']<$nb_cats){ ?><a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/down.png" alt="Move Down" /></a><?php } ?>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/edit.png" alt="Edit" /></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>

<?php
}
if(!isset($_SESSION['username']))
{
?>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Username</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input class="pure-material-button-contained" type="submit" value="Login" /> <input class="pure-material-button-contained" type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>
<?php
}
?>
		</div>
		<div class="foot"><a href="http://www.mmhasanovee.xyz">Powered by Md Mehedi Hasan</div>
	</body>
</html>
