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

if(empty($_POST['pName'])){
	header("location:editProduct.php?warning=1&pName=".$_POST["pName"]."&pDesc=".$_POST["pDesc"]."&pUrl=".$_POST["pUrl"]."&pStock=".$_POST["pStock"]."&pId=".$_POST['pId']);}
	else{
	//Receiving input from form//
	$pId = $_POST["pId"];
	$productName = $_POST["pName"];	
	$productDescription = $_POST["pDesc"];	
	$productUrl = $_POST["pUrl"];
	$productStock = $_POST["pStock"];	
	$sessionUserName = $_SESSION['userNo'];
	//Receiving input from form//
	
	//Insert new product to database with individual value//
	$query = "UPDATE ".$productTable." SET $pT_ProductName = '$productName', $pT_ProductDescription = '$productDescription', $pT_ProductUrl = '$productUrl', $pT_ProductQuantity = '$productStock' WHERE $pT_ProductNumber = '$pId' AND $pT_ProductUserName = '$sessionUserName'";	
	$result = mysqli_query($connect,$query);	
	//Insert new product to database with individual value//	
	
	header("location:viewProduct.php?edited=1");	//Direct to View Inventory after Done
	}

?>
