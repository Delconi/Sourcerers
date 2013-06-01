<?php include ("connect.php");  //Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Display Website Name
?>Add customer order</title>
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

<script type="text/javascript">
document.onkeyup=updateTotal;

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function updateTotal() {
	if(document.getElementById('oPrice').value!=""&&document.getElementById('oQuantity').value!=""&&document.getElementById('oMisc').value!=""){
  var pppValue = parseInt(document.getElementById('oPrice').value);
  var pqtyValue = parseInt(document.getElementById('oQuantity').value);
  var miscValue = parseInt(document.getElementById('oMisc').value);
   
  var totalValue = parseInt(pppValue * pqtyValue + miscValue);

  document.getElementById('oTotal').value = doRound(totalValue, 4);
	}
}
</script>


<body>
<h1 id = "title">Add customer order</h1>
<?php /*
$userNo = $_SESSION["userNo"];
$queryProduct = "Select * From ".$productTable." Where ".$pT_ProductUserName." = '$userNo'";
$userProduct = mysqli_query($connect,$queryProduct);
if(mysqli_num_rows($userProduct)==0){
	header("location:addProduct.php?noPro=1");
	}*/
?>
<form action = "addOrderProcess.php" method = "post">
<div id = "formText">Date of Input</div>
<div id = "formInput"><input name = "oDateOfInput" type = "text" value="<?php echo date('Y-m-d');	//Display Current Date
?>" readonly="readonly" /></div>
<div id = "formText">Date of Order</div>
<div id = "formSelectInput"><select name="oDay" id="oDay">
    <?php 
	
	$day = 1;
	while ($day <=31){	//Displaying Date number from 1 to 31
		if(empty($_GET['dDay'])||$day!=$_GET['dDay']){
		?>
    <option value= "<?php echo $day;?>"><?php echo $day;?></option>    
        
	<?php }else {?>
    <option selected value= "<?php echo $day;?>"><?php echo $day;?></option>    
        
	<?php
		}
	$day ++;
	}
	?>
    </select> - 
    <select name="oMonth" id="oMonth">
    	<option <?php if($_GET['dMonth']=='01') echo "selected";?> value= "01">Jan</option>
        <option <?php if($_GET['dMonth']=='02') echo "selected";?> value= "02">Feb</option>
        <option <?php if($_GET['dMonth']=='03') echo "selected";?> value= "03">Mar</option>
        <option <?php if($_GET['dMonth']=='04') echo "selected";?> value= "04">Apr</option>
        <option <?php if($_GET['dMonth']=='05') echo "selected";?> value= "05">May</option>
        <option <?php if($_GET['dMonth']=='06') echo "selected";?> value= "06">Jun</option>
        <option <?php if($_GET['dMonth']=='07') echo "selected";?> value= "07">Jul</option>
        <option <?php if($_GET['dMonth']=='08') echo "selected";?> value= "08">Aug</option>
        <option <?php if($_GET['dMonth']=='09') echo "selected";?> value= "09">Sep</option>
        <option <?php if($_GET['dMonth']=='10') echo "selected";?> value= "10">Oct</option>
        <option <?php if($_GET['dMonth']=='11') echo "selected";?> value= "11">Nov</option>
        <option <?php if($_GET['dMonth']=='12') echo "selected";?> value= "12">Dec</option>
    </select> -
    <select name = "oYear" id = "oYear">
    <?php
	$year = date('Y');	
	
	while ($year >= 2000){	//Displaying Year from 2000 to current
		if(empty($_GET['dYear'])||$year!=$_GET['dYear']){
		?>
    <option value= "<?php echo $year;?>"><?php echo $year;?></option>    
        
	<?php }else {?>
    <option selected value= "<?php echo $year;?>"><?php echo $year;?></option>    
        
	<?php	
		}
	$year--;
	}
	?>
    </select></div>

   <div id = "formText">Customer Name</div>
<div id = "formInput"><input type = "text" name = "oCustomer" value ="<?php 
if (!empty($_GET['dCustomerName'])){
	echo $_GET['dCustomerName'];
	}?>"/></div>
<div id = "formText">Product</div>
<div id = "formSelectInput"><select name="oNumber" id="oNumber">
<?php
//Displaying of Product Available//
	$sessionUserName = $_SESSION['userNo'];	
		$query = "SELECT * FROM ".$productTable." WHERE ".$oT_OrderUserName." = $sessionUserName ORDER BY ".$pT_ProductName." ASC";
		$result = mysqli_query($connect,$query);
		while($row = mysqli_fetch_assoc($result)){
			if(empty($_GET['dProduct'])||$row[$pT_ProductNumber]!=$_GET['dProduct']){ ?>
			<option value= "<?php echo $row[$pT_ProductNumber];?>"><?php echo $row[$pT_ProductName];?></option>
		<?php }else{?>
			<option selected value= "<?php echo $row[$pT_ProductNumber];?>"><?php echo $row[$pT_ProductName];?></option>
		<?php
			} 
		}
//Displaying of Product Available//	
	?>
    </select></div>
<?php if($_GET['ePro']==1){
	echo "<div id = 'warning'>Add a product before proceeding with adding of order. <a href ='addProduct.php'>Add Product</a></div>";
	}?>

<div id = "formText">Price Per Piece ($)</div>
<div id = "formInput"><input id = 'oPrice' type = "text" name = "oPrice" value ="<?php 
if (!empty($_GET['dPrice'])){
	echo $_GET['dPrice'];
	}?>"/></div>
<div id = "formText">Quantity Order</div>
<div id = "formInput"><input id = 'oQuantity' type = "text" name = "oQuantity" value ="<?php 
if (!empty($_GET['dQuantity'])){
	echo $_GET['dQuantity'];
	}?>"/></div>
<div id = "formText">Misc Cost</div>
<div id = "formInput"><input id = 'oMisc' name = "oMisc" type = "text" value ="<?php 
if (!empty($_GET['dMisc'])){
	echo $_GET['dMisc'];
	}else{
		echo "0";}?>" /></div>
<div id = "formText">Total Cost</div>
<div id = "formInput"><input name = "oTotal" id = "oTotal" type = "text" value = "" readonly="readonly"></div>
<div id = "formText">Order Remarks (Optional)</div>
<div id = "formInput"><input type = "text" name = "oRemarks" value ="<?php 
if (!empty($_GET['dRemarks'])){
	echo $_GET['dRemarks'];
	}?>"/></div>
<div id = "submitBtn"><input type = "submit" /></div>
<?php if($_GET['eField']==1){
	echo "<div id = 'warning'>One of more of the required field is empty / wrong type of value entered.</div>";
	}?>
</form>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</body>
</html>
