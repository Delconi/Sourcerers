<?php include ("connect.php");  //Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Displaying of Website Name
?>Main</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<!--
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
-->


<body>
<div id = "mainContent">
<?php
//Displaying of different Welcome message either for existing or new user//
if($_GET['welcome']==1){
	echo "<div id = 'welcome'>Account successfully created</div>";}	//When account just created
else if($_GET['welcomeBack']==1){
	echo "<div id = 'welcome'>Welcome back</div>";	//When logged in using previously created account
}
//Displaying of different Welcome message either for existing or new user//
?>
<div id = "menuLink"><a href = "addProduct.php">Add a Product Component / Product</a></div>
<div id = "menuLink"><a href = "viewProduct.php">View Inventory</a></div>
<div id = "menuLink"><a href = "addPurchase.php">Add a Personal Purchase</a></div>
<div id = "menuLink"><a href = "viewPurchase.php">View All Personal Purchases</a></div>
<div id = "menuLink"><a href = "addOrder.php">Add Customer Orders</a></div>
<div id = "menuLink"><a href = "viewOrder.php">View All Customer Orders</a></div>
<div id = "menuLink"><a href = "logout.php">Log Out</a></div>
</div>
</body>
</html>
