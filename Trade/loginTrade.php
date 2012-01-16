
<html>
<head><title>Login Page</title></head>
<body>

<form action= <?php echo $_SERVER['PHP_SELF'] ?> method="post">
    <label for="text_field">Username: </LABEL>
    <input type="text" name="username" id="text_field"><BR>
    <label for="text_field">Password: </LABEl>
    <input type="password" name="password" id="text_field"><BR>
    <input type="submit" value="Login">
   <A href="registrationTrade.php"> "registration" </A>

 <!--<input type="submit" name="Register" value="Register">
-->


</form>

<?php

// Turn off all error reporting
error_reporting(0);


session_start();
$_SESSION['LOGINmysql'] =0;
//$_SESSION['USER']=null;
  // if(isset($_POST['username']))
   // echo "<b>", $_POST['user_text'], "</b>";
$username=$_POST['username'];
$password=$_POST['password'];
$hashPassword=crypt($username,$password);

$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);
$result = mysql_query('select * from Users',$sqlserver);

  while($row = mysql_fetch_array($result, MYSQL_BOTH))
  {
   // if( $row['id']==$username && $row['password']==$password){
     //     echo "ok";

       if(crypt($username,$hashPassword)==$row['password']){

        $_SESSION["LOGINmysql"]=1;
        $_SESSION['USER']=$username;

        echo $_SESSION['USER'];
        echo isset($_SESSION["LOGINmysql"]);
}
}

//$username='0';


if(isset($_POST['Register'])==1){

echo "here";
Header("Location:  http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/registrationTrade.php");

}


if($_SESSION["LOGINmysql"]=="1"){
echo "ok";

//      Header("home/hx3/.html/welcome.php");
Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/welcomeTrade.php");
}else{
//        Header("Location: http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/loginMysql.php");
}



?>


