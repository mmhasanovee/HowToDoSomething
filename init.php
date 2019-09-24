<?php
// whether the user is logged on
session_start();
header('Content-type: text/html;charset=UTF-8');
if(!isset($_SESSION['username']) and isset($_COOKIE['username'], $_COOKIE['password']))  //user logged in before
{
	$cnn = mysqli_query($con,'select password,id from users where username="'.mysqli_real_escape_string($con,$_COOKIE['username']).'"'); //fetching data from db
	$dn_cnn = mysqli_fetch_array($cnn);
	if(sha1($dn_cnn['password'])==$_COOKIE['password'] and mysqli_num_rows($cnn)>0) //matching password
	{
		$_SESSION['username'] = $_COOKIE['username']; 
		$_SESSION['userid'] = $dn_cnn['id'];
	}
}
?>
