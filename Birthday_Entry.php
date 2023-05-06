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

		if (Delete_Data("Birthday","ID",$Delete)) 
        {
            echo "<script>window.alert('Design Successfully Deleted.')</script>";
            echo "<script>window.location='Birthday_Entry.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Error >> " . mysqli_error($connection) . " <<')</script>";
			echo "<script>window.location='Birthday_Entry.php'</script>";
		}
	}

	if (isset($_POST['btnAdd'])) 
	{
        $Name           =   $_FILES['filPhoto']['name'];
        $Photo		    = "ProductPhotos/Birthday_Cakes/" . $Name ."";

        if (copy($_FILES['filPhoto']['tmp_name'], $Photo)) 
        {
            Add($Photo, 0);	
		    echo "<script>window.location='Birthday_Entry.php?New'</script>";
        }
        else
        {

        }
		
	}
	elseif (isset($_POST['btnSet'])) 
	{
		Set($_POST['cboSize'], 0);	
		echo "<script>window.location='Birthday_Entry.php?New'</script>";
	}
	elseif (isset($_REQUEST['Entry_Delete'])) 
	{
		Remove($_REQUEST['Entry_Delete']);
		echo "<script>window.location='Birthday_Entry.php?New'</script>";
	}

	if (isset($_POST['btnSave'])) 
	{
		if (isset($_SESSION['Entry'])) 
		{
			$ID 		= Max_ID("ID","Birthday");
			$Design		= $_POST['txtDesign'];
			$Total_P	= count($_SESSION['Entry']);


			

			for ($i=0; $i < $Total_P; $i++) 
			{ 
				if (Insert_Data("Birthday","(ID, Photo, Design)", "('$ID', '" . $_SESSION['Entry'][$i]['Product'] . "', '$Design')")) 
				{
					
				}
				else
				{
					Delete_Data("Birthday", "ID", $ID);
					unset($_SESSION['Entry']);

					echo "<script>window.alert('Error')</script>";
					echo "<script>window.location='Birthday_Entry.php?New'</script>";
				}
			}

			echo "<script>window.alert('Design Successfully Added!')</script>";
			echo "<script>window.location='Birthday_Entry.php?New'</script>";
			unset($_SESSION['Entry']);
			
		}
		else
		{
			echo "<script>window.alert('Add Design First!')</script>";
			echo "<script>window.location='Birthday_Entry.php?New'</script>";
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

    <?php include "Sidebar.php"; ?>
    
    <section class="home-section">
        <form action="Birthday_Entry.php" method="post" enctype="multipart/form-data">
            <div class="Item">
                <div class="Header">
                    <table>
                        <tr>
                            <th><h1 class="Page">Birthday Cake</h1></th>

                            <th>
                                <a href="Birthday_Entry.php?New">
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
                            <?php 
                                if (isset($_REQUEST['Entry_Update']))
                                {
                            ?>
                                <div class="Form_Input">
                                    <div class="preview">
                                        <img id="file-ip-1-preview">
                                    </div>

                                    <label for="file-ip-1">Photo</label>
                                    <input type="file" id="file-ip-1" value="<?php echo $_SESSION['Entry'][$_REQUEST['Entry_Update']]['Product'] ; ?>" accept="image/*" name="filPhoto" onchange="showPreview(event);" required />
                                </div>
                            <?php
                                }
                                elseif(isset($_REQUEST['Update']))
                                {
                            ?>
                                <div class="Form_Input">
                                    <div class="preview">
                                        <img id="file-ip-1-preview" src="<?php echo $_SESSION['Entry'][$_REQUEST['Update']]['Product'] ; ?>" >
                                    </div>

                                    <label for="file-ip-1">Photo</label>
                                    <input type="file" id="file-ip-1" accept="image/*" name="filPhoto" onchange="showPreview(event);" required />
                                </div>
                            <?php
                                }
                                else
                                {
                            ?>
                                 <div class="Form_Input">
                                    <div class="preview">
                                        <img id="file-ip-1-preview">
                                    </div>

                                    <label for="file-ip-1">Photo</label>
                                    <input type="file" id="file-ip-1" accept="image/*" name="filPhoto" onchange="showPreview(event);" required />
                                </div>		
                            <?php
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
                <form action="Birthday_Entry.php" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>

                            <tbody>
                <?php
                                    $result	= Multi_Select("*","Birthday","ID",$_REQUEST['Update']);
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
                                                echo("<td>
                                                        <a href='Birthday_Entry.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                    </td>");
                                                echo "</tr>";
                                            }
                                            else
                                            {
                                                echo "<tr>";
                                                echo "<td>" . $ID . "</td>";
                                                echo "<td><img src='" . $rows['Photo'] . "' class='Image'></td>";
                                                echo("<td>
                                                        <a href='Birthday_Entry.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
                                                    </td>");
                                                echo "</tr>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<tr>";
                                            echo "<td>" . $ID . "</td>";
                                            echo "<td><img src='" . $rows['Photo'] . "' class='Image'></td>";
                                            echo("<td>
                                                    <a href='Birthday_Entry.php?Delete=$ID'><i class='far fa-trash-alt'></i></a>
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
                <form action="Birthday_Entry.php" method="post" enctype="multipart/form-data">
                    <div class="Data">
                        <table id="tableid" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Design</th>
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
                                    echo "<td><img src='" . $_SESSION['Entry'][$i]['Product'] . "' class='Image'></td>";
                                    echo("<td>
                                            <a href='Birthday_Entry.php?Entry_Delete=$i'><i class='far fa-trash-alt'></i></a>
                                        </td>");
                                    echo "</tr>";
                                }
                            }
                ?>
                                <tr>
                                    <td colspan="2" style="text-align: right;">
                                        <div class="Input_Field">
                                            <label>Design</label>

                                            <input type="text" name="txtDesign" required>
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
                                <th>Design</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php 
                                $result = Single_Select("DISTINCT Design, ID","Birthday");
                                $count	= mysqli_num_rows($result);

                                for ($i=0; $i < $count; $i++) 
                                { 
                                    $rows 	=	mysqli_fetch_array($result);
                                    $ID 	= 	$rows["ID"];


                                    echo("<tr>");
                                    echo("<td>" . $ID . "</td>");
                                    echo("<td>" . $rows["Design"] . "</td>");
                                    echo("<td>
                                            <a href='Birthday_Entry.php?New&&Update=$ID' class='Link'>
                                                <button class='Link_Icon'><i class='fas fa-chevron-circle-right'></i></button>
                                                <input	type='button' class='Link_Text' value='Details'>
                                            </a>
                                            <a href='Birthday_Entry.php?Delete=$ID' class='Link'>
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
