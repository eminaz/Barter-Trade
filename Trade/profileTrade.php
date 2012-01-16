


<html>

<body>

<form action= <?php echo $_SERVER['PHP_SELF'] ?> method="post">
    <label for="text_field">Add a friend: </LABEL>
    <input type="text" name="rqfriend_name" id="rqfriend_name"><BR>
    <input type="submit" name="friendrequest" value="Send Friend Request"><BR><BR>
	
	
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css"
 
type="text/css" rel="Stylesheet" /> <!-- We need the style sheet linked
 above or the dialogs/other parts of jquery-ui won't display correctly!-->

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script><!-- The main library. 
Note: must be listed before the jquery-ui library -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script><!-- jquery-UI 
hosted on Google's Ajax CDN-->
		
<!--/////////////////////////////////////////////////////////////////////////////////////-->
<!--accept friends-->
<script type="text/javascript">


function acceptfriend(profile_user,pplrq){

/*var xmlHttp;
  xmlHttp=new XMLHttpRequest();

  xmlHttp.open("GET","profileA.php?name="+profile_user,true);

  xmlHttp.onreadystatechange=function()
  {
    if(xmlHttp.readyState==4)
    {
      var pElement=document.getElementById("friendlist");
      pElement.innerHTML=xmlHttp.responseText;
     // pElement.innerHTML=pElement.innerHTML;
    }
  }

  xmlHttp.send(null);*/






$.get("acceptFriend2.php",{'peopleRq': "44"},
		function(data){ 
            
			console.log("data:"+data );
			alert('You have successfully accept: '+pplrq+' as your friend!');
	
		});


$.get("deleteFR.php",{'peopleRq': pplrq},
		function(data){             
			console.log("data:"+data );
		});


// Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileA.php?name=profile_user");



}

function rejectfriend(profile_user,pplrq){
$.get("deleteFR.php",{'peopleRq': pplrq},
		function(data){             
			console.log("data:"+data );
	
		});
alert('You have rejected '+pplrq+'\'s friend request!');
// Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileA.php?name=profile_user");


}


function deletefriend(profile_user,pplrq){

$.get("deleteF.php",{'peopleRq': pplrq},
		function(data){             
			console.log("data:"+data );
			alert('You have deleted friend '+pplrq+' !');
	
		});

//Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileA.php?name=profile_user");


}


</script>



<!--/////////////////////////////////////////////////////////////////////////////////////-->

<?php

error_reporting(0);


session_start();
//$person3=$_SESSION['USER'];
//echo $_SESSION['USER'];
//echo $person3;

$person=$_GET['name'];
echo "Profile for ";
echo $person;
echo "<br>";

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//Friends List
session_start();
$profile_user=$_SESSION['USER'];

$sqlserver_fl=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver_fl);
$result_fl = mysql_query('select * from FriendsInteraction',$sqlserver_fl);

echo "Friend List: ";
echo "<br>";


//echo "<div id=\"friendlist\">";
 while($row = mysql_fetch_array($result_fl, MYSQL_BOTH))
  {
  	if( $row['username']==$profile_user && $row['friends']!==$profile_user){
  	$friendname = $row['friends'];
  	echo $friendname;
  	echo "<br>";
  	echo("<FORM> <INPUT type=button  VALUE='Delete Friend' onClick='deletefriend($profile_user,$friendname)'>
</FORM>");

  	}
  }
//echo "</div>";
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//People Requesting
session_start();
$profile_user=$_SESSION['USER'];

$sqlserver_pr=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver_pr);
$result_pr = mysql_query('select * from FriendsInteraction',$sqlserver_pr);

