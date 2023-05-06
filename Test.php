<?php 
	session_start();
	include('Connect.php');
	include("SQL.php");
	include("Cart_Function.php");

	if (isset($_POST['ID'])) 
	{
		$Result = Multi_Select("Code", "NRC", "No", $_POST['ID']);
		$Count 	= mysqli_num_rows($Result);

		for ($i=0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['Code'] . "'>" . $Row['Code'] . "</option>";
		}
	}

	if (isset($_POST['City'])) 
	{
		$Result = Multi_Select("Township", "Township", "City", $_POST['City']);
		$Count 	= mysqli_num_rows($Result);

		for ($i=0; $i < $Count; $i++) 
		{ 
			$Row = mysqli_fetch_array($Result);
			echo "<option value='" . $Row['Township'] . "'>" . $Row['Township'] . "</option>";
		}
	}

	if(isset($_POST['Size']))
	{
		if(isset($_POST['Type']))
		{
			$Size 	= $_POST['Size'];
			$Type 	= $_POST['Type'];

			$Price 	= mysqli_fetch_array(Match_Data("Price", "Type", "Type", $Type, "AND", "Size", $Size));

			echo  $Price['Price'] ;
		}
	}

	if(isset($_POST['Index']))
	{
		if(isset($_POST['Quantity']))
		{
			$index 	= $_POST['Index'];
			$_SESSION['Cart'][$index]['Quantity'] = $_POST['Quantity'];
		}
	}

	if(isset($_POST['BIndex']))
	{
		if(isset($_POST['BQuantity']))
		{
			$index 	= $_POST['BIndex'];
			$_SESSION['Birthday'][$index]['Quantity'] 	= $_POST['BQuantity'];

			$Price 	= mysqli_fetch_array(Match_Data("Price", "Type", "Type", $_SESSION['Birthday'][$index]['Type'], "AND", "Size", $_SESSION['Birthday'][$index]['Size']));

			$_SESSION['Birthday'][$index]['Price'] 		= $Price[0];

			echo ($Price[0] * $_POST['BQuantity']);
		}
		else
		{
			$index 	= $_POST['BIndex'];

			$Price 	= mysqli_fetch_array(Match_Data("Price", "Type", "Type", $_SESSION['Birthday'][$index]['Type'], "AND", "Size", $_SESSION['Birthday'][$index]['Size']));

			echo $Price[0];
		}
	}
?>