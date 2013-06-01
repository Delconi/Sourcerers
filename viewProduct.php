<?php
include ("connect.php");  //Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//
$sessionUserName = $_SESSION['userNo'];	//Retrieving userno from session

//Taking Product Info only from logged in user//
$query = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductUserName." = $sessionUserName"." ORDER BY ".$pT_ProductName." ASC";
$result = mysqli_query($connect,$query);
//Taking Product Info only from logged in user//

?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Displaying Website Name
?>View inventory</title>
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
<h1 id = "title">View inventory</h1>

<?php
if (isset($_GET["added"])){
	echo "<div id = 'successAdded'>Item successfully added.</div>"	;	//Display successfully if User just input a product
}else if (isset($_GET['deleted'])){
	echo "<div id = 'successAdded'>Item successfully deleted.</div>";	//Display successfully if User just deleted a product
}else if (isset($_GET['edited'])){
	echo "<div id = 'successAdded'>Item successfully edited.</div>";	//Display successfully if User just edited a product
}	
?>
<table>
	<tr id = "mainHeader">
        <td>Product Name</td>
        <td>Quantity</td>
        <td>Description</td>
        <td>Url</td>
    </tr>
    <?php
	while($row = mysqli_fetch_assoc($result)){
		?><tr><?php
        echo "<td>".$row[$pT_ProductName]."</td>";
		echo "<td>".$row[$pT_ProductQuantity]."</td>";
		echo "<td>".$row[$pT_ProductDescription]."</td>";
		echo "<td>".$row[$pT_ProductUrl]."</td>";
		echo "<td><a href = 'editProduct.php?pId=".$row[$pT_ProductNumber]."'>Edit</a></td>";	//Displaying of Edit Button
		echo "<td><a href = 'deleteProduct.php?pId=".$row[$pT_ProductNumber]."'>Delete</a></td>";	//Displaying of Delete Button
        ?></tr><?php
	}
	?>
</table>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</body>
</html>
