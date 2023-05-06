<?php

    session_start();
	include("Connect.php");
	include("SQL.php");

	if (isset($_POST['btnLogin'])) 
	{
		$Email 		= $_POST['txtemail'];
		$Password	= $_POST['txtpassword'];

		if (mysqli_num_rows(Match_Data("*","Staff","Email",$Email,"And","Password",$Password)) > 0) 
		{
			$rows 	= mysqli_fetch_array(Match_Data("*","Staff","Email",$Email,"And","Password",$Password));
			
			$_SESSION['Staff_ID']	= $rows['ID'];

			echo "<script>window.alert('Login Successful.')</script>";

			if (isset($_SESSION['loc'])) 
			{				
				echo "<script>window.location='" . $_SESSION['loc'] . "'</script>";
			}
			else
			{
                if($rows['Position'] == "HR")
                {
                    echo "<script>window.location='Staff.php'</script>";
                }
                elseif ($rows['Position'] == "Manager") {
                    echo "<script>window.location='Staff.php'</script>";
                }
                elseif ($rows['Position'] == "Receptionist") {
                    echo "<script>window.location='Product.php'</script>";
                }
                elseif ($rows['Position'] == "Driver") {
                    echo "<script>window.location='Delivery.php'</script>";
                }
				
			}
		}
		else
		{
			echo "<script>window.alert('ERROR : The Email or Password is Incorrect!')</script>";
			echo "<script>window.location='Staff_Login.php'</script>";
		}
	}


    if(isset($_POST['btnLogout']))
    {
        unset($_SESSION['Staff_ID']);
        echo "<script>window.location='Staff_Login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="New.css">
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

            function showPreview(event)
                {
                if(event.target.files.length > 0){
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("file-ip-1-preview");
                    preview.src = src;
                    preview.style.display = "block";
                }
                }
        </script>

    <?php
        include "Sidebar.php";
    ?>
    
    <section class="home-section">
        <div class="Item">
            <form action="Staff_Login.php" method="post" class="Form">
                <h1 class="Title">Log In</h1>

                <div class="Input">
                    <input type="text" name="txtemail" placeholder=" " class="Field" required />
                    <label class="Label">Email</label>
                </div>

                <div class="Input">
                    <input type="password" name="txtpassword" placeholder=" " class="Field" required />
                    <label class="Label">Password</label>
                </div>

                <input type="submit" name="btnLogin" class="Button" value="Login">
            </form>
        </div>
    </section>

        <script>
            let sidebar = document.querySelector(".sidebar");
            let closeBtn = document.querySelector("#btn");
            let searchBtn = document.querySelector(".bx-search");

            closeBtn.addEventListener("click", ()=>{
                sidebar.classList.toggle("open");
                menuBtnChange();
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
