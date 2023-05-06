<?php

    session_start();
	include("Connect.php");
	include("SQL.php");
    include("Product_Entry_Function.php");

	if (!isset($_SESSION['Staff_ID'])) 
	{
		echo "<script>window.alert('Alert : >> Please Login To Your Account! <<')</script>";
		$_SESSION['loc'] = "Type.php";
		echo "<script>window.location='Staff_Login.php'</script>";
	}
    else
    {
        $Position = mysqli_fetch_array(Multi_Select("*", "Staff", "ID", $_SESSION['Staff_ID']));
    }

	if (isset($_REQUEST['New'])) 
	{
		if (isset($_REQUEST['Update'])) 
		{
			$_SESSION['Update']	= $_REQUEST['Update'];
		}
	}
	elseif (isset($_REQUEST['Delete'])) 
	{
		$Delete 	= $_REQUEST['Delete'];

		if (Delete_Data("Type","ID",$Delete)) 
		{
			if (Delete_Data("Type", "ID", $Delete)) 
			{
				echo "<script>window.alert('Product Types Successfully Deleted.')</script>";
				echo "<script>window.location='Type.php'</script>";
			}
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Type.php'</script>";
		}
	}

	if (isset($_POST['btnAdd'])) 
	{
		Add($_POST['cboSize'], $_POST['txtPrice']);	
		echo "<script>window.location='Type.php?New'</script>";
	}
	elseif (isset($_POST['btnSet'])) 
	{
		Set($_POST['cboSize'], $_POST['txtPrice']);	
		echo "<script>window.location='Type.php?New'</script>";
	}
	elseif (isset($_REQUEST['Entry_Delete'])) 
	{
		Remove($_REQUEST['Entry_Delete']);
		echo "<script>window.location='Type.php?New'</script>";
	}

	if (isset($_POST['btnSave'])) 
	{
		if (isset($_SESSION['Entry'])) 
		{
			$ID 		= Max_ID("ID","Type");
			$Type		= $_POST['txtType'];
			$Total_P	= count($_SESSION['Entry']);


			

			for ($i=0; $i < $Total_P; $i++) 
			{ 
				if (Insert_Data("Type","(ID, Type, Size, Price)", "('$ID', '$Type', '" . $_SESSION['Entry'][$i]['Product'] . "', '" . $_SESSION['Entry'][$i]['Quantity'] . "')")) 
				{
					
				}
				else
				{
					Delete_Data("Type", "ID", $ID);
					unset($_SESSION['Entry']);

					echo "<script>window.alert('Error')</script>";
					echo "<script>window.location='Type.php?New'</script>";
				}
			}

			echo "<script>window.alert('Types Successfully Added!')</script>";
			echo "<script>window.location='Type.php?New'</script>";
			unset($_SESSION['Entry']);
			
		}
		else
		{
			echo "<script>window.alert('Add Type First!')</script>";
			echo "<script>window.location='Type.php?New'</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="New.css">
        <link rel="stylesheet" href="select2.min.css" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

		<script src="https://kit.fontawesome.com/976970d2ed.js" crossorigin="anonymous"></script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.cs">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script  src="DataTables/datatables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

        <style>
        .select2-dropdown {top: 22px !important;}
        </style>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <script>
            $(document).ready( function ()
            {
                $('#tableid').DataTable();


                $("#Main").click(function()
                    {
                        window.location = "Birthday_Entry.php";
                    });


                jQuery('#Choose').change(function(){
                    var Id = jQuery(this).val(); 
                    jQuery.ajax({
                        type:'post',
                        url:'Test.php',
                        data:'ID='+Id,
                        success:function(result){
                            jQuery('#Data').html(result);
                            jQuery('.country_list').chosen();
                        }
                    });
                });

                
            } );

         
        </script>

    <?php include "Sidebar.php"; ?>
    
    <section class="home-section">
        <form action="Type.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Type</h1></th>

                            <th>
                                <a href="Type.php?New">
                                    <div class="Expand">
                                        <input type="button" class="Text" value="New Record">
                                        <button class="Icon"><i class='fas fa-plus'></i></button>
                                    </div>
                                </a>
                            </th>
                        </tr>
                    </table>
                </div>

                <?php 
                    if (isset($_REQUEST['New'])) 
                    {
                ?>
                    <div class="Form">

                    <?php 

                        if (isset($_REQUEST['Update'])) 
                        {
                            $Rows		= mysqli_fetch_array(Multi_Select("*","Type","ID",$_SESSION['Update']));
                        }
                        else
                        {
                    ?>
                        <div class="Input_Field">
                            <label>Size</label>

                            <div class="Custom_Select">
                                <select name="cboSize" required class="form-control">
                                    <?php 
                                        if (isset($_REQUEST['Entry_Update'])) 
                                        {
                                            for ($i=8; $i < 25; $i+=2) 
                                            { 
                                                if ($i == $_SESSION['Entry'][$_REQUEST['Entry_Update']]['Product']) 
                                                {
                                                    echo "<option selected value='" . $i . "'>" . $i . "</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='" . $i . "'>" . $i . "</option>";	
                                                }													
                                            }
                                        }
                                        elseif (isset($_REQUEST['Update'])) 
                                        {
                                            for ($i=8; $i < 25; $i+=2) 
                                            {
                                                if ($i == $Rows['Size']) 
                                                {
                                                    echo "<option selected value='" . $i . "'>" . $i . "</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='" . $i . "'>" . $i . "</option>";	
                                                }													
                                            }
                                        }
                                        else
                                        {	
                                            echo "<option disabled selected hidden value=''>Choose</option>";
                                            for ($i=8; $i < 25; $i+=2) 
                                            { 
                                                echo "<option value='" . $i . "'>" . $i . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="Input_Field">
                            <label>Price</label>

                            <?php 
                                if (isset($_REQUEST['Entry_Update'])) 
                                {
                                    echo "<input type='number' name='txtPrice' step='1' min='1' value='" . $_SESSION['Entry'][$_REQUEST['Entry_Update']]['Quantity'] . "' class='Input' required>";
                                }
                                elseif (isset($_REQUEST['Update'])) 
                                {
                                    $PRows		= mysqli_fetch_array(Multi_Select("Price","Type","ID",$_SESSION['Update']));

                                    echo "<input type='number' name='txtPrice' step='1' min='1' value='" . $PRows['0'] . "' class='Input' required>";
                                }
                                else
                                {
                                    echo "<input type='number' name='txtPrice' step='1' min='1' value='1' class='Input' required>";
                                }
                            ?>
                        </div>
                        
                    <?php
                        }

                    ?>

                    

                    <div class="Input_Field">
                        <?php 
                            if (isset($_REQUEST['Entry_Update'])) 
                            {
                                echo "<input type='submit' name='btnSet' class='Btn' value='Set'>";
                            }
                            elseif (isset($_REQUEST['Update'])) 
                            {

                            }
                            else
                            {
                                echo "<input type='submit' name='btnAdd' class='Btn' value='Add'>";
                            }


                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='submit' id='Main' name='btnBack' class='Btn' value='Back'>";
                            }
                            else
                            {
                                echo "<input type='submit' id='Main' name='btnCancle' class='Btn' value='Cancle'>";
                            }
                        ?>
                    </div>
                </div>

        </form>
                <?php 
                    if (isset($_REQUEST['Update'])) 
                    {

                ?>
                <form action="Type.php" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>

                            <tbody>
                <?php
                                    $result	= Multi_Select("*","Type","ID",$_REQUEST['Update']);
                                    $count	= mysqli_num_rows($result);

                                    for ($i=0; $i < $count; $i++) 
                                    { 
                                        $rows 	=	mysqli_fetch_array($result);
                                        $ID 	= 	$rows["ID"];

                                        if (isset($_REQUEST['Update'])) 
                                        {
                                            
                                            if ($ID == $_SESSION['Update']) 
                                            {
                                                echo "<tr class='Update'>";
                                                echo "<td>" . $ID . "</td>";
                                                echo "<td>" . $rows['Size'] . "</td>";
                                                echo "<td>" . $rows['Price'] . "</td>";
                                                echo("<td>
                                                        <a href='Type.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                        |
                                                        <a href='Type.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                    </td>");
                                                echo "</tr>";
                                            }
                                            else
                                            {
                                                echo "<tr>";
                                                echo "<td>" . $ID . "</td>";
                                                echo "<td>" . $rows['Size'] . "</td>";
                                                echo "<td>" . $rows['Price'] . "</td>";
                                                echo("<td>
                                                        <a href='Type.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                        |
                                                        <a href='Type.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                    </td>");
                                                echo "</tr>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td>" . $rows['Size'] . "</td>";
                                            echo "<td>" . $rows['Price'] . "</td>";
                                            echo("<td>
                                                    <a href='Type.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Type.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                    }
                ?>
                            </tbody>
                        </table>
                    </div>
                    </form>
                <?php
                    }
                    else
                    {
                ?>
                <form action="Type.php" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>

                            <tbody>
                <?php
                            if (isset($_SESSION['Entry'])) 
                            {
                                $Count = count($_SESSION['Entry']);

                                for ($i=0; $i < $Count; $i++) 
                                { 
                                    echo "<tr>";
                                    echo "<td>" . ($i + 1) . "</td>";
                                    echo "<td>" . $_SESSION['Entry'][$i]['Product'] . "</td>";
                                    echo "<td>" . $_SESSION['Entry'][$i]['Quantity'] . "</td>";
                                    echo("<td>
                                            <a href='Type.php?New&&Entry_Update=$i'><i class='fas fa-pencil-alt'></i></a>
                                            |
                                            <a href='Type.php?Entry_Delete=$i'><i class='far fa-trash-alt'></i></a>
                                        </td>");
                                    echo "</tr>";
                                }
                            }
                ?>
                                <tr>
                                    <td colspan="2" style="text-align: right;">
                                        <div class="Input_Field">
                                            <label>Type</label>

                                            <input type="text" name="txtType" required>
                                        </div>

                                    </td>
                                    <td colspan="2" style="text-align: right;">
                                        <div class="Input_Field">
                                            <input type="submit" name="btnSave" class="Btn" value="Save">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    </form>
                <?php
                    }
                ?>

                
                <?php
                    }
                    else
                    {
                ?>
                    <div class="Records">
                        <table id="tableid" class="display">
                            <thead>
                            <tr>
                                <th>Entry ID</th>
                                <th>Type</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php 
                                $result = Single_Select("DISTINCT ID, Type","Type");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");
                                    echo("<td>" . $rows["Type"] . "</td>");
                                    echo("<td>
                                            <a href='Type.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-chevron-circle-right'></i></button>
                                                <input	type='button' class='Link_Text' value='Details'>
                                            </a>
                                            <a href='Type.php?Delete=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='far fa-trash-alt'></i></button>
                                                <input	type='button' class='Link_Text' value='Delete'>
                                            </a>
                                        </td>");
                                    echo("</tr>");
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>	
                <?php
                    }
                ?>						
            </div>
    </section>

        <script>
            let sidebar = document.querySelector(".sidebar");
            let closeBtn = document.querySelector("#btn");
            let searchBtn = document.querySelector(".bx-search");

            closeBtn.addEventListener("click", ()=>{
                sidebar.classList.toggle("open");
                menuBtnChange();//calling the function(optional)
            });

            searchBtn.addEventListener("click", ()=>{ 
                sidebar.classList.toggle("open");
                menuBtnChange(); 
            });

            function menuBtnChange() {
                if(sidebar.classList.contains("open"))
                {
                    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                }else 
                {
                    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
                }
            }
        </script>
    </body>
</html>
