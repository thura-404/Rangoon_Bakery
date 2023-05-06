<?php 

	function Max_ID($Field,$Table)
	{
		include("Connect.php");

		$query 	= "	SELECT MAX($Field) FROM $Table";
		$result	= mysqli_query($connection, $query);
		$row 	= mysqli_fetch_array($result);

		$ID 	= $row['0']+1;
		
		return $ID;
	}

	function Match_Data($Field , $Table, $Data, $Value, $Type, $Data2, $Value2)
	{
		include("Connect.php");
		
		$query 	= "SELECT $Field FROM $Table WHERE $Data = '$Value' $Type $Data2 = '$Value2'";
		$result	= mysqli_query($connection, $query);
		
		return $result;
		
	}
	
	function Single_Select($Field, $Table)
	{
		include("Connect.php");

		$query 	= "	SELECT $Field FROM $Table";
		$result	= mysqli_query($connection, $query);
		
		return $result;
	}

	function Multi_Select($Field, $Table, $Data, $Value)
	{
		include("Connect.php");

		$query 	= "SELECT $Field FROM $Table WHERE $Data = '$Value' ORDER BY $Data DESC";
		$result	= mysqli_query($connection, $query);

		return $result;		
	}


	function Insert_Data($Table, $Field, $Value)
	{
		include("Connect.php");

		$query 	= "	INSERT INTO $Table
						$Field
					VALUES
						$Value";
		$result	= mysqli_query($connection, $query);

		return $result;	

	}

	function Update_Data($Table, $Update, $Data, $Value)
	{
		include("Connect.php");

		$query 	= "	UPDATE $Table 
					SET 
						$Update 
					WHERE 
						$Data = '$Value'";
		$result = mysqli_query($connection, $query);

		return $result;
	}

	function Delete_Data($Table, $Field, $Value)
	{
		include("Connect.php");

		$query = " DELETE FROM $Table WHERE $Field = '$Value'";
		$result= mysqli_query($connection, $query);

		return $result;	
	}

	function Delete_Favorite($Table, $Field, $Value, $Type, $Field1, $Value1)
	{
		include("Connect.php");

		$query = " DELETE FROM $Table WHERE $Field = '$Value' $Type $Field1 = '$Value1'";
		$result= mysqli_query($connection, $query);

		return $result;	
	}
?>