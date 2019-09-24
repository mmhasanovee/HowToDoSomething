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
if(isset($_SESSION['username']))
{

?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a>
    </div>
	<div class="box_right">
    	<a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Logout</a>)
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
    	<a href="<?php echo $url_home; ?>">Forum Index</a>
    </div>
	<div class="box_right">
    	<a href="signup.php">Sign Up</a> - <a href="login.php">Login</a>
    </div>
	<div class="clean"></div>
</div>
<?php
}
?>

<table class="categories_table">

  <div class="flexbox">
  <div class="search">

    <div>
      <input type="search" id="search" name="search" placeholder="       Search . . ." required>
    </div>
  </div>
</div>
  <div>
<input type="button" id="searchbtn" value="Search" style="visibility: hidden;">

  </div>

  <thead>
      <tr>
          <th>Category</th>
          <th>Topic</th>
          <th>Message</th>
          <th>Username</th>

      </tr>
  </thead>
  <tbody id="tablebody">
      <?php
      try{
          $conn=new PDO("mysql:host=localhost:3306;dbname=forumdb",'root','');

          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $ex){
          echo "<script>window.alert('db connection errror')</script>";
      }

      $sqlquery="Select categories.name,topics.title,topics.message,users.username from topics,categories,users where topics.id=users.id and categories.id=topics.parent";
      try{
          $object=$conn->query($sqlquery);
          $table=$object->fetchAll();

          foreach($table as $row){
              ?>
                  <tr>
                      <td><?php echo $row[0] ?></td>
                      <td><?php echo $row[1] ?></td>
                      <td><?php echo $row[2] ?></td>
                      <td><?php echo $row[3] ?></td>

                  </tr>
              <?php
          }

      }
      catch(PDOException $e){
          echo "<script>window.alert('query errror')</script>";
      }
      ?>
  </tbody>
  </table>

  <script>
  var searchdata=document.getElementById('search');

  var searchbtn=document.getElementById('searchbtn');
  searchbtn.addEventListener('click',ajaxfn);

  function ajaxfn(){
      var ajaxreq=new XMLHttpRequest();
      ajaxreq.open('GET','ajaxserve.php?search='+searchdata.value);

      ajaxreq.onreadystatechange=function (){

          if(this.readyState===XMLHttpRequest.DONE && this.status==200){
              var tablebody=document.getElementById('tablebody');
              tablebody.innerHTML=ajaxreq.responseText;
          }
      };

      ajaxreq.send();

  }
  </script>

  <script>
var input = document.getElementById("search");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("searchbtn").click();
  }
});
</script>



</table>
		</div>
		<div class="foot"><a href="http://www.mmhasanovee.xyz">Powered by Md Mehedi Hasan</div>
	</body>
</html>
