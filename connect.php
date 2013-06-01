<?php
session_start();  //Starting Session

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

//If user not loggin, redirect to login page//
function checkLogin(){
if(!isset($_SESSION["user"]))			
	{
		header("location:index.php?notLogin=1");	
	}	
}
//If user not loggin, redirect to login page//

//Checking for types of variables and length//
function typeCheck($string, $type, $length){	//The type of variable can be bool, float, numeric, string, array, or object
  $type = 'is_'.$type;	//Assign the type
  if(!$type($string)){	//Checking if type matches
    	return FALSE;
    }else if(empty($string)){	//Checking if it's empty
    	return FALSE;	
    }else if(strlen($string) > $length){
		return FALSE;
	}else{
    	return TRUE;	//If all is check, return true
    }
}
//Checking for types of variables and length//

//Requirement to connec to DB//
$host = "localhost";
$username = ""; /////////////////////////////////////////////////////////Your username to db here
$password = "d";  /////////////////////////////////////////////////////// Your password to db here
$databaseName = "photogen_osCommerce";
$connect = mysqli_connect($host,$username,$password,$databaseName);
								//Connect To Host
								//(HOST, username, Password)
//Requirement to connec to DB//

//Columns availabe in User Info Table//
$userTable = "UserInfo";
	$uT_UserNumber = "uNo";
	$uT_UserName = "uName";
	$uT_UserPassword = "uPass";
//Columns availabe in User Info Table//	

//Columns availabe in Product Info Table//
$productTable = "ProductInfo";
	$pT_ProductNumber = "pNo";
	$pT_ProductName = "pName";
	$pT_ProductUserName = "pUserNo";
	$pT_ProductDescription = "pDesc";
	$pT_ProductUrl = "pUrl";
	$pT_ProductQuantity = "pStock";
//Columns availabe in Product Info Table//	
	
//Columns availabe in Order Info Table//
$orderTable = "ProductOrder";
	$oT_OrderNumber = "oNo";
	$oT_OrderInput = "oDateInput";
	$oT_OrderDate = "oDate";
	$oT_OrderProductName = "oName";
	$oT_OrderUserName = "pUserNo";
	$oT_OrderCostumerName = "oCostumer";
	$oT_OrderPrice = "oPrice";
	$oT_OrderQuantity = "oQuantity";
	$oT_OrderMisc = "oMiscCost";
	$oT_TotalCost = "oTotalCost";
	$oT_OrderRemarks = "oRemarks";
//Columns availabe in Order Info Table//
	
//Columns availabe in Purchase Info Table//
$purchaseTable = "ProductPurchase";
	$puT_PurchaseNumber = "pPno";
	$puT_PurchaseProductNumber = "pNameNo";
	$puT_PurchaseUserName = "pPUserNo";
	$puT_PurchaseDateInput = "pDateInput";
	$puT_PurchaseManufacturer = "pManufacturer";
	$puT_PurchaseDate = "pPurchaseDate";
	$puT_PurchaseQuantity = "pQuantity";
	$puT_PurchasePrice = "pPrice";
	$puT_PurchaseShippingPrice = "pShipping";
	$puT_TotalPurchasePrice = "pTotalPurchase";
	$puT_PurchaseSalesPrice = "pSalesPrice";
	$puT_PurchaseRemarks = "pRemarks";
	$puT_PurchaseTax = "pTax";
//Columns availabe in Purchase Info Table//
								
if(!$connect) 
	{
		echo "Unable to Connect to Database";
	}
	
$websiteName = "Ecommerce";	//Website Name

?>
