<?php 
	session_start();
	include("Connect.php");
	include("SQL.php");
	include("Cart_Function.php");

    if(!isset($_SESSION['User_ID']))
    {
        echo ("<script>window.location='Home.php'</script>");
    }

    if(isset($_POST['btnRemove']))
    {
        $Product    = $_POST['txtProduct'];

        if (Delete_Favorite("Favorite", "User", $_SESSION['User_ID'], "AND", "Product", $Product)) 
        {
            echo ("<script>window.location='" . $_SERVER['REQUEST_URI'] . "'</script>");
        }
        else
        {
            echo ("<script>window.alert('Error : Please try again later!')</script>");
            echo ("<script>window.location='" . $_SERVER['REQUEST_URI'] . "'</script>");
        }
    }

	if (isset($_POST['btnCart']))
	{			
		Add($_POST['txtProduct'], $_POST['txtQuantity']);
	}
	elseif (isset($_POST['btnDelete']))
	{
		Remove($_POST['txtDelete']);
	}



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://kit.fontawesome.com/976970d2ed.js"></script>

		<link  rel="stylesheet"  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="Style2.css">

		<title>Rangoon Bakery</title>
	</head>
	<body>

	<?php include "Heading.php" ?>

		<section class="Categories Product">
			<h1 class="Heading"><span>Favorite</span> Products</h1>

			<div class="Box_Container">
			<?php 
                $Favorite   = Multi_Select("*", "Favorite", "User", $_SESSION['User_ID']);
				if (mysqli_num_rows($Favorite) > 0) 
				{
					$Times 	= mysqli_num_rows($Favorite);

                    for($j=0; $j < $Times; $j++)
                    {
                        $TRows  = mysqli_fetch_array($Favorite);
                        $Products   = Multi_Select("*", "Product", "ID", $TRows['Product']);

                        $Count 		= mysqli_num_rows($Products);

						$Rows 	= mysqli_fetch_array($Products);
						$PID	= $Rows['ID'];
            ?>
                        
                            <div class="Box" data-name="<?php echo "P-" .( $j+1) . "" ?>">
                                <img src="<?php echo $Rows['Photo'] ?>">
								<ul class="Action">
									<li>
										<div class="fas fa-eye" id=""></div>
										<span>View</span>
									</li>
								</ul>
                                <h3><?php echo $Rows['Name'] ?></h3>
                                <div class="Price"><?php echo $Rows['Price']; ?> MMK</div>
                                <form action="Favorite.php" method="post">
                                    <input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >

                                    <input type="submit" name="btnRemove" onclick=" return confirm('Delete this form Favorite!') " class="Btn" value="Remove">
                                </form>
                            </div>
                    
            <?php
                    }
				}
                else
                {
                    echo("<script>window.alert('You do not have any favorite product yet!')</script>");
                    echo("<script>window.location='Products.php'</script>");
                }
		    ?>
			</div>
		</section>

		<div class="Product_Preview">
			<?php 	
				$Favorite   = Multi_Select("*", "Favorite", "User", $_SESSION['User_ID']);

				$Times 	= mysqli_num_rows($Favorite);
				
				for ($j=0; $j < $Times; $j++) 
				{ 
					$TRows  = mysqli_fetch_array($Favorite);
                    $Products   = Multi_Select("*", "Product", "ID", $TRows['Product']);

					$Count 		= mysqli_num_rows($Products);
				
					$PRows 	= mysqli_fetch_array($Products);
					$PID 	= $PRows['ID'];
			?>
					<div class="Preview" data-target="<?php echo "P-" . ($j+1) . "" ?>">
						<i class="fas fa-times"></i>
						<img src="<?php echo $PRows['Photo'] ?>">
						<h3><?php echo $PRows['Name']; ?></h3>
						<div class="Price">Price : <?php echo $PRows['Price']; ?> MMK</div>
						<?php
							if ($PRows['Stock'] > 0)
							{
						?>
							<form action="Favorite.php" method="post">
								<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
								<div class="Price">Qty : <input type="number" min="1" max="<?php echo $PRows['Stock'] ; ?>" value="1" name="txtQuantity"></div>
							
								<input type="submit" name="btnCart" class="Btn" value="Add to Cart">
							</form>
						<?php
							}
							else
							{
						?>
								<input type="submit" disabled name="btnStock" class="Btn" value="Out of Stock !">
						<?php
							}
						?>	
					</div>
			<?php
				}
			?>
		</div>

		<?php include "Footer.php" ?>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js"></script>
	</body>
</html>