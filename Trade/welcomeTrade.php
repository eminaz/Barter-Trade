<br>
<br>


<html>
<head><title>Welcome Page</title></head>
<body>

<form action= <?php echo $_SERVER['PHP_SELF'] ?> method="post">
    <input type="submit" name="logout"   value="Logout">
  <input type="submit" name="profile" value="Profile Page">
<br><br>
<label>Item Name: </Label>
<br>
<input type="text"  name="name">


<br><br>
<label>Image URL: </Label>
<br>

<input type="text"  name="image">



<br><br>
<label>Description: </Label>
<br>

 <textarea   name="description" width="5000" height="10000"></textarea>
<br>
<br>

 <input type="submit" name="Submit" value="Submit Your Item">


</form>






<br>

<?php
// Turn off all error reporting
error_reporting(0);

session_start();
$user=$_SESSION['USER'];




    if(isset($_POST['logout']) ||  $_SESSION['LOGINmysql']==0 ){
     $_SESSION['LOGINmysql']=0;
    // echo "ok";
     Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/loginTrade.php");
}

    if(isset($_POST['profile']) &&  $_SESSION['LOGINmysql']==1 ){

     Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileTrade.php?name=$user");
}


//add an event to the list, if submit button is pressed
if(isset($_POST['Submit'])){

//echo "here";
$name=$_POST['name'];
$image=$_POST['image'];
$description=$_POST['description'];


//echo $name;

if($user!="guest"){
$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);
mysql_query("insert into trade values ('$name','$image','$description','$user','')", $sqlserver) or die(mysql_error());
}
else {echo "Guest cannot submit stories!";}

}





$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);

$result = mysql_query('select * from Users',$sqlserver);
$boolean=0;
session_start();
$user=$_SESSION['USER'];

  while($row = mysql_fetch_array($result))
  {
     if($user==$row['id'] && $row['Administrator']==1){

     $boolean=1;
  }
}

$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);
$result=mysql_query("SELECT * FROM trade");
while($row = mysql_fetch_array($result)){

$name= $row['name'];
$username= $row['user'];

echo $name;

$index=$row['index'];

$str="http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/readTrade.php?read_title=$index";

$str2="http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileTrade.php?name=$username";

//session_start();
//$_SESSION['newsname']=$name;
//echo "<br>";

echo " ";
echo "by ";
echo "<a href=$str2>$username</a>";
echo " ";
echo " <tr>&nbsp   &nbsp &nbsp &nbsp &nbsp </tr>    ";echo " <tr>&nbsp   &nbsp &nbsp &nbsp &nbsp </tr>    ";

echo "<a href=$str>Check it</a>";
echo "<br>";


if($boolean==1){

$strdelete="http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/deleteMysql.php?delete_title=$name"; 

echo "<a href=$strdelete>Delete</a>";
echo "<br>";

}
}

?>


<style>
body {background-image:url('http://awesomewallpapers.files.wordpress.com/2009/08/white_withoutlogo_1920x1200.jpg');}
</style>

