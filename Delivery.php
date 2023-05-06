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

    if(isset($_POST['btnAssign']))
    {
        $Driver     = $_POST['cboDelivery'];

        if(Update_Data("Order_Record", "Staff = '$Driver', Status = 'Delivered'", "ID", $_REQUEST['Update']))
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

    if(isset($_POST['btnDeliver']))
    {
        $ID = $_POST['txtID'];

        if(Update_Data("Order_Record", "Status = 'Delivered'", "ID", $ID))
        {
            echo "<script>window.alert('Success!')</script>";
            echo "<script>window.location='Delivery.php'</script>";
        }
        else
        {
            echo "<script>window.alert('Error!')</script>";
            echo "<script>window.location='Delivery.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="New.css">
        <link rel="stylesheet" href="Style2.css">
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
        <section class="Categories Product">
			<h1 class="Heading"><span>Deliveries</span></h1>

			<div class="Box_Container" id="Box_Container">

                <?php
                    $Temp       = Match_Data("*", "Order_Record", "Staff", $Position['Name'], "AND", "Status", "Assign");
                    $Count      = mysqli_num_rows($Temp);

                    for ($i=0; $i < $Count; $i++) 
                    {   
                        $Delivery   = mysqli_fetch_array($Temp);
                        $Temp1      = Multi_Select("*", "Order_Details", "OrderID", $Delivery['ID']);
                        $Count1     = mysqli_num_rows($Temp1);
                        

                ?>
                        <div class="Box BChange" id="#Box" data-name="<?php echo "P-" . ($i+1) . "" ?>">
                            <h3><?php echo "Order ID : " . $Delivery['ID'] ?></h3>
                            <h3>Name : <?php echo $Delivery['Name']; ?></h3> 
                            <h3>Phone : <?php echo $Delivery['Phone']; ?></h3> 
                            <h3>Products : </h3>
                            <?php
                                for ($j=0; $j < $Count1; $j++) 
                                { 
                                    $Record     = mysqli_fetch_array($Temp1);
                                    $Product    = mysqli_fetch_array(Multi_Select("*", "Product", "Name", $Record['Product']));

                            ?>
                                    <div class="Price" > <?php echo $Record['Product'] ; ?> : <span id="<?php echo "BPrice" . ($i); ?>"><?php echo $Record['Quantity']; ?></span></div>
                            <?php
                                }
                            ?>
                            
                            <h3>Location : </h3> <div class="Price" ><span id="<?php echo "BPrice" . ($i); ?>"><?php echo $Delivery['Location']; ?></span></div>
                            <?php
                                if($Delivery['Payment'] == "COD")
                                {
                                ?>
                                    <h3>Cash on Delivery</h3>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <h3>Paid</h3>
                                <?php
                                }
                            ?>
                            <form action="Delivery.php" method="post">
                                <input type="hidden" value="<?php echo $Delivery['ID'] ?>" name="txtID">
                                <input type="submit" class="Btn"  name="btnDeliver" value="Deliver">
                            </form>
                        </div>
                <?php
                    }
                ?>
				
                				
			
			</div>
		</section>
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
