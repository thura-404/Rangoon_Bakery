<?php 
	include("Connect.php");

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

	function Add($ID, $Quantity)
	{
		include("Connect.php");

		if (!isset($_SESSION['Cart'])) 
		{
			$_SESSION['Cart']	= array();

			$_SESSION['Cart'][0]['Product']		= $ID;
			$_SESSION['Cart'][0]['Quantity']	= $Quantity;
		}
		else
		{
			$Index 	= Search_Function($ID);

			if ($Index == -1) 
			{
				
				$size 	= count($_SESSION['Cart']);
				$_SESSION['Cart'][$size]['Product']		= $ID;
				$_SESSION['Cart'][$size]['Quantity'] 	= $Quantity;
			}
			else
			{
				$_SESSION['Cart'][$Index]['Quantity'] 	+= $Quantity;
			}
		}

		echo "<script>window.alert('Product Add To Cart Successfully')</script>";
	}
	

	function Update($ID, $Quantity)
	{
		include("Connect.php");

		if (isset($_SESSION['Cart'])) 
		{
			$_SESSION['Cart'][$ID]['Quantity']	= $Quantity;
		}
	}

	function Remove($Index)
	{
		include("Connect.php");

		if (isset($_SESSION['Cart'])) 
		{
			unset($_SESSION['Cart'][$Index]);

			$_SESSION['Cart']	= array_values($_SESSION['Cart']);
		}
	}

	function Search_Function_Birthday($Photo)
	{
		include("Connect.php");

		if (!isset($_SESSION['Birthday'])) 
		{
			return -1;
		}

		$size 	= count($_SESSION['Birthday']);

		for ($i=0; $i < $size; $i++) 
		{ 
			if ($Photo == $_SESSION['Birthday'][$i]['Photo'])
			{
				return $i;
			}
		}

		return -1;
		
	}

	function Birthday_Add($Photo, $Design, $Size, $Type, $Quantity, $Price)
	{
		include("Connect.php");

		if (!isset($_SESSION['Birthday'])) 
		{
			$_SESSION['Birthday']	= array();

			$_SESSION['Birthday'][0]['Design']		= $Design;
			$_SESSION['Birthday'][0]['Size']		= $Size;
			$_SESSION['Birthday'][0]['Type']		= $Type;
			$_SESSION['Birthday'][0]['Quantity']	= $Quantity;
			$_SESSION['Birthday'][0]['Photo']		= $Photo;
			$_SESSION['Birthday'][0]['Price']		= $Price;
		}
		else
		{
			$Index 	= Search_Function_Birthday($Photo);

			if ($Index == -1) 
			{
				
				$size 	= count($_SESSION['Birthday']);
				$_SESSION['Birthday'][$size]['Design']		= $Design;
				$_SESSION['Birthday'][$size]['Size']		= $Size;
				$_SESSION['Birthday'][$size]['Type']		= $Type;
				$_SESSION['Birthday'][$size]['Quantity'] 	= $Quantity;
				$_SESSION['Birthday'][$size]['Photo']		= $Photo;
				$_SESSION['Birthday'][$size]['Price']		= $Price;
			}
			else
			{
				$_SESSION['Birthday'][$Index]['Design']		= $Design;
				$_SESSION['Birthday'][$Index]['Size']		= $Size;
				$_SESSION['Birthday'][$Index]['Type']		= $Type;
				$_SESSION['Birthday'][$Index]['Quantity'] 	= $Quantity;
				$_SESSION['Birthday'][$Index]['Price']		= $Price;				
			}
		}

		echo "<script>window.alert('Birthday Cake Added To Cart Successfully')</script>";
	}

	function Update_Birthday($Photo, $Quantity, $Type, $Size)
	{
		include("Connect.php");

		if (isset($_SESSION['Birthday'])) 
		{
			$Index 	= Search_Function_Birthday($Photo);

			$_SESSION['Birthday'][$Index]['Quantity']	= $Quantity;
			$_SESSION['Birthday'][$Index]['Type']		= $Type;
			$_SESSION['Birthday'][$Index]['Size']		= $Size;
			$_SESSION['Birthday'][$Index]['Quantity']	= $Quantity;
			$_SESSION['Birthday'][$Index]['Price']		= $Price;
		}
	}

	function Remove_Birthday($Photo)
	{
		include("Connect.php");

		if (isset($_SESSION['Birthday'])) 
		{
			$Index 	= Search_Function_Birthday($Photo);
			unset($_SESSION['Birthday'][$Index]);

			$_SESSION['Birthday']	= array_values($_SESSION['Birthday']);
		}
	}

	function Total_Price()
	{
		include("Connect.php");

		
		$Total_Price = 0;

		if(isset($_SESSION['Cart']))
		{
			$size = count($_SESSION['Cart']);

			for ($i=0; $i < $size; $i++) 
			{ 
				$Cart  = Multi_Select("Price", "Product", "ID", $_SESSION['Cart'][$i]['Product']);
				$CRows = mysqli_fetch_array($Cart);

				$Total_Price = ($Total_Price + ($CRows['Price']*$_SESSION['Cart'][$i]['Quantity']));
			}

			if(isset($_SESSION['Birthday']))
			{
				$size = count($_SESSION['Birthday']);
				
				for ($i=0; $i < $size; $i++) 
				{ 
					$Total_Price = ($Total_Price + ($_SESSION['Birthday'][$i]['Price'] * $_SESSION['Birthday'][$i]['Quantity']));
				}
			}
		}
		elseif (isset($_SESSION['Birthday'])) 
		{
			$size = count($_SESSION['Birthday']);
				
			for ($i=0; $i < $size; $i++) 
			{ 
				$Total_Price = ($Total_Price + $_SESSION['Birthday'][$i]['Price']);
			}
		}

		

		return $Total_Price;
	}
?>