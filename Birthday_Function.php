<?php
    function Search_Function($ID)
	{
		include("Connect.php");

		if (!isset($_SESSION['Cart'])) 
		{
			return -1;
		}
		$size 	= count($_SESSION['Cart']);

		for ($i=0; $i < $size; $i++) 
		{ 
			if ($ID == $_SESSION['Cart'][$i]['Product'])
			{
				return $i;
			}
		}

		return -1;
		
	}



    function Add($ID, $Quantity, $Size, $Type)
	{
		include("Connect.php");

		if (!isset($_SESSION['Cart'])) 
		{
			$_SESSION['Birthday']	= array();

			$_SESSION['Birthday'][0]['Product']		= $ID;
			$_SESSION['Birthday'][0]['Quantity']	= $Quantity;
			$_SESSION['Birthday'][0]['Size']		= $Size;
			$_SESSION['Birthday'][0]['Type']		= $Type;
		}
		else
		{
			$Index 	= Search_Function($ID);

			if ($Index == -1) 
			{
				
				$size 	= count($_SESSION['Cart']);
				$_SESSION['Birthday'][$size]['Product']		= $ID;
				$_SESSION['Birthday'][$size]['Quantity'] 	= $Quantity;
				$_SESSION['Birthday'][$size]['Size']		= $Size;
				$_SESSION['Birthday'][$size]['Type']		= $Type;
			}
			else
			{
				$_SESSION['Birthday'][$Index]['Quantity'] 	+= $Quantity;
			}
		}

		echo "<script>window.alert('Product Add To Cart Successfully')</script>";
	}
?>