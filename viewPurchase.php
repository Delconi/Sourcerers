<?php include ("connect.php");	//Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//
$sessionUserName = $_SESSION['userNo'];

//Taking Purchase Info only from logged in user//
$query = "SELECT * FROM ".$purchaseTable." WHERE ".$puT_PurchaseUserName." = $sessionUserName"." ORDER BY ".$puT_PurchaseDate." DESC";
$result = mysqli_query($connect,$query);
//Taking Purchase Info only from logged in user//

?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Displaying Website Name
?>View all personal purchases</title>
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
<h1 id = "title">View all personal purchases</h1>

<?php
if (isset($_GET["added"])){
	echo "<div id = 'successAdded'>Item successfully added.</div>";	//Display successfully if User just input a purchase
}else if (isset($_GET['deleted'])){
	echo "<div id = 'successAdded'>Item successfully deleted.</div>";	//Display successfully if User deleted a purchase
}else if (isset($_GET['edited'])){
	echo "<div id = 'successAdded'>Item successfully edited.</div>";	//Display successfully if User edited a purchase
}		
?>
<table>
	<tr>
        <td><b>Date</b></td>
        <td><b>Name</b></td>
        <td><b>Supplier</b></td>
        <td><b>Price</b></td>
        <td><b>Quantity</b></td>
        <td><b>Shipping</b></td>
        <td><b>Total</b></td>
        <td><b>Remarks</b></td>
        <td colspan = "2"><b>Option</b></td> 
    </tr>
    <?php
	while($row = mysqli_fetch_assoc($result)){
		?><tr><?php
        echo "<td>".$row[$puT_PurchaseDate]."</td>";
		
		//Fetching Product Name from Product Table//
		$pId = $row[$puT_PurchaseProductNumber];	
		$queryProductName = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = $pId";	
		$productResult = mysqli_query($connect,$queryProductName);
		$rowcategory = mysqli_fetch_assoc($productResult);
		//Fetching Product Name from Product Table//
		
		echo "<td>".$rowcategory[$pT_ProductName]."</td>";
		echo "<td>".$row[$puT_PurchaseManufacturer]."</td>";
		echo "<td>".$row[$puT_PurchasePrice]."</td>";
		echo "<td>".$row[$puT_PurchaseQuantity]."</td>";
		echo "<td>".$row[$puT_PurchaseShippingPrice]."</td>";
		echo "<td>".$row[$puT_TotalPurchasePrice]."</td>";
		echo "<td>".$row[$puT_PurchaseRemarks]."</td>";
		echo "<td><a href = 'editPurchase.php?pId=".$row[$puT_PurchaseNumber]."'>Edit</a></td>";	//Displaying of Edit Button
		echo "<td><a href = 'deletePurchase.php?pId=".$row[$puT_PurchaseNumber]."'>Delete</a></td>";	//Displaying of Delete Button
        ?></tr><?php
	}
	?>
</table>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</div>
</body>
</html>
