<?php include("connect.php");  //Addin from connect.php

/*
************************************************************************
Sourcerers
Copyright (c) 2013 Del, Jordon Koh, Low Guan Hong
Released under the GNU General Public License version 3

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
*/

checkLogin(); //Checking if User is logged in before continuing//?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Display Website Name
?>Add a product component/product</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1 id = "title">Add a product component/product</h1>
<?php if (isset($_GET['noPro'])){echo "<div id = 'warning'>Add a Product before adding Orders/Purchases</div>";}?>
<form action = "addProductProcess.php" method = "post">
<div id = "formText">Product Name</div>
<div id = "formInput"><input type = "text" name = "pName" <?php
if (isset($_GET["pName"])){echo "value = '".$_GET["pName"]."'";}	//If input data is wrong, return to form with values//
?>/></div>
<?php 
if(isset($_GET['eField'])){
	echo "<div id = 'warning'>Product name cannot be empty</div>";
}else if (isset($_GET["warning"])){echo "<div id = 'warning'>Same product name already existed</div>";
} ?>
<div id = "formText">Product Description</div>
<div id = "formInput"><input type = "text" name = "pDesc" <?php
if (isset($_GET["pDesc"])){echo "value = '".$_GET["pDesc"]."'";}	//If input data is wrong, return to form with values//
?>/></div>
<div id = "formText">Product URL</div>
<div id = "formInput"><input type = "text" name = "pUrl" <?php
if (isset($_GET["pUrl"])){echo "value = '".$_GET["pUrl"]."'";}	//If input data is wrong, return to form with values//
?>/></div>
<div id = "submitBtn"><input type = "submit" /></div>
</form>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</body>
</html>
