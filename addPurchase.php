<?php include ("connect.php");	//Addin from connect.php
checkLogin();	//Checking if User is logged in before continuing//?>
<html>
<head>
<title><?php echo $websiteName." - ";	//Displaying of Website Name
?>Add a personal purchase</title>
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

<script type="text/javascript">
document.onkeyup=updateTotal;

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function updateTotal() {
	if(document.getElementById('pPrice').value!=""&&document.getElementById('pQuantity').value!=""&&document.getElementById('pTax').value!=""&&document.getElementById('pShipping').value!=""){
  var pppValue = parseInt(document.getElementById('pPrice').value);
  var pqtyValue = parseInt(document.getElementById('pQuantity').value);
  var pshipValue = parseInt(document.getElementById('pShipping').value);
  var taxValue = parseInt(document.getElementById('pTax').value);
   
  var totalValue = parseInt((pppValue * pqtyValue) + pshipValue)*((taxValue+100)/100);

  document.getElementById('pTotal').value = doRound(totalValue, 4);
	}
}
</script>

<body>
<h1 id = "title">Add a personal purchase</h1>

<form action = "addPurchaseProcess.php" method = "post">
<div id = "formText">Date of Input</div>
<div id = "formInput"><input name = "pDateOfInput" type = "text" value="<?php echo date('Y-m-d');	//Displaying current date
?>" readonly="readonly" /></div>
<div id = "formText">Date of Purchase</div>
<div id = "formSelectInput"><select name="pDay" id="pDay">
    <?php 
	
	$day = 01;
	while ($day <=31){	//Displaying of day from 1 to 31
		?>
    <option <?php 
		if($day==$_GET['dDay']){
			echo "selected";
		}
	?> value= "<?php echo $day;?>"><?php echo $day;?></option>    
        
	<?php 
	$day ++;}
	
	?>
    </select> - 
    <select name="pMonth" id="pMonth">
    	<option <?php if($_GET['dMon']=='01') echo "selected";?> value= "01">Jan</option>
        <option <?php if($_GET['dMon']=='02') echo "selected";?> value= "02">Feb</option>
        <option <?php if($_GET['dMon']=='03') echo "selected";?> value= "03">Mar</option>
        <option <?php if($_GET['dMon']=='04') echo "selected";?> value= "04">Apr</option>
        <option <?php if($_GET['dMon']=='05') echo "selected";?> value= "05">May</option>
        <option <?php if($_GET['dMon']=='06') echo "selected";?> value= "06">Jun</option>
        <option <?php if($_GET['dMon']=='07') echo "selected";?> value= "07">Jul</option>
        <option <?php if($_GET['dMon']=='08') echo "selected";?> value= "08">Aug</option>
        <option <?php if($_GET['dMon']=='09') echo "selected";?> value= "09">Sep</option>
        <option <?php if($_GET['dMon']=='10') echo "selected";?> value= "10">Oct</option>
        <option <?php if($_GET['dMon']=='11') echo "selected";?> value= "11">Nov</option>
        <option <?php if($_GET['dMon']=='12') echo "selected";?> value= "12">Dec</option>
    </select> -
    <select name = "pYear" id = "pYear">
    <?php
	$year = date('Y');
	
	while ($year >= 2000){	//Displaying of year from 2000 to current
		?>
	<option <?php 
		if($year==$_GET['dYear']){
			echo "selected";
		}
	?> value = "<?php echo $year;?>"><?php echo $year?></option>
    
    <?php	
	$year--;
	}
	?>
    </select></div>

<div id = "formText">Product Manufacturer</div>
<div id = "formInput"><input type = "text" name = "pManufacturer" value ="<?php 
if (!empty($_GET['dManu'])){
	echo $_GET['dManu'];
	}?>"/></div>
<div id = "formText">Product</div>
<div id = "formSelectInput"><select name="pPNo" id="pName">
    <?php
		//Grabbing Product Name from database that is available to current user//
		$sessionUserName = $_SESSION['userNo'];
		$query = "SELECT * FROM ".$productTable." WHERE ".$pT_ProductUserName." = $sessionUserName";
		$result = mysqli_query($connect,$query);
		while($row = mysqli_fetch_assoc($result)){?>
			<option <?php 
			if ($row[$pT_ProductNumber]==$_GET['dNo']){
				echo "selected";	
			}
			?> value= "<?php echo $row[$pT_ProductNumber];?>"><?php echo $row[$pT_ProductName];?></option>
		<?php }
		//Grabbing Product Name from database that is available to current user//
	?>
    </select></div>
<?php if($_GET['ePro']==1){
	echo "<div id = 'warning'>Add a product before proceeding with adding of purchase. <a href ='addProduct.php'>Add Product</a></div>";
	}?>

<div id = "formText">Price Per Piece ($)</div>
<div id = "formInput"><input id = 'pPrice' type = "text" name = "pPrice" value ="<?php 
if (!empty($_GET['dPri'])){
	echo $_GET['dPri'];
	}?>"/></div>
<div id = "formText">Quantity Purchase</div>
<div id = "formInput"><input id = 'pQuantity' type = "text" name = "pQuantity" value ="<?php 
if (!empty($_GET['dQua'])){
	echo $_GET['dQua'];
	}?>"/></div>
<div id = "formText">Shipping Cost ($)</div>
<div id = "formInput"><input id = 'pShipping' name = "pShipping" type = "text" value ="<?php 
if (!empty($_GET['dShip'])){
	echo $_GET['dShip'];
	}else{echo "0";}?>" /></div>
<div id = "formText">Tax (%)</div>
<div id = "formInput"><input id = 'pTax' name = "pTax" type = "text" value ="<?php 
if (!empty($_GET['dTax'])){
	echo $_GET['dTax'];
	}else{echo "0";}?>" /></div>
<div id = "formText">Total Cost</div>
<div id = "formInput"><input id = "pTotal" type = "text" value = "" readonly="readonly"></div>
<div id = "formText">Product Remarks (Optional)</div>
<div id = "formInput"><input type = "text" name = "pRemarks" value ="<?php 
if (!empty($_GET['dRem'])){
	echo $_GET['dRem'];
	}?>"/></div>
<?php if($_GET['eField']==1){
	echo "<div id = 'warning'>One of more of the required field is empty / wrong type of value entered./div>";
	}?>
<input type = "submit" />
</form>
<div id = "backBtn"><a href = "index2.php">Back</a></div>
</body>
</html>
