<?php 
include ("connect.php");	//Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//
$sessionUserName = $_SESSION['userNo'];	//Retriving userno from session

//Taking Order Info only from logged in user//
$query = "SELECT * FROM ".$orderTable." WHERE ".$oT_OrderUserName." = $sessionUserName"." ORDER BY ".$oT_OrderDate." DESC";
$result = mysqli_query($connect,$query);
//Taking Order Info only from logged in user//
?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Displaying of Website Name
?>View all customer orders</title>
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
<h1 id = "title">View all customer orders</h1>
<?php
if (isset($_GET["added"])){
	echo "<div id = 'successAdded'>Item successfully added.</div>";	//Display successfully if User input an order
}else if (isset($_GET['deleted'])){
	echo "<div id = 'successAdded'>Item successfully deleted.</div>";	//Display successfully if User delete an order
}else if (isset($_GET['edited'])){
	echo "<div id = 'successAdded'>Item successfully edited.</div>";	//Display successfully if User edited an order
}	
?>
<table>
	<tr>
		<td><b>Date</b></td>
        <td><b>Customer</b></td>
        <td><b>Product</b></td>
        <td><b>Price</b></td>
        <td><b>Quantity</b></td>
        <td><b>Misc</b></td>
        <td><b>Total</b></td>
        <td><b>Remarks</b></td>
        <td colspan = "2"><b>Option</b></td>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)){
		?><tr><?php
			echo "<td>".$row[$oT_OrderDate]."</td>";
			echo "<td>".$row[$oT_OrderCostumerName]."</td>";
			
			//Fetching Product Name from Product Table//
			$pId = $row[$oT_OrderProductName];	
			$queryProductName = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = $pId";	
			$productResult = mysqli_query($connect,$queryProductName);
			$rowcategory = mysqli_fetch_assoc($productResult);
			//Fetching Product Name from Product Table//
		
			echo "<td>".$rowcategory[$pT_ProductName]."</td>";
			echo "<td>".$row[$oT_OrderPrice]."</td>";
			echo "<td>".$row[$oT_OrderQuantity]."</td>";
			echo "<td>".$row[$oT_OrderMisc]."</td>";
			echo "<td>".$row[$oT_TotalCost]."</td>";
			echo "<td>".$row[$oT_OrderRemarks]."</td>";
			echo "<td><a href = 'editOrder.php?oId=".$row[$oT_OrderNumber]."'>Edit</a></td>";	//Displaying of Edit Button
			echo "<td><a href = 'deleteOrder.php?oId=".$row[$oT_OrderNumber]."'>Delete</a></td>";	//Displaying of Delete Button
			?>
        </tr><?php
	}
	?>
</table>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</div>
</body>
</html>
