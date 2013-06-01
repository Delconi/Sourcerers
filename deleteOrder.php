<?php
include ("connect.php");  //Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//

$oId = $_GET['oId'];
$uId = $_SESSION['userNo'];

$oQuantityQuery = "SELECT * FROM ".$orderTable." WHERE ".$oT_OrderNumber." = '$oId' AND ".$oT_OrderUserName." = '$uId'";
$oQuantityResult = mysqli_query($connect,$oQuantityQuery);
$oQuantityRow = mysqli_fetch_assoc($oQuantityResult);

$oProductRow = $oQuantityRow[$oT_OrderProductName];

$pQuantityQuery = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = '$oProductRow' AND ".$pT_ProductUserName." = '$uId'";
$pQuantityResult = mysqli_query($connect,$pQuantityQuery);
$pQuantityRow = mysqli_fetch_assoc($pQuantityResult);

$updatedQuantity = $pQuantityRow[$pT_ProductQuantity] + $oQuantityRow[$oT_OrderQuantity];

$updateQuery = "UPDATE $productTable SET $pT_ProductQuantity = $updatedQuantity WHERE $pT_ProductNumber = '$oProductRow'";
$updateResult = mysqli_query($connect,$updateQuery);

$query = "DELETE FROM ".$orderTable." WHERE ".$oT_OrderNumber." =  '$oId' AND ".$oT_OrderUserName." = '$uId'";
$result = mysqli_query($connect,$query);
header("location:viewOrder.php?deleted=1");
?>

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
