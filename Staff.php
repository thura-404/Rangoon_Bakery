<?php

    session_start();
	include("Connect.php");
	include("SQL.php");

	if (!isset($_SESSION['Staff_ID'])) 
	{
		echo "<script>window.alert('Alert : >> Please Login To Your Account! <<')</script>";
		$_SESSION['loc'] = "Staff.php";
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

		if (Delete_Data("Staff","ID",$Delete)) 
		{
			echo "<script>window.alert('Staff Successfully Deleted.')</script>";
			echo "<script>window.location='Staff.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Staff.php'</script>";
		}
	}

	if (isset($_POST['btnSave']))
	{
		$ID 		= Max_ID("ID","Staff");
		$Name		= $_POST['txtName'];
		$Father		= $_POST['txtFather'];
		$Mother		= $_POST['txtMother'];
		$Gender		= $_POST['cboGender'];
		$Marital	= $_POST['cboMarital'];
		$Birthday	= $_POST['txtBirthday'];
		$Password	= $_POST['txtPassword'];
		$Phone		= $_POST['txtPhone'];
		$Email		= $_POST['txtEmail'];
		$Role		= $_POST['cboRole'];
		$Address	= $_POST['txtAddress'];

		$NRC 		= $_POST['cboFirst'] . "/" . $_POST['cboSecond'] . $_POST['cboThird'] . $_POST['txtFourth'];
		

		$Photo		= "StaffPhotos/" . $ID . "_" . $Name .".png";


		if (!copy($_FILES['filPhoto']['tmp_name'], $Photo)) 
		{
			echo "<script>window.alert('Error Uploading Photo!')</script>";
			echo "<script>window.location='Staff.php'</script>";
		}
		else
		{
			if (Insert_Data("Staff",
							"(ID, Name, Father, Mother, Gender, Marital_Status, Birthday, Password, PH_No, Email, Position, NRC, Address, Registration_Date, Photo)",
							"('$ID', '$Name', '$Father', '$Mother', '$Gender', '$Marital', '$Birthday', '$Password', '$Phone', '$Email', '$Role', '$NRC', '$Address', '" . date("Y/m/d") . "', '$Photo')"))
			{
				echo "<script>window.alert('Staff Successfully Saved.')</script>";
				echo "<script>window.location='Staff.php'</script>";	
			}
			else
			{
				echo "<script>window.alert('Error >>" . mysqli_error($connection) . "<<')</script>";
				echo "<script>window.location='Staff.php'</script>";
			}
		}
	}

    if (isset($_POST['btnUpdate'])) 
    {
        $Phone      = $_POST['txtPhone'];
        $Email      = $_POST['txtEmail'];
        $Role       = $_POST['cboRole'];
        $Address    = $_POST['txtAddress'];

        if(mysqli_num_rows(Match_Data("*", "Staff", "Email", $Email, "AND NOT", "ID", $_SESSION['Update'])) > 0)
        {
            echo "<script>window.alert('ALert : Staff with the same email already exists!')</script>";
            echo "<script>window.location='Staff.php'</script>";
        }
        else
        {
            if(Update_Data("Staff", "Ph_No = '$Phone', Email = '$Email', Position = '$Role', Address = '$Address'", "ID", $_SESSION['Update']))
            {
                echo "<script>window.alert('ALert : Staff details successfully updated.')</script>";
                echo "<script>window.location='Staff.php'</script>";
                unset($_SESSION['Update']);
            }
            else
            {
                echo "<script>window.alert('Error : Please try again later!')</script>";
                header($_SERVER['REQUEST_URI']);
            }
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

    <script src="select2.min.js">
        $("#Data").select2( {
            placeholder: "Select Country",
            allowClear: true
        });
    </script>

    <?php include "Sidebar.php"; ?>
    
    <section class="home-section">
        <form action="Staff.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Staff</h1></th>

                            <th>
                                <a href="Staff.php?New">
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
                            $Rows		= mysqli_fetch_array(Multi_Select("*","Staff","ID",$_SESSION['Update']));
                        }
                        else
                        {
                    ?>

                        <div class="Input_Field">
                            <div class="Form_Input">
                                <div class="preview">
                                    <img id="file-ip-1-preview">
                                </div>

                                <label for="file-ip-1">Photo</label>
                                <input type="file" id="file-ip-1" accept="image/*" name="filPhoto" onchange="showPreview(event);" required="required" />
                            </div>						
                        </div>

                        <div class="Input_Field">
                            <label>Name</label>

                            <input type="text" name="txtName" class="Input" required />								
                        </div>			

                        <div class="Input_Field">
                            <label>Father</label>

                            <input type="text" name="txtFather" class="Input" required />								
                        </div>

                        <div class="Input_Field">
                            <label>Mother</label>

                            <input type="text" name="txtMother" class="Input" required />								
                        </div>					

                        <div class="Input_Field">
                            <label>Gender</label>

                            <div class="Custom_Select">
                                <select name="cboGender" required class="form-control">
                                    <option disabled selected hidden value="">Choose</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="Input_Field">
                            <label>Marital Status</label>

                            <div class="Custom_Select">
                                <select name="cboMarital" required class="form-control" data-live-search="true">
                                    <option disabled selected hidden value="">Choose</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                        </div>

                        <div class="NRC">
                            <label class="NRC_Label">NRC</label>

                            <div class="Input_Field">
                                <label>9/</label>

                                <div class="Custom_Select">
                                    <select name="cboFirst" id="Choose" required class="Choose form-control">
                                        <option disabled selected hidden value="">Choose</option>
                                        <?php 
                                            for ($i=0; $i < 14; $i++) 
                                            { 
                                                echo "<option value='" . ($i + 1) . "'>" . ($i + 1) . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="Input_Field">
                                <label>AHMAZA</label>

                                <div class="Custom_Select">
                                    <select name="cboSecond" id="Data" required class="form-control"  class="country_list">
                                        <option disabled selected hidden value="">Choose</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="Input_Field">
                                <label>(N)</label>

                                <div class="Custom_Select">
                                    <select name="cboThird" required class="form-control">
                                        <option disabled selected hidden value="">Choose</option>
                                        <option value="(N)">(N)</option>
                                        <option value="(P)">(P)</option>
                                        <option value="(E)">(E)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="Input_Field">
                            <label>076141</label>

                            <input type="text" name="txtFourth" class="Input" required />								
                        </div>		
                        </div>

                        <div class="Input_Field">
                            <label>Birthday</label>

                            <input type="date" name="txtBirthday" class="Input" required />								
                        </div>	

                        <div class="Input_Field">
                            <label>Password</label>

                            <input type="password" name="txtPassword" class="Input" required />								
                        </div>
                    <?php
                        }

                    ?>

                    <div class="Input_Field">
                        <label>Phone</label>

                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='text' name='txtPhone' value='" . $Rows['Ph_No'] . "' class='Input' required>";
                            }
                            else
                            {
                                echo "<input type='text' name='txtPhone' class='Input' required>";
                            }
                        ?>
                    </div>

                    <div class="Input_Field">
                        <label>Email</label>

                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {

                                echo "<input type='email' name='txtEmail' value='" . $Rows['Email'] . "' class='Input' required>";
                            }
                            else
                            {
                                echo "<input type='email' name='txtEmail' class='Input' required>";
                            }
                        ?>
                    </div>

                    <div class="Input_Field">
                        <label>Role</label>

                        <div class="Custom_Select">
                            <select name="cboRole" required class="form-control">
                                <?php 

                                    $RResult 	= Single_Select("*", "Role");
                                    $RCount		= mysqli_num_rows($RResult);
                                    
                                    if (isset($_REQUEST['Update'])) 
                                    {
                                        for ($i=0; $i < $RCount; $i++) 
                                        { 
                                            $RRows	= mysqli_fetch_array($RResult);

                                            if ($RRows['Title'] == $Rows['Position']) 
                                            {
                                                echo "<option selected value='" . $RRows['Title'] . "'>" . $RRows['Title'] . "</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='" . $RRows['Title'] . "'>" . $RRows['Title'] . "</option>";	
                                            }													
                                        }
                                    }
                                    else
                                    {	
                                        echo "<option disabled selected hidden value=''>Choose</option>";
                                        for ($i=0; $i < $RCount; $i++) 
                                        { 
                                            $RRows	= mysqli_fetch_array($RResult);

                                            echo "<option value='" . $RRows['Title'] . "'>" . $RRows['Title'] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="Input_Field">
                        <label>Address</label>

                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {

                                echo "<textarea class='Textarea' name='txtAddress' required>" . $Rows['Address'] . "</textarea>";
                            }
                            else
                            {
                                echo "<textarea class='Textarea' name='txtAddress' required></textarea>";	
                            }
                        ?>
                    </div>


                    <div class="Input_Field">
                        <?php 
                            if (isset($_REQUEST['Update'])) 
                            {
                                echo "<input type='submit' name='btnUpdate' class='Btn' value='Update'>";
                            }
                            else
                            {
                                echo "<input type='submit' name='btnSave' class='Btn' value='Save'>";
                            }
                        ?>
                        
                        <input type="submit" id="Main" name="btnCancle" class="Btn" value="Cancle">
                    </div>
                </div>

                <div class="Data">
                    <table id="tableid" class="display">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $result	= Single_Select("*","Staff");
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
                                            echo "<td><img src='" . $rows['Photo'] . "' class='Image'></td>";
                                            echo "<td>" . $rows['Name'] . "</td>";
                                            echo("<td>" . $rows["Position"] . "</td>");
                                            echo("<td>
                                                    <a href='Staff.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Staff.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td><img src='" . $rows['Photo'] . "' class='Image'></td>";
                                            echo("<td>" . $rows["Name"] . "</td>");
                                            echo("<td>" . $rows["Position"] . "</td>");
                                            echo("<td>
                                                    <a href='Staff.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                    |
                                                    <a href='Staff.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                </td>");
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $ID . "</td>";
                                        echo "<td><img src='" . $rows['Photo'] . "' class='Image'></td>";
                                        echo "<td>" . $rows['Name'] . "</td>";
                                        echo("<td>" . $rows["Position"] . "</td>");
                                        echo("<td>
                                                <a href='Staff.php?New&&Update=$ID'><i class='fas fa-pencil-alt'></i></a>
                                                |
                                                <a href='Staff.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                            </td>");
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                    }
                    else
                    {
                ?>
                    <div class="Records">
                        <table id="tableid" class="display">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php 
                                $result = Single_Select("*","Staff");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");

                                    echo("<td>
                                        <img src='" . $rows["Photo"] . "'>
                                        </td>");

                                    echo("<td>" . $rows["Name"] . "</td>");
                                    echo("<td>" . $rows["Position"] . "</td>");
                                    echo("<td>" . $rows["Email"] . "</td>");
                                    echo("<td>" . $rows["Ph_No"] . "</td>");
                                    echo("<td>" . $rows["Address"] . "</td>");
                                    echo("<td>
                                            <a href='Staff.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-pencil-alt'></i></button>
                                                <input	type='button' class='Link_Text' value='Update'>
                                            </a>
                                            <a href='Staff.php?Delete=$ID' class='Link'>
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
        </form>
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
