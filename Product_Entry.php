<?php

    session_start();
	include("Connect.php");
	include("SQL.php");
    include("Product_Entry_Function.php");

	if (!isset($_SESSION['Staff_ID'])) 
	{
		echo "<script>window.alert('Alert : >> Please Login To Your Account! <<')</script>";
		$_SESSION['loc'] = "Product_Entry.php";
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

		if (Delete_Data("Entry_Record","Entry_ID",$Delete)) 
		{
			if (Delete_Data("Entry_Details", "Entry_ID", $Delete)) 
			{
				echo "<script>window.alert('Product Entry Record Successfully Deleted.')</script>";
				echo "<script>window.location='Product_Entry.php'</script>";
			}
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Product_Entry.php'</script>";
		}
	}

	if (isset($_POST['btnAdd'])) 
	{
		Add($_POST['cboProduct'], $_POST['txtQuantity']);	
		echo "<script>window.location='Product_Entry.php?New'</script>";
	}
	elseif (isset($_POST['btnSet'])) 
	{
		Set($_POST['cboProduct'], $_POST['txtQuantity']);	
		echo "<script>window.location='Product_Entry.php?New'</script>";
	}
	elseif (isset($_REQUEST['Entry_Delete'])) 
	{
		Remove($_REQUEST['Entry_Delete']);
		echo "<script>window.location='Product_Entry.php?New'</script>";
	}

	if (isset($_POST['btnSave'])) 
	{
		if (isset($_SESSION['Entry'])) 
		{
			$ID 		= Max_ID("Entry_ID","Entry_Record");
			$Factory = $_POST['cboFactory'];
			$Total_P	= count($_SESSION['Entry']);


			if (Insert_Data("Entry_Record","(Entry_ID, Total_Product, Factory, Date)", "('$ID', '$Total_P', '$Factory', '" .  date("Y/m/d") . "')"))
			{

				for ($i=0; $i < $Total_P; $i++) 
				{ 
					if (Insert_Data("Entry_Details","(Entry_ID, Product, Quantity)", "('$ID', '" . $_SESSION['Entry'][$i]['Product'] . "', '" . $_SESSION['Entry'][$i]['Quantity'] . "')")) 
					{
                        $Product = mysqli_fetch_array(Multi_Select("ID", "Product" , "Name", $_SESSION['Entry'][$i]['Product']));
						if(Update_Data("Product", "Stock = Stock + '" . $_SESSION['Entry'][$i]['Quantity'] . "'", "ID", $Product[0]))
                        {

                        }
                        else
                        {
                            Delete_Data("Entry_Details", "ID", $ID);
                            Delete_Data("Entry_Record", "ID", $ID);
                            unset($_SESSION['Entry']);

                            echo "<script>window.alert('Error')</script>";
                            echo "<script>window.location='Product_Entry.php?New'</script>";
                        }
					}
					else
					{
						Delete_Data("Entry_Details", "ID", $ID);
						Delete_Data("Entry_Record", "ID", $ID);
						unset($_SESSION['Entry']);

						echo "<script>window.alert('Error')</script>";
						echo "<script>window.location='Product_Entry.php?New'</script>";
					}
				}

				echo "<script>window.alert('Products Successfully Added!')</script>";
				echo "<script>window.location='Product_Entry.php?New'</script>";
				unset($_SESSION['Entry']);
			}
		}
		else
		{
			echo "<script>window.alert('Add Products First!')</script>";
			echo "<script>window.location='Product_Entry.php?New'</script>";
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
                        window.location = "Staff.php";
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

    <script src="select2.min.js">
        $("#Data").select2( {
            placeholder: "Select Country",
            allowClear: true
        });
    </script>

    <?php include "Sidebar.php"; ?>
    
    <section class="home-section">
        <form action="Product_Entry.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Stock In</h1></th>

                            <th>
                                <a href="Product_Entry.php?New">
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
                            $Rows		= mysqli_fetch_array(Multi_Select("*","Entry_Details","Entry_ID",$_SESSION['Update']));
                        }
                        else
                        {
                    ?>
                        <div class="Input_Field">
                            <label>Product</label>

                            <div class="Custom_Select">
                                <select name="cboProduct" id="Data" required class="form-control">
                                    <?php 

                                        $RResult 	= Single_Select("*", "Product");
                                        $RCount		= mysqli_num_rows($RResult);
                                        
                                        if (isset($_REQUEST['Entry_Update'])) 
                                        {
                                            for ($i=0; $i < $RCount; $i++) 
                                            { 
                                                $RRows	= mysqli_fetch_array($RResult);

                                                if ($RRows['Name'] == $_SESSION['Entry'][$_REQUEST['Entry_Update']]['Product']) 
                                                {
                                                    echo "<option selected value='" . $RRows['Name'] . "'>" . $RRows['Name'] . "</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='" . $RRows['Name'] . "'>" . $RRows['Name'] . "</option>";	
                                                }													
                                            }
                                        }
                                        elseif (isset($_REQUEST['Update'])) 
                                        {
                                            for ($i=0; $i < $RCount; $i++) 
                                            { 
                                                $RRows	= mysqli_fetch_array($RResult);

                                                if ($RRows['Name'] == $Rows['Product']) 
                                                {
                                                    echo "<option selected value='" . $RRows['Name'] . "'>" . $RRows['Name'] . "</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='" . $RRows['Name'] . "'>" . $RRows['Name'] . "</option>";	
                                                }													
                                            }
                                        }
                                        else
                                        {	
                                            echo "<option disabled selected hidden value=''>Choose</option>";
                                            for ($i=0; $i < $RCount; $i++) 
                                            { 
                                                $RRows	= mysqli_fetch_array($RResult);

                                                echo "<option value='" . $RRows['Name'] . "'>" . $RRows['Name'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="Input_Field">
                            <label>Quantity</label>

                            <?php 
                                if (isset($_REQUEST['Entry_Update'])) 
                                {
                                    echo "<input type='number' name='txtQuantity' step='1' min='1' value='" . $_SESSION['Entry'][$_REQUEST['Entry_Update']]['Quantity'] . "' class='Input' required>";
                                }
                                elseif (isset($_REQUEST['Update'])) 
                                {
                                    $PRows		= mysqli_fetch_array(Multi_Select("Price","Product","ID",$_SESSION['Update']));

                                    echo "<input type='number' name='txtQuantity' step='1' min='1' value='" . $PRows['0'] . "' class='Input' required>";
                                }
                                else
                                {
                                    echo "<input type='number' name='txtQuantity' step='1' min='1' value='1' class='Input' required>";
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
                <form action="Product_Entry.php" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>Entry ID</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>

                            <tbody>
                <?php
                                    $result	= Multi_Select("*","Entry_Details","Entry_ID",$_REQUEST['Update']);
                                    $count	= mysqli_num_rows($result);

                                    for ($i=0; $i < $count; $i++) 
                                    { 
                                        $rows 	=	mysqli_fetch_array($result);
                                        $ID 	= 	$rows["Entry_ID"];

                                        if (isset($_REQUEST['Update'])) 
                                        {
                                            
                                            if ($ID == $_SESSION['Update']) 
                                            {
                                                echo "<tr class='Update'>";
                                                echo "<td>" . $ID . "</td>";
                                                echo "<td>" . $rows['Product'] . "</td>";
                                                echo "<td>" . $rows['Quantity'] . "</td>";
                                                echo("<td>
                                                        <a href='Product_Entry.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                        |
                                                        <a href='Product_Entry.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                    </td>");
                                                echo "</tr>";
                                            }
                                            else
                                            {
                                                echo "<tr>";
                                                echo "<td>" . $ID . "</td>";
                                                echo "<td>" . $rows['Product'] . "</td>";
                                                echo "<td>" . $rows['Quantity'] . "</td>";
                                                echo("<td>
                                                        <a href='Product_Entry.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                        |
                                                        <a href='Product_Entry.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                    </td>");
                                                echo "</tr>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td>" . $rows['Product'] . "</td>";
                                            echo "<td>" . $rows['Quantity'] . "</td>";
                                            echo("<td>
                                                    <a href='Product_Entry.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Product_Entry.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
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
                <form action="Product_Entry.php" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
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
                                            <a href='Product_Entry.php?New&&Entry_Update=$i'><i class='fas fa-pencil-alt'></i></a>
                                            |
                                            <a href='Product_Entry.php?Entry_Delete=$i'><i class='far fa-trash-alt'></i></a>
                                        </td>");
                                    echo "</tr>";
                                }
                            }
                ?>
                                <tr>
                                    <td colspan="2" style="text-align: right;">
                                        <div class="Input_Field">
                                            <label>Factory</label>

                                            <div class="Custom_Select">
                                                <select name="cboFactory" required class="form-control">
                                                    <?php 

                                                        $RResult 	= Single_Select("*", "Factory");
                                                        $RCount		= mysqli_num_rows($RResult);
                                                        
                                                            
                                                        echo "<option disabled selected hidden value=''>Choose</option>";
                                                        for ($i=0; $i < $RCount; $i++) 
                                                        { 
                                                            $RRows	= mysqli_fetch_array($RResult);

                                                            echo "<option value='" . $RRows['Name'] . "'>" . $RRows['Name'] . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
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
                                <th>Total Product</th>
                                <th>Factory</th>
                                <th>Date</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php 
                                $result = Single_Select("*","Entry_Record");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["Entry_ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");
                                    echo("<td>" . $rows["Total_Product"] . "</td>");
                                    echo("<td>" . $rows["Factory"] . "</td>");
                                    echo("<td>" . $rows["Date"] . "</td>");
                                    echo("<td>
                                            <a href='Product_Entry.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-chevron-circle-right'></i></button>
                                                <input	type='button' class='Link_Text' value='Details'>
                                            </a>
                                            <a href='Product_Entry.php?Delete=$ID' class='Link'>
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

    <script src="select2.min.js"></script>
    <script>
    $("#Data").select2( {
        placeholder: "Choose",
        allowClear: true
        } );
    </script>

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
