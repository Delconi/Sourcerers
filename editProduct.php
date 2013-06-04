<?php include("connect.php");	//Addin from connect.php
checkLogin(); //Checking if User is logged in before continuing//?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Display Website Name
?>Edit product component/product</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<!--
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
-->

<body>
<div id = "mainContent">
<h1 id = "title">Edit product component/product</h1>
<?php 
$pId = $_GET['pId'];
$uId = $_SESSION['userNo'];

$pQuery = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = '$pId' AND ".$pT_ProductUserName." = '$uId'";
$pResult = mysqli_query($connect,$pQuery);
$pRow = mysqli_fetch_assoc($pResult);
?>

<form action = "editProductProcess.php" method = "post">
<input name="pId" type="hidden" value="<?php echo $pId;?>" />
<div id = "formText">Product Name</div>
<div id = "formInput"><input type = "text" id = "pName" name = "pName" value = "<?php
	if (isset($_GET["pName"])||isset($_GET["warning"])){echo $_GET["pName"]."'";}else {echo $pRow[$pT_ProductName];}
?>"/></div>
<div id = "formText">Product Description</div>
<div id = "formInput">
  <textarea name="pDesc" rows="5" id="pDesc"><?php
	if (isset($_GET["pDesc"])||isset($_GET["warning"])){echo $_GET["pDesc"]."'";}else {echo $pRow[$pT_ProductDescription];}
?>
  </textarea>
</div>
<div id = "formText">Product URL</div>
<div id = "formInput"><input type = "text" id = "pUrl" name = "pUrl" value = "<?php
	if (isset($_GET["pUrl"])||isset($_GET["warning"])){echo $_GET["pUrl"]."'";}else {echo $pRow[$pT_ProductUrl];}
?>"/></div>
<div id = "formText">Product Quantity</div>
<div id = "formInput"><input type = "text" id = "pStock" name = "pStock" value = "<?php
	if (isset($_GET["pStock"])||isset($_GET["warning"])){echo $_GET["Stock"]."'";}else {echo $pRow[$pT_ProductQuantity];}
?>"/></div>
<?php if (isset($_GET["warning"])){echo "<div id = 'warning'>Product name cannot be empty.</div>";} ?>
<div id = "submitBtn"><input type = "submit" /></div>
</form>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</div>
</body>
</html>
