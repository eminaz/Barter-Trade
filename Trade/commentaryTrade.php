











<?php

session_start();
$user=$_SESSION['USER'];

//if($user!="guest"){
$comment =mysql_real_escape_string($_POST['newcomment']);
//echo "newcomment $temp";
//$comment=$_SESSION['comment'];


session_start();

$title=mysql_real_escape_string($_SESSION['NEWSTITLE']);


echo $title;
echo $comment;

$user=mysql_real_escape_string($_SESSION['USER']);

if($user!="guest"){

$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);




mysql_query("insert into comments(name,user,comment) values('$title','$user','$comment')", $sqlserver) or die('Error, insert query failed');
echo $title;
echo $comment;
}else {

echo "Guest cannot submit comment!";

}
$strLocation= "Location:http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/readTrade.php?read_title=$title";

Header($strLocation);


?>















