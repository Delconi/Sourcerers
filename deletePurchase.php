<?php
include ("connect.php");  //Addin from connect.php

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

checkLogin();	//Checking if User is logged in before continuing//

$pId = $_GET['pId'];	//Retrieving Purchase that is suppose to be deleted
$uId = $_SESSION['userNo'];	//Retrieving user from session

//Retrieving Old quantity from Purchase table//
$oQuantityQuery = "SELECT * FROM ".$purchaseTable." WHERE ".$puT_PurchaseNumber." = '$pId' AND ".$puT_PurchaseUserName." = '$uId'";
$oQuantityResult = mysqli_query($connect,$oQuantityQuery);
$oQuantityRow = mysqli_fetch_assoc($oQuantityResult);
//Retrieving Old quantity from Purchase table//

$oProductRow = $oQuantityRow[$puT_PurchaseProductNumber];

//Retrieving current quantity from product table//
$pQuantityQuery = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = '$oProductRow' AND ".$pT_ProductUserName." = '$uId'";
$pQuantityResult = mysqli_query($connect,$pQuantityQuery);
$pQuantityRow = mysqli_fetch_assoc($pQuantityResult);
//Retrieving current quantity from product table//

$updatedQuantity = $pQuantityRow[$pT_ProductQuantity] - $oQuantityRow[$puT_PurchaseQuantity];	//Calculating updating quantity

$updateQuery = "UPDATE $productTable SET $pT_ProductQuantity = $updatedQuantity WHERE $pT_ProductNumber = '$oProductRow'";
$updateResult = mysqli_query($connect,$updateQuery);

$query = "DELETE FROM ".$purchaseTable." WHERE ".$puT_PurchaseNumber." =  '$pId' AND ".$puT_PurchaseUserName." = '$uId'";
$result = mysqli_query($connect,$query);
header("location:viewPurchase.php?deleted=1");
?>
