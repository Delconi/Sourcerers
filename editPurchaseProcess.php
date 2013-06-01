<?php
include ("connect.php");  //Addin from connect.php

/*
************************************************************************
Sourcerers
Copyright (c) 2013 Del, Jordon Koh, Low Guan Hong
Released under the GNU General Public License

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

//Checking if any of the required field is empty//
	if(empty($_POST["pManufacturer"])||empty($_POST["pPNo"])||empty($_POST ["pQuantity"])||empty($_POST["pSellPrice"])||typeCheck($_POST['pPrice'],'numeric',255)==FALSE||typeCheck($_POST['pQuantity'],'numeric',255)==FALSE||typeCheck($_POST['pSellPrice'],'numeric',255)==FALSE){
		header("location:editPurchase.php?eField=1&dManu=".$_POST ["pManufacturer"]."&dPri=".$_POST["pPrice"]."&dQua=".$_POST ["pQuantity"]."&dShip=".$_POST["pShipping"]."&dTax=".$_POST["pTax"]."&dSell=".$_POST["pSellPrice"]."&dRem=".$_POST["pRemarks"]."&dDay=".$_POST["pDay"]."&dMon=".$_POST["pMonth"]."&dYear=".$_POST["pYear"]."&dNo=".$_POST ["pPNo"]."&pId=".$_POST["pId"]);
//Checking if any of the required field is empty//
	}else{
		//Receiving input from form//
			$pId = $_POST["pId"];
			$pDateInput = $_POST["pDateOfInput"];
			$pDatePurchase = $_POST["pYear"]."-".$_POST["pMonth"]."-".$_POST["pDay"];
			$pManufacturer = $_POST ["pManufacturer"];
			$pProductNo = $_POST ["pPNo"]; 
			$pPricePerPiece = $_POST["pPrice"];
			$pQuantity = $_POST ["pQuantity"];
			if(empty($_POST["pShipping"])||typeCheck($_POST['pShipping'],'numeric',255)==FALSE)
			{$pShipping = 0;}else	//If no value is input for shipping, set to 0
			{$pShipping = $_POST["pShipping"];}
			if(empty($_POST["pTax"])||typeCheck($_POST['pTax'],'numeric',255)==FALSE)
				{$pTax = 0;}else	//If no value is input for Tax, set to 0
				{$pTax = $_POST["pTax"];}
			$pTotalPrice = ($pPricePerPiece*$pQuantity+$pShipping)*(100+$pTax)/100;	//Calculating of total cost
			$pSellPrice = $_POST["pSellPrice"];
			$pRemarks = $_POST["pRemarks"];
		//Receiving input from form//
		
		$sessionUserName = $_SESSION['userNo'];	//Collecting User Number from Session
		
		//Editting the Quantity on the specific product affected//
			$oldQueryQuantity = "SELECT * FROM ".$purchaseTable." WHERE ".$puT_PurchaseNumber." = '$pId'";	//Grabbing Old Quantity from Purchase Table
			$oldQuantityResult = mysqli_query($connect,$oldQueryQuantity);
			$oldQuantityRow = mysqli_fetch_assoc($oldQuantityResult);
				
			$queryQuantity =  "SELECT * FROM ".$productTable." WHERE ".$pT_ProductNumber." = $pProductNo";	//Grabbing Current Quantity from Product Table
			$quantityResult = mysqli_query($connect,$queryQuantity);
			$quantityRow = mysqli_fetch_assoc($quantityResult);
							
			$upDateQuantity = $quantityRow[$pT_ProductQuantity] + ($pQuantity - $oldQuantityRow[$puT_PurchaseQuantity]);	//Calculating of new Quantity
			
			$updateQuery = "UPDATE $productTable SET $pT_ProductQuantity = $upDateQuantity WHERE $pT_ProductNumber = '$pProductNo' AND $pT_ProductUserName = '$sessionUserName'";	//Update Quantity of affected Product
			$updateResult = mysqli_query($connect,$updateQuery);
			
			echo $updatePurchaseQuery = "UPDATE ".$purchaseTable." SET $puT_PurchaseDateInput = '$pDateInput', $puT_PurchaseManufacturer = '$pManufacturer', $puT_PurchaseDate =' $pDatePurchase', $puT_PurchaseQuantity = '$pQuantity', $puT_PurchasePrice = '$pPricePerPiece', $puT_PurchaseShippingPrice = '$pShipping', $puT_TotalPurchasePrice = '$pTotalPrice', $puT_PurchaseSalesPrice = '$pSellPrice', $puT_PurchaseRemarks = '$pRemarks', $puT_PurchaseTax = '$pAx' WHERE $puT_PurchaseNumber = '$pId' AND  $puT_PurchaseUserName = '$sessionUserName'";	//Update Purchase detail with newly input ones
			$updatePurchaseResult = mysqli_query($connect,$updatePurchaseQuery);
		//IEditting the Quantity on the specific product affected//
		
		header("location:viewPurchase.php?edited=1");	//Direct to View Inventory after Done
}
?>
