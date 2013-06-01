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
$reDirect = "location:addOrder.php?eField=1&dManu=".$_POST ["pManufacturer"]."&dPri=".$_POST["pPrice"]."&dQua=".$_POST ["pQuantity"]."&dShip=".$_POST["pShipping"]."&dTax=".$_POST["pTax"]."&dSell=".$_POST["pSellPrice"]."&dRem=".$_POST["pRemarks"]."&dDay=".$_POST["pDay"]."&dMon=".$_POST["pMonth"]."&dYear=".$_POST["pYear"]."&dNo=".$_POST ["pPNo"]."&dMisc=".$_POST["oMisc"];

if(empty($_POST ["oNumber"])){
	header($reDirect.'&ePro=1');
	}else if(empty($_POST["oCustomer"])||empty($_POST["oPrice"])||empty($_POST["oMisc"])||empty($_POST["oNumber"])||empty($_POST["oQuantity"])||typeCheck($_POST["oPrice"],'numeric',255)!=TRUE||typeCheck($_POST["oQuantity"],'numeric',255)!=TRUE){
	header($reDirect);
}else{
	//Receiving input from form//
	$oDateInput = $_POST["oDateOfInput"];
	$oDatePurchase = $_POST["oYear"]."-".$_POST["oMonth"]."-".$_POST["oDay"];
	$oProductNumber = $_POST["oNumber"];
	$oCustomerName = $_POST["oCustomer"];
	$oPrice = $_POST["oPrice"];
	$oQuantity = $_POST["oQuantity"];
	$oMisc = $_POST["oMisc"];
	$oTotal = $oPrice * $oQuantity + $oMisc;
	$oRemarks = $_POST["oRemarks"];
	//Receiving input from form//
	$sessionUserName = $_SESSION['userNo'];	//Taking User number from session
	
	//Inserting individual value into database//
	$query = "INSERT INTO $orderTable($oT_OrderInput, $oT_OrderDate, $oT_OrderProductName, $oT_OrderCostumerName, $oT_OrderPrice, $oT_OrderQuantity, $oT_OrderMisc, $oT_TotalCost, $oT_OrderRemarks, $oT_OrderUserName) VALUES ('$oDateInput', '$oDatePurchase', '$oProductNumber', '$oCustomerName', '$oPrice', '$oQuantity', '$oMisc', '$oTotal', '$oRemarks', '$sessionUserName')";	
	$result = mysqli_query($connect,$query);	
	//Inserting individual value into database//
	
	//Reducing the Quantity on the specific product affected//
	$queryQuantity =  "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = $oProductNumber";
	$quantityResult = mysqli_query($connect,$queryQuantity);
	$quantityRow = mysqli_fetch_assoc($quantityResult);
	$currentQuantity = $quantityRow[$pT_ProductQuantity]-$oQuantity;
	
	$updateQuery = "UPDATE $productTable SET $pT_ProductQuantity = $currentQuantity WHERE $pT_ProductNumber = $oProductNumber AND $oT_OrderUserName = '$sessionUserName'";
	$updateResult = mysqli_query($connect,$updateQuery);
	//Reducing the Quantity on the specific product affected//
	
	header("location:viewOrder.php?added=1");	//Direct to View Inventory after Done
}
?>
