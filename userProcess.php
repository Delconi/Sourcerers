<?php
include ("connect.php");

//Checking if Username / Password is empty//
if(empty($_POST["uName"])&&strlen($_POST["uName"])<=4){	//If username is less than 4 characters
	header("location:index.php?emptyField=1&previousUser=".$_POST["uName"]);	
	
}else if(empty($_POST["uPass"])&&strlen($_POST["uPass"])<=8||$_POST["uPass"]=="Password"){	//If password is less than 8 characters
	header("location:index.php?emptyPass=1&previousUser=".$_POST["uName"]);	
}else{
	$userName = $_POST["uName"];	//Receiving input from form
	$userPass = md5($_POST["uPass"]);	//Receiving input from form and encrpyting it

	$queryUser = "Select * From ".$userTable." Where ".$uT_UserName." = '$userName'";
	$userResults = mysqli_query($connect,$queryUser);

	//Checking if user exist//
		if(mysqli_num_rows($userResults)!=0){
			while($row = mysqli_fetch_assoc($userResults)){
				//Checking if Password Matches in DB//
					if($userPass!=$row[$uT_UserPassword]){
						
						//Redirect to loggin page again
						header("location:index.php?wrongPass=1&previousUser=".$_POST["uName"]);	
					}else{
						$_SESSION["user"] = $row[$uT_UserName];	//Set username to session
						$_SESSION["userNo"] = $row[$uT_UserNumber];	//Set user id to session from db
						
						header("location:index2.php?welcomeBack=1");//Redirect to  menu
					}
				//Checking if Password Matches in DB//
			}
		}
	//Checking if user exist//
	
		//If User does not exist//
			else{
				//Inserting new Username to DB//
				$query = "INSERT INTO $userTable($uT_UserName, $uT_UserPassword) VALUES ('$userName', '$userPass')";	
				$result = mysqli_query($connect,$query);
				$userResults = mysqli_query($connect,$queryUser);
				//Inserting new Username to DB//
				
				while($row = mysqli_fetch_assoc($userResults)){
					$_SESSION["user"] = $row[$uT_UserName];	//Set username to session
					$_SESSION["userNo"] = $row[$uT_UserNumber];	//Set user id to session from db
				}
				header("location:index2.php?welcome=1");//Redirect to menu	
			}
		//If User Does not exist//
}
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
