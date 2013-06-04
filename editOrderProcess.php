<?php
include ("connect.php");	//Addin from connect.php

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

if(empty($_POST["oCustomer"])||empty($_POST["oPrice"])||empty($_POST["oQuantity"])||typeCheck($_POST["oPrice"],'numeric',255)!=TRUE||typeCheck($_POST["oQuantity"],'numeric',255)!=TRUE){
	header("location:editOrder.php?eField=1&dCustomerName=".$_POST["oCustomer"]."&dPrice=".$_POST["oPrice"]."&dQuantity=".$_POST["oQuantity"]."&dMisc=".$_POST["oMisc"]."&dRemarks=".$_POST["oRemarks"]."&dYear=".$_POST["oYear"]."&dMonth=".$_POST["oMonth"]."&dDay=".$_POST["oDay"]."&dProduct=".$_POST["oNumber"]."&oId=".$_POST["oId"]); 
}else{
	//Receiving input from form//
	$oOrderNo = $_POST["oId"];
	$oDateInput = $_POST["oDateOfInput"];
	$oDatePurchase = $_POST["oYear"]."-".$_POST["oMonth"]."-".$_POST["oDay"];
	$oProductNumber = $_POST["oNumber"];
	$oCustomerName = $_POST["oCustomer"];
	$oPrice = $_POST["oPrice"];
	$oQuantity = $_POST["oQuantity"];
	$oMisc = $_POST["oMisc"];
	$oTotal = $oPrice * $oQuantity + $oMisc;	//Calculating Total Cost
	$oRemarks = $_POST["oRemarks"];
	//Receiving input from form//
	
	$sessionUserName = $_SESSION['userNo'];	//Taking User number from session
	
	//Reducing the Quantity on the specific product affected//
	$oldQueryQuantity = "SELECT * FROM ".$orderTable." WHERE ".$oT_OrderNumber." = '$oOrderNo'";	//Retrieving Old Quantity from Order Table
	$oldQuantityResult = mysqli_query($connect,$oldQueryQuantity);
	$oldQuantityRow = mysqli_fetch_assoc($oldQuantityResult); 
	
	$queryQuantity =  "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = $oProductNumber";	//Retrieving current Quantity from Product Table
	$quantityResult = mysqli_query($connect,$queryQuantity);
	$quantityRow = mysqli_fetch_assoc($quantityResult); 
	
	$upDateQuantity = $quantityRow[$pT_ProductQuantity] - ($oQuantity - $oldQuantityRow[$oT_OrderQuantity]);	//Calculating new Quantity
	
	$updateQuery = "UPDATE $productTable SET $pT_ProductQuantity = $upDateQuantity WHERE $pT_ProductNumber = '$oProductNumber' AND $pT_ProductUserName = '$sessionUserName'";
	$updateResult = mysqli_query($connect,$updateQuery);
	//Reducing the Quantity on the specific product affected//
	
	$updateOrderQuery = "UPDATE ".$orderTable." SET $oT_OrderInput = '$oDateInput', $oT_OrderDate = '$oDatePurchase', $oT_OrderCostumerName = '$oCustomerName', $oT_OrderPrice = '$oPrice', $oT_OrderQuantity = '$oQuantity', $oT_OrderMisc = '$oMisc', $oT_TotalCost = '$oTotal', $oT_OrderRemarks = '$oRemarks' WHERE $oT_OrderNumber = '$oOrderNo' AND $oT_OrderUserName = '$sessionUserName'";
	$updateOrderResult = mysqli_query($connect,$updateOrderQuery);
	
	header("location:viewOrder.php?edited=1");	//Direct to View Inventory after Done
}
?>
