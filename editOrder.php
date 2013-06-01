<?php include ("connect.php");  //Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Display Website Name
?>Edit customer order</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

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

<body>
<h1 id = "title">Edit customer order</h1>
<?php 
$oId = $_GET['oId'];
$uId = $_SESSION['userNo'];

$oQuery = "SELECT * FROM ".$orderTable." WHERE ".$oT_OrderNumber." = '$oId' AND ".$oT_OrderUserName." = '$uId'";
$oResult = mysqli_query($connect,$oQuery);
$oRow = mysqli_fetch_assoc($oResult);
?>

<form action = "editOrderProcess.php" method = "post">
<input name="oId" type="hidden" value="<?php echo $oId;?>" />
<div id = "formText">Date of Input</div>
<div id = "formInput"><input name = "oDateOfInput" type = "text" value="<?php echo date('Y-m-d');	//Display Current Date
?>" readonly="readonly" /></div>
<div id = "formText">Date of Order</div>
<div id = "formSelectInput"><select name="oDay" id="oDay">
    <?php 
	
	$day = 1;
	while ($day <=31){	//Displaying Date number from 1 to 31
		
		?>
    <option <?php if($_GET['dDay']==$day||(empty($_GET['dDay'])&&$day==date('d',strtotime($oRow[$oT_OrderDate])))){echo "selected";}?> value= "<?php echo $day;?>"><?php echo $day;?></option>    
        
	<?php
	$day ++;
	}
	?>
    </select> - 
    <select name="oMonth" id="oMonth">
    	<option <?php if($_GET['dMonth']=='01'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='01')) echo "selected";?> value= "01">Jan</option>
        <option <?php if($_GET['dMonth']=='02'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='02')) echo "selected";?> value= "02">Feb</option>
        <option <?php if($_GET['dMonth']=='03'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='03')) echo "selected";?> value= "03">Mar</option>
        <option <?php if($_GET['dMonth']=='04'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='04')) echo "selected";?> value= "04">Apr</option>
        <option <?php if($_GET['dMonth']=='05'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='05')) echo "selected";?> value= "05">May</option>
        <option <?php if($_GET['dMonth']=='06'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='06')) echo "selected";?> value= "06">Jun</option>
        <option <?php if($_GET['dMonth']=='07'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='07')) echo "selected";?> value= "07">Jul</option>
        <option <?php if($_GET['dMonth']=='08'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='08')) echo "selected";?> value= "08">Aug</option>
        <option <?php if($_GET['dMonth']=='09'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='09')) echo "selected";?> value= "09">Sep</option>
        <option <?php if($_GET['dMonth']=='10'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='10')) echo "selected";?> value= "10">Oct</option>
        <option <?php if($_GET['dMonth']=='11'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='11')) echo "selected";?> value= "11">Nov</option>
        <option <?php if($_GET['dMonth']=='12'||(empty($_GET['dMonth'])&&date('m',strtotime($oRow[$oT_OrderDate]))=='12')) echo "selected";?> value= "12">Dec</option>
    </select> -
    <select name = "oYear" id = "oYear">
    <?php
	$year = date('Y');	
	
	while ($year >= 2000){	//Displaying Year from 2000 to current ?>
    <option <?php if($_GET['dYear']==$year||(empty($_GET['dYear'])&&$year==date('Y',strtotime($oRow[$oT_OrderDate])))){
		echo "selected";
		}?> value= "<?php echo $year;?>"><?php echo $year;?></option>     
	<?php 
	$year--;
	}
	?>
    </select></div>
    
<div id = "formText">Customer Name</div>
<div id = "formInput"><input type = "text" name = "oCustomer" value ="<?php 
if (!empty($_GET['dCustomerName'])||$_GET['eField']==1){
	echo $_GET['dCustomerName'];
	}else {
		echo $oRow[$oT_OrderCostumerName];
	}
	?>"/></div>
<div id = "formText">Product</div>
<div id = "formSelectInput"><select name="oNumber" id="oNumber">
<?php
//Displaying of Product Available//
	$sessionUserName = $_SESSION['userNo'];	
		$query = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductUserName." = $uId";
		$result = mysqli_query($connect,$query);
		while($row = mysqli_fetch_assoc($result)){?>
			 <?php if($row[$pT_ProductNumber]==$_GET['dProduct']||(empty($_GET['dProduct'])&&$row[$pT_ProductNumber]==$oRow[$oT_OrderProductName])){
				?> <option value= "<?php echo $row[$pT_ProductNumber];?>"><?php echo $row[$pT_ProductName];?></option><?php
				}?> 
		<?php 
		}
//Displaying of Product Available//	
	?>
  </select></div>

<div id = "formText">Price Per Piece ($)</div>
<div id = "formInput"><input type = "text" name = "oPrice" value ="<?php 
if (!empty($_GET['dPrice'])||$_GET['eField']==1){
	echo $_GET['dPrice'];
	}else {
		echo $oRow[$oT_OrderPrice];
	}?>"/></div>
<div id = "formText">Quantity Order</div>
<div id = "formInput"><input type = "text" name = "oQuantity" value ="<?php 
if (!empty($_GET['dQuantity'])||$_GET['eField']==1){
	echo $_GET['dQuantity'];
	}else {
		echo $oRow[$oT_OrderQuantity];
	}?>"/></div>
<div id = "formText">Misc Cost (Optional)</div>
<div id = "formInput"><input name = "oMisc" type = "text" value ="<?php 
if (!empty($_GET['dMisc'])||$_GET['eField']==1){
	echo $_GET['dMisc'];
	}else{
		echo $oRow[$oT_OrderMisc];
	}?>" /></div>
<div id = "formText">Order Remarks (Optional)</div>
<div id = "formInput"><input type = "text" name = "oRemarks" value ="<?php 
if (!empty($_GET['dRemarks'])||$_GET['eField']==1){
	echo $_GET['dRemarks'];
	}else{
		echo $oRow[$oT_OrderRemarks];
	}?>"/></div>
<div id = "submitBtn"><input type = "submit" /></div>
<?php if($_GET['eField']==1){
	echo "<div id = 'warning'>One of more of the required field is empty / wrong type of value entered.</div>";
	}?>
</form>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</body>
</html>
