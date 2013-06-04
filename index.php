<?php session_start();
if(isset($_SESSION["user"]))	//Checking if there's anything in session
{
	header("location:index2.php");	//Go to menu if already logged in	
}
?>
<html>
<head>
<title>Ecommerce</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<!--
************************************************************************
Sourcerers
Copyright (c) 2013 Del, Jordon Koh, Low Guan Hong
Released under the GNU General Public License

This file is part of Sourcerers

Sourcerers is free software: you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

A copy of the GNU General Public License is enclosed.
************************************************************************
For any enquiries, contact Del via email at magnadel@hotmail.com, Jordon Koh at jordonkoh@hotmail.com, or Low Guan Hong at grapefood@hotmail.com
-->

<body>
<div id = "mainContent">
<div id = "descContent">where we believe web exist to help everyone and not just to earn money</div>
<br>
<form action = "userProcess.php" method = "post"><input id = "formInputUser" onfocus = "if (this.value=='Username') this.value = ''" onBlur="if (this.value=='') this.value = 'Username'" name = "uName" type = "text" value = "<?php 
if(!empty($_GET['previousUser'])){	
	echo $_GET['previousUser'];	//Return previously input username if redirected back
}else {
	echo "Username";
}
?>"/>
<input id = "formInputPassword" type = "password" name = "uPass" onfocus = "if (this.value=='Password') this.value = ''" onBlur="if (this.value=='') this.value = 'Password'" value = "Password"/></div>
<div id = "tips">-Don't have an account? Just type in an username of your choice and password. An account will then be generated for you!-</div>
<div id = "warning">
<?php
if($_GET['emptyField']==1){	//Warning if Username is less than 4 characters
	echo "Username must be 4 characters or more and cannot be empty.";
	}	
if($_GET['emptyPass']==1){	//Warning if Passwordi s less than 8 characeters
	echo "Password must be 8 characters or more and cannot be empty.";
	}
if($_GET['wrongPass']==1){	
echo "Wrong password / Username already taken.";}	//Warning if a password does not match with db
else if($_GET['logout']==1){echo "Successfully logged out.";}	//Warning after logged out
?>
</div>
<input id = "submitBtnIndex" type = "submit" />
</form>

</div>
</body>
</html>
