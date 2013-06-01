<?php
include ("connect.php");  //Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//

$oId = $_GET['pId'];
$uId = $_SESSION['userNo'];

$deletePurchaseQuery = "DELETE FROM ".$purchaseTable." WHERE ".$puT_PurchaseProductNumber." =  '$oId' AND ".$puT_PurchaseUserName." = '$uId'";
$deletePurchaseResult = mysqli_query($connect,$deletePurchaseQuery);

$deleteOrderQuery = "DELETE FROM ".$orderTable." WHERE ".$oT_OrderProductName." =  '$oId' AND ".$oT_OrderUserName." = '$uId'";
$deleteOrderResult = mysqli_query($connect,$deleteOrderQuery);

$deleteProductQuery = "DELETE FROM ".$productTable." WHERE ".$pT_ProductNumber." =  '$oId' AND ".$pT_ProductUserName." = '$uId'";
$deleteProductResult = mysqli_query($connect,$deleteProductQuery);
header("location:viewProduct.php?deleted=1");
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
