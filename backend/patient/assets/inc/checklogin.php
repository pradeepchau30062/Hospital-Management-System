<?php
function check_login()
{
if(strlen($_SESSION['pat_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="pat_login.php";
		$_SESSION["pat_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
