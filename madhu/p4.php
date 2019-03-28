<!DOCTYPE html>
<html>
<head>
	<title>withdraw</title>
</head>
<body>
	<?php
		$bal="";
		$er="";
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if(empty($_POST["amt"]))
			{
				$er="enter the amount";
			}
			else
			{
				if(!preg_match('/^[0-9]+$/',$_POST["amt"]))
				{
					$er="invalid amount";
				}
				else
				{
					$con=new mysqli("localhost","root","","web");
					if($con->error)
					{
						die("error".$con->error);
					}
					else
					{
						$acc="111";
						$sql="SELECT bal from table2 where acc='$acc'";
						$r=$con->query($sql);
						if($r->num_rows>0)
						{
							while($row=$r->fetch_assoc())
							{
								if($_POST["amt"]>$row["bal"])
								{
									$er="no money";
								}	
								else
								{
									$val=$row["bal"]-$_POST["amt"];
									$sql1="UPDATE table2 set bal='$val' where acc='$acc'";
									$bal=$val;
								}
							}
						}
						
					}
				}

			}
		}
	?>
	<form method="post" action="p4.php">
		Enter amount:<input type="number" name="amt"><span class="error">*<?php echo $er; ?>
		Balance:<?php echo $bal; ?>
		<input type="submit" value="credit">
	</form>
</body>
</html>