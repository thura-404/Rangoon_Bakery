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
        $Order      = mysqli_fetch_array(Single_Select("*", "Order_Record"));
        $Detail     = mysqli_fetch_array(Single_Select("*", "Order_Details"));
    }

    if(isset($_POST['btnAssign']))
    {
        $Driver     = $_POST['cboDelivery'];

        if(Update_Data("Order_Record", "Staff = '$Driver', Status = 'Assign'", "ID", $_REQUEST['Update']))
        {
            echo "<script>window.alert('Success : >> THE Purcel is on the way! <<')</script>";
            echo "<script>window.locaion='Search.php'</script>";
        }
        else
        {
            echo "<script>window.alert('Error : >> Please try again later ! <<')</script>";
            echo "<script>window.locaion='Search.php'</script>";
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
                        window.location = "Search.php";
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
        <form action="Search.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Orders</h1></th>
                            <th></th>
                        </tr>
                    </table>
                </div>

                <?php 
                    if (isset($_REQUEST['New'])) 
                    {
                ?>
                    <div class="Form">

                    <div class="Input_Field">
                        <?php 
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
                <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>Deli ID</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>

                            <tbody>
                <?php
                                    $result	= Multi_Select("*","Order_Details","OrderID",$_REQUEST['Update']);
                                    $count	= mysqli_num_rows($result);

                                    for ($i=0; $i < $count; $i++) 
                                    { 
                                        $rows 	=	mysqli_fetch_array($result);
                                        $ID 	= 	$rows["ID"];

                                        if (isset($_REQUEST['Update'])) 
                                        {
                                          
                                            echo "<tr class='Update'>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td>" . $rows['Product'] . "</td>";
                                            echo "<td>" . $rows['Price'] . "</td>";
                                            echo "<td>" . $rows['Quantity'] . "</td>";
                                        }
                                    }

                                $Temp   = mysqli_fetch_array(Multi_Select("Status", "Order_Record", "ID", $_REQUEST['Update']));

                                if($Temp[0] == "Pending")
                                {
                            ?>
                                    <tr>
                                        <td colspan="2" style="text-align: right;">
                                            <div class="Input_Field">
                                                <label>Delivery</label>

                                                <div class="Custom_Select">
                                                    <select name="cboDelivery" required class="form-control">
                                                        <?php 

                                                            $RResult 	= Single_Select("*", "Staff WHERE Position = 'Driver'");
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
                                                <input type="submit" name="btnAssign" class="Btn" value="Assign">
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                ?>  
                                
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
                        <form action="Search.php" method="post">
                            <table id="tableid" class="display">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Total Product</th>
                                    <th>Deli Name</th>
                                    <th>Delivery</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>

                            <tbody>
                            
                                <?php 
                                    $result = Single_Select("*","Order_Record");
                                    $count	= mysqli_num_rows($result);

                                    for ($i=0; $i < $count; $i++) 
                                    { 
                                        $rows 	=	mysqli_fetch_array($result);
                                        $ID 	= 	$rows["ID"];


                                        echo("<tr>");
                                        echo("<td>" . $ID . "</td>");
                                        echo("<td>" . mysqli_num_rows(Multi_Select("*", "Order_Details", "OrderID", $ID)) . "</td>");
                                        echo("<td>" . $rows["Name"] . "</td>");
                                        echo("<td>" . $rows["Staff"] . "</td>");
                                        echo("<td>" . $rows["Status"] . "</td>");
                                        echo("<td>
                                                <a href='Search.php?New&&Update=$ID' class='Link'>
                                                    <button class='Link_Icon'><i class='fas fa-chevron-circle-right'></i></button>
                                                    <input	type='button' class='Link_Text' value='Details'>
                                                </a>
                                            </td>");
                                        echo("</tr>");
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </form>
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