echo "People Requesting: ";
echo "<br>";

 while($row = mysql_fetch_array($result_pr, MYSQL_BOTH))
  {
  	if( $row['username']==$profile_user && $row['people_requesting']!==$profile_user){
  	$pplrq = $row['people_requesting'];
  	echo $pplrq;
  	echo "<br>";
	echo("<FORM> <INPUT type=button  VALUE='Accept' onClick='acceptfriend($profile_user,$pplrq)'>
</FORM>");
	echo("<FORM> <INPUT type=button  VALUE='Reject' onClick='rejectfriend($profile_user,$pplrq)'>
</FORM>");


  	}
  }  
//////////////////////////////////////////////////////////////////////////////////  
//////////////////////////////////////////////////////////////////////////////////
//Sending Friend Request//

if(isset($_POST['friendrequest'])){

$rqfriendname=$_POST['rqfriend_name'];

//Check if friend requested exist
$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);
$result = mysql_query('select * from user2',$sqlserver);
$rfname = mysql_real_escape_string($rqfriendname); 
$query = "SELECT * FROM user2 WHERE username='$rfname';"; 
$res = mysql_query($query);

////////////////////////////////////////////////////////////
//Check if already friends
$sqlserver_f=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver_f);
$result_f = mysql_query('select * from FriendsInteraction',$sqlserver_f);
$rf_f = mysql_real_escape_string($rqfriendname); 
$query_f = "SELECT * FROM FriendsInteraction WHERE friends='$rf_f' && username=$rqfriendname;"; 
$res_f = mysql_query($query_f);

if(mysql_num_rows($res_f)>0){
	echo ("You are already friends!");
	//Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileA.php?name=$profile_user");

}else{
////////////////////////////////////////////////////////////
	//Send Request
	if (mysql_num_rows($res)>0) {
	session_start();
	//Insert friend requesting
	$person2=$_SESSION['USER'];
	$sqlserver2=mysql_connect('localhost','wustl_i','wustl_pass');
	mysql_select_db('wustl',$sqlserver2);
	$result2 = mysql_query('select * from FriendsInteraction',$sqlserver2);

	mysql_query("insert into FriendsInteraction values ('$rqfriendname','$rqfriendname','$person2','$rqfriendname')", $sqlserver2) or die('Error, insert query failed');
	
	}else {
		echo "No such user exists!";
	}
//Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileA.php?name=$person2");


}

}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

 if(isset($_POST['info']) && isset($_POST['person'])){
 
//$person=$_GET['name'];
$person=$_POST['person'];

     Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/info.php?user=$person");
}

?>



<br><br><br>
<form action= <?php echo $_SERVER['PHP_SELF'] ?> method="post">

<input type="hidden" name="person" value="<?php echo $person?>">

<input type="submit" name="info"   value="personal info">

</form>

</body>
</html>

























<?php
//list the items of the user
session_start();
$user=$_SESSION['USER'];




    if(isset($_POST['logout']) ||  $_SESSION['LOGINmysql']==0 ){
     $_SESSION['LOGINmysql']=0;
    // echo "ok";
     Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/loginMysql.php");
}

    if(isset($_POST['profile']) &&  $_SESSION['LOGINmysql']==1 ){

     Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/profileTrade.php?name=$user");
}


//add an event to the list, if submit button is pressed
if(isset($_POST['Submit'])){

echo "here";
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
//$user=$_SESSION['USER'];

$user=$_GET['name'];


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
$username= $row['user'];
$name= $row['name'];



if($username==$user){


echo $name;

$index=$row['index'];

$str="http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/readTrade.php?read_title=$index";

//session_start();
//$_SESSION['newsname']=$name;
//echo "<br>";

echo " ";
echo "by ";
echo $username;
echo " ";
echo "<a href=$str>Check it</a>";
echo "<br>";


if($boolean==1){

$strdelete="http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/deleteMysql.php?delete_title=$name"; 

echo "<a href=$strdelete>Delete</a>";
echo "<br>";

}
}
}

?>




<br>
<br>
<br>

<form enctype="multipart/form-data" action="welcomeTrade.php" method="post">


<input type="submit" name="goback" value="Go Back" />

<br>

</form>

