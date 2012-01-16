




<?php

error_reporting(0);

//session_start();
//$title=$_SESSION['TITLE'];
if($_GET['read_title']!==NULL){
$title=$_GET['read_title'];
}
//$str="read.php?read_title=$title>";
//echo "<A href=$str> 'Submit' </A>";

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

$result = mysql_query("SELECT * FROM trade");

while($row = mysql_fetch_array($result)){

//echo $row['name'];
//echo "$title";

if($row['index']=="$title"){


echo "<img src=\"data:image/jpeg;base64,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\" border=0>";

echo "<br>";
echo "name:";
echo "<br>";
echo $row['name'];
echo "<br>";

echo "image:";
echo "<br>";
echo $row['image'];
//$link=$row['link'];
//echo "<a href=http://$link>Link</a>";
//echo "<form action='". $_SERVER['PHP_SELF']."' method='post'>";

//echo "<br>";
//echo "<br>";

//echo "Summary:";
//echo "<br>";


//echo $row['summary'];
//echo "<br>";
//echo "<br>";
//echo "<br>";

echo $row['description'];

echo "<br>";
echo "<br>";

echo "submited by: ";
echo $row['user'];
echo "<br>";echo "<br>";
echo "<br>";

echo "-----------------------------------------------------------";
//$text = $row['text'];




if(isset($_POST['sendemail'])){

    $email= $_POST['email'];
    $message = "Sent by ".$user."     ".$text." ".$link;

// In case any of our lines are larger than 70 characters, we should use wordwrap()
//$message = wordwrap($message, 70);

// Send


mail($email, 'Your Friend Sends you a News!', $message);

}



//echo "<textarea name='showtext' value='$text'>";
//echo $text;
//echo " </textarea>";
//echo "</form>";
//echo "</form>";
//echo $_POST['showtext'];
//$data=$_POST['showtext'];
//$data = mysql_real_escape_string[$data];
}
}


?>






<?php

echo "<br>";


$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);
session_start();
$resultnews = mysql_query('select * from trade',$sqlserver);

if(isset($_POST['edit'])){
//$data=$_POST['showtext'];

echo "edit";
while($rownews=mysql_fetch_array($resultnews)){
if($rownews['name']=="$title"){
        if($rownews['user']==$_SESSION['USER']){


                echo "right user";
echo "inside rownews";
echo $rownews['text'];
$rownews['text']="blah";
$text=$_POST['storyBody'];
echo $text;
mysql_query("UPDATE News SET text='$text' WHERE name = '$title'");

//mysql_query("insert into News (comment) values ('good comment') where ");

        }
   }
}
}

$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);


$resultcomment= mysql_query("SELECT * FROM comments");

echo "<br>";
echo "<br>";


while($row2 = mysql_fetch_array($resultcomment)){

if($row2['name']=="$title"){

//$user=$_SESSION['USER'];

echo $row2['user'];
echo ":";
echo "<br> ";
echo $row2['comment'];
echo "   ";
session_start();

$user=$_SESSION['USER'];

//echo "<br>";
if($boolean==1 || $row2['user'] ==$user){
//echo "lalal";
$commentindex=$row2['index'];
$strdelete="http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/deleteComment.php?delete_comment_index=$commentindex";
$strdelete=mysql_real_escape_string($strdelete);
echo "<a href=$strdelete>Delete</a>";
echo "<br>";





}
echo "<br>";echo "<br> ";

}
}

//$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
//mysql_select_db('wustl',$sqlserver);


//echo"print title";
//echo $title;
session_start();
$_SESSION['NEWSTITLE']=$title;
//$title2=$title;


// session_start();

//$title2=$_SESSION['newstitle'];

//echo "at the beginning session title2:  ";
//echo $title2;

//$title=$comment;
//$title=$_GET['read_title'];
//echo $_SESSION['TITLE'];
if (isset($_POST['submit']))
{

if($user!="guest"){
$comment=$_POST['newcomment'];


session_start();
$_SESSION['comment']=$comment;

echo "<br>";
echo $_SESSION['comment'];

//$comment=$_POST['newcomment'];


//echo $comment;
//session_start();
}else{

echo "Guest cannot submit comment!";
}
}





?>









<title>Trade Inc.</title></head>
<body>

<form enctype="multipart/form-data" action="commentaryTrade.php" method="post">

 <textarea  name="newcomment" width="5000" height="10000"></textarea>
<br>

<input type="submit" name="submit" value="Post Comment" />

</form>


<form enctype="multipart/form-data" action="welcomeTrade.php" method="post">


<input type="submit" name="goback" value="Go Back" />

<br>

</form>

</form>
<form enctype="multipart/form-data"  method="post">
<input type="text" name=email value="type your email here" />
<input type="submit" name="sendemail" value="Send to your friends" />

<br>

</form>




<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank">Share on Facebook</a>
