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
$reDirect = "location:addPurchase.php?eField=1&dManu=".$_POST ["pManufacturer"]."&dPri=".$_POST["pPrice"]."&dQua=".$_POST["pQuantity"]."&dShip=".$_POST["pShipping"]."&dRem=".$_POST["pRemarks"]."&dDay=".$_POST["pDay"]."&dMon=".$_POST["pMonth"]."&dYear=".$_POST["pYear"]."&dNo=".$_POST["pPNo"];

if(empty($_POST["pPNo"])){
	header($reDirect.'&ePro=1');
	}else if(empty($_POST["pManufacturer"])||empty($_POST["pPNo"])||empty($_POST["pQuantity"])||empty($_POST["pPNo"])||typeCheck($_POST['pPrice'],'numeric',255)==FALSE||typeCheck($_POST['pQuantity'],'numeric',255)==FALSE){
		header($reDirect);
	}else{
		//Receiving input from form//
		$pDateInput = $_POST["pDateOfInput"];
		$pDatePurchase = $_POST["pYear"]."-".$_POST["pMonth"]."-".$_POST["pDay"];
		$pManufacturer = $_POST ["pManufacturer"];
		$pProductNo = $_POST["pPNo"]; 
		$pPricePerPiece = $_POST["pPrice"];
		$pQuantity = $_POST ["pQuantity"];
		if(empty($_POST["pShipping"])||typeCheck($_POST['pShipping'],'numeric',255)==FALSE)
		{$pShipping = 0;}else
		{$pShipping = $_POST["pShipping"];}
		$pTotalPrice = ($pPricePerPiece*$pQuantity+$pShipping)*(100+$pTax)/100;
		$pRemarks = $_POST["pRemarks"];
		//Receiving input from form//
		$sessionUserName = $_SESSION['userNo'];	//Collecting User Number from Session
		
		//Inserting individual value into database//
		$query = "INSERT INTO $purchaseTable($puT_PurchaseProductNumber, $puT_PurchaseDateInput, $puT_PurchaseDate, $puT_PurchaseQuantity, $puT_PurchasePrice, $puT_PurchaseShippingPrice, $puT_TotalPurchasePrice, $puT_PurchaseRemarks, $puT_PurchaseManufacturer, $puT_PurchaseUserName) VALUES ('$pProductNo', '$pDateInput', '$pDatePurchase', '$pQuantity', '$pPricePerPiece', '$pShipping', '$pTotalPrice', '$pRemarks', '$pManufacturer', '$sessionUserName')";	
		$result = mysqli_query($connect,$query);
		//Inserting individual value into database//
		
		//Increasing the Quantity on the specific product affected//
		$queryQuantity =  "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = $pProductNo";
		$quantityResult = mysqli_query($connect,$queryQuantity);
		$quantityRow = mysqli_fetch_assoc($quantityResult);
		$currentQuantity = $quantityRow[$pT_ProductQuantity]+$pQuantity;
		
		$updateQuery = "UPDATE $productTable SET $pT_ProductQuantity = $currentQuantity WHERE $pT_ProductNumber = $pProductNo";
		$updateResult = mysqli_query($connect,$updateQuery);
		//Increasing the Quantity on the specific product affected//
		
		header("location:viewPurchase.php?added=1");	//Direct to View Inventory after Done
}
?>
