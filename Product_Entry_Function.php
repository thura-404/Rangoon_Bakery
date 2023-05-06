<?php 
	function Search_Function($Product)
	{
		include("Connect.php");

		if (!isset($_SESSION['Entry'])) 
		{
			return -1;
		}
		$size 	= count($_SESSION['Entry']);

		for ($i=0; $i < $size; $i++) 
		{ 
			if ($Product == $_SESSION['Entry'][$i]['Product'])
			{
				return $i;
			}
		}

		return -1;
		
	}

	function Add($Product, $Quantity)
	{
		include("Connect.php");

		if (!isset($_SESSION['Entry'])) 
		{
			$_SESSION['Entry']	= array();

			$_SESSION['Entry'][0]['Product']	= $Product;
			$_SESSION['Entry'][0]['Quantity']	= $Quantity;
		}
		else
		{
			$Index 	= Search_Function($Product);

			if ($Index == -1) 
			{
				
				$size 	= count($_SESSION['Entry']);
				$_SESSION['Entry'][$size]['Product']	= $Product;
				$_SESSION['Entry'][$size]['Quantity'] 	= $Quantity;
			}
			else
			{
				$_SESSION['Entry'][$Index]['Quantity'] 	+= $Quantity;
			}
		}

	}

	function Set($Product, $Quantity)
	{
		$Index 	= Search_Function($Product);

		
		$_SESSION['Entry'][$Index]['Quantity'] 	= $Quantity;
	}

	function Remove($Index)
	{
		include("Connect.php");

		if (isset($_SESSION['Entry'])) 
		{
			unset($_SESSION['Entry'][$Index]);

			$_SESSION['Entry']	= array_values($_SESSION['Entry']);
		}
	}
?>