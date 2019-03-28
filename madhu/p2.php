
<!DOCTYPE html>
<html>
<head>
	<style>
	.error{color:#FF0000;}
	</style>
	<title>Login page</title>
</head>
<body>
	<?php session_start();?>

<?php 
	$login=$loginerr=$pass="";
		
	$_time=$_SERVER["REQUEST_TIME"];
	if(isset($_SERVER["LAST_ACTIVITY"]) && $time-$_SERVER["LAST_ACTIVITY"]>1800)
	{
		session_unset();
		session_destroy();
		sessino_restart();
	}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($_POST["login"]))
			$loginerr="no login";
		else
			if(empty($_POST["pass"]))
				$loginerr="no pass";
			else
			{
				$server="localhost";
				$user="root";
				$pa="";
				$db="web";
				$con=new mysqli($server,$user,$pa,$db);
				if($con->error){
					die("ERROR".$con->error);
				}
				$l=$_POST["login"];
				$p=$_POST["pass"];
				$sql="SELECT login,pass from table1 where login='$l'and pass='$p';";
				$r=$con->query($sql);
				if($r->num_rows==0)
				{
					$loginerr="invalid login";
					$login="";
					$pass="";
				}
				else
				{
					$login=$_POST["login"];
					header('Location:p3.php?login='.$login);
				}
				$con->close();
			}
	}
?>
<div >
<form method="post" action=<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?> >
	Login:<input type="text" name="login" value=<?php echo $login; ?> ><span class="error">*<?php  echo $loginerr; ?></span><br>
	Password:<input type="Password" name="pass" value=<?php echo $pass; ?> ><br>
	<input type="submit" value="submit">
</form>	
</div>
</body>
</html>