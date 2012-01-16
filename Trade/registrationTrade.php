












<html>
<head><title>Resgistration Page</title></head>
<body>

<form action= <?php echo $_SERVER['PHP_SELF'] ?> method="post">
    <label for="text_field">Username: </LABEL>
    <input type="text" name="username" id="text_field"><BR>
    <label for="text_field">Password: </LABEl>
    <input type="password" name="password" id="text_field"><BR>
    <input type="submit" value="Register" name="Register">
</form>

<?php
if(isset($_POST['Register'])){
$username=mysql_real_escape_string($_POST['username']);
$password=mysql_real_escape_string($_POST['password']);
$hash=crypt($username,$password);
echo $username;
$sqlserver=mysql_connect('localhost','wustl_i','wustl_pass');
mysql_select_db('wustl',$sqlserver);
mysql_query("insert into Users values ('$username','$hash','0')", $sqlserver) or die('Error, insert query failed');


Header("Location:http://ec2-50-19-207-165.compute-1.amazonaws.com/~hx3/loginTrade.php");


}


?>