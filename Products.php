<?php 
	session_start();
	include("Connect.php");
	include("SQL.php");
	include("Cart_Function.php");


	if(isset($_POST['btnFavorite']))
	{
		if(isset($_SESSION['User_ID']))
		{
			$Product 	= $_POST['txtProduct'];
			$User 		= $_SESSION['User_ID'];

			if(mysqli_num_rows(Match_Data("*", "Favorite", "User", $User, "AND", "Product", $Product)) > 0)
			{
				echo "<script>window.alert('Product already in the favorite')</script>";
				echo "<script>window.location='" . $_SERVER['REQUEST_URI'] . "'</script>";
			}
			else
			{
				if(Insert_Data("Favorite", "(User, Product)", "('" . $User . "', '" . $Product . "')"))
				{
					echo "<script>window.alert('Product added to favorite!')</script>";
					echo "<script>window.location='" . $_SERVER['REQUEST_URI'] . "'</script>";
				}
				else
				{
					echo "<script>window.alert('Error : Please try again later!')</script>";
					echo "<script>window.location='" . $_SERVER['REQUEST_URI'] . "'</script>";
				}
			}
		}
		else
		{
			$_SESSION['Location'] =  $_SERVER['REQUEST_URI'];
			echo "<script>window.alert('You will need to login first!')</script>";
			echo "<script>window.location='User_Login.php'</script>";
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

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<title>Rangoon Bakery</title>
	</head>
	<body>

	<?php include "Heading.php" ?>
		
		<?php
			if(isset($_POST['btnSearch']))
			{
		?>
				<section class="Categories Product">
				<h1 class="Heading"><span>Search</span> Result</h1>
		<?php
				$Data 	= $_POST['txtSearch'];

				$Result = Single_Select("*", "Product WHERE Name LIKE '%" . $Data . "%'");
				$Count 	= mysqli_num_rows($Result);

				if($Count > 0)
				{
		?>
				<div class="Box_Container">
		<?php
					for ($i=0; $i < $Count; $i++) 
					{ 
						$Search 	= mysqli_fetch_array($Result);
						$SID 		= $Search['ID'];

		?>
					<div class="Box" data-name="<?php echo "S-" .( $i+1) . "" ?>">
						<img src="<?php echo $Search['Photo'] ?>">
						<ul class="Action">
							<li>
								<div class="fas fa-eye" id=""></div>
								<span>View</span>
							</li>
						</ul>
						<h3><?php echo $Search['Name'] ?></h3>
						<div class="Price"><?php echo $Search['Price']; ?> MMK</div>
					</div>
		<?php
					}
		?>
				</div>
		<?php
				}
				else
				{
					echo("<script>window.alert('Nothing found similar to : " . $Data . "')</script>");
					echo("<script>window.location='Products.php'</script>");
				}
		?>
				</section>

				<div class="Product_Preview">
		<?php
				if(isset($_POST['btnSearch']))
				{
					$Data 	= $_POST['txtSearch'];

					$Result = Single_Select("*", "Product WHERE Name LIKE '%" . $Data . "%'");
					$Count 	= mysqli_num_rows($Result);

					
					for ($j=0; $j < $Count; $j++) 
					{ 
						$Search 	= mysqli_fetch_array($Result);
						$SID 		= $Search['ID'];
		?>
					<div class="Preview" data-target="<?php echo "S-" . ($j+1) . "" ?>">
						<i class="fas fa-times"></i>
						<img src="<?php echo $Search['Photo'] ?>">
						<h3><?php echo $Search['Name']; ?></h3>
						<div class="Price">Price : <?php echo $Search['Price']; ?> MMK</div>
						<form action="Products.php" method="post">
							<input type="text" name="txtProduct" value="<?php echo $SID ?>" hidden >

							<div class="Price">Qty : <input type="number" min="1" max="10" value="1" name="txtQuantity" onkeydown="return false"></div>
							
							<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
							<input type="submit" name="btnCart" class="Btn" value="Add to Cart">
						</form>
					</div>
		<?php
					}
				}
		?>
				</div>
		<?php
			}
			else
			{
		?>
			<section class="Categories Product">
				

				
				<?php 
					if (isset($_REQUEST['Bread'])) 
					{
						$Products 	= Multi_Select("*", "Product", "Category", "Bread");
						$Count 		= mysqli_num_rows($Products);
				?>
						<h1 class="Heading"><span>Bread</span></h1>
						<div class="Box_Container">
				<?php
						for ($i=0; $i < $Count; $i++) 
						{ 
							$Rows 	= mysqli_fetch_array($Products);
							$PID	= $Rows['ID'];
				?>
							<div class="Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $Rows['Photo'] ?>">
								<ul class="Action">
									<li>
										<div class="fas fa-eye" id=""></div>
										<span>View</span>
									</li>
								</ul>
								<h3><?php echo $Rows['Name'] ?></h3>
								<div class="Price"><?php echo $Rows['Price']; ?> MMK</div>
							</div>
					
				<?php
						}
				?>
						</div>
				<?php
					}
					elseif (isset($_REQUEST['Cake'])) 
					{
						$Products 	= Multi_Select("*", "Product", "Category", "Cake");
						$Count 		= mysqli_num_rows($Products);
				?>
						<h1 class="Heading"><span>Cakes</span></h1>
						<div class="Box_Container">
				<?php
						for ($i=0; $i < $Count; $i++) 
						{ 
							$Rows 	= mysqli_fetch_array($Products);
							$PID	= $Rows['ID'];
				?>
							<div class="Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $Rows['Photo'] ?>">
								<ul class="Action">
									<li>
										<div class="fas fa-eye" id=""></div>
										<span>View</span>
									</li>
								</ul>
								<h3><?php echo $Rows['Name'] ?></h3>
								<div class="Price"><?php echo $Rows['Price']; ?> MMK</div>
							</div>
					
				<?php
						}
				?>
						</div>
				<?php
					}
					else
					{
						$Products 	= Single_Select("*", "Product");
						$Count 		= mysqli_num_rows($Products);
				?>
						<h1 class="Heading"><span>Product</span></h1>
						<div class="Box_Container">
				<?php
						for ($i=0; $i < $Count; $i++) 
						{ 
							$Rows 	= mysqli_fetch_array($Products);
							$PID	= $Rows['ID'];
				?>

							<div class="Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $Rows['Photo'] ?>">
								<ul class="Action">
									<li>
										<div class="fas fa-eye" id=""></div>
										<span>View</span>
									</li>
								</ul>
								<h3><?php echo $Rows['Name'] ?></h3>
								<div class="Price"><?php echo $Rows['Price']; ?> MMK</div>
							</div>
				<?php
						}
				?>
						</div>
				<?php
					}
				?>
				
			</section>

			<div class="Product_Preview">
				<?php 	
					if (isset($_REQUEST['Bread'])) 
					{
						$Products 	= Multi_Select("*", "Product", "Category", "Bread");
						$Count 		= mysqli_num_rows($Products);
						for ($j=0; $j < $Count; $j++) 
						{ 
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
								<form action="Products.php?Bread" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									<div class="Price">Qty : <input type="number" min="1" max="<?php echo $PRows['Stock'] ; ?>" value="1" name="txtQuantity" onkeydown="return false"></div>
								
									<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
									<input type="submit" name="btnCart" class="Btn" value="Add to Cart">
								</form>
							<?php
								}
								else
								{
							?>
								<form action="Products.php?Bread" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									
									<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
									<input type="submit" disabled name="btnStock" class="Btn" value="Out of Stock !">
								</form>
							<?php
								}
							?>							
						</div>
				<?php
						}
					}
					elseif (isset($_REQUEST['Cake'])) 
					{
						$Products 	= Multi_Select("*", "Product", "Category", "Cake");
						$Count 		= mysqli_num_rows($Products);
						for ($j=0; $j < $Count; $j++) 
						{ 
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
								<form action="Products.php?Cake" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									<div class="Price">Qty : <input type="number" min="1" max="<?php echo $PRows['Stock'] ; ?>" value="1" name="txtQuantity" onkeydown="return false"></div>
								
									<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
									<input type="submit" name="btnCart" class="Btn" value="Add to Cart">
								</form>
							<?php
								}
								else
								{
							?>
								<form action="Products.php?Cake" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									
									<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
									<input type="submit" disabled name="btnStock" class="Btn" value="Out of Stock !">
								</form>
							<?php
								}
							?>		
						</div>
				<?php
						}
					}
					else 
					{
						$Products 	= Single_Select("*", "Product");
						$Count 		= mysqli_num_rows($Products);
						for ($j=0; $j < $Count; $j++) 
						{ 
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
								<form action="Products.php" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									<div class="Price">Qty : <input type="number" min="1" max="<?php echo $PRows['Stock'] ; ?>" value="1" name="txtQuantity" onkeydown="return false"></div>
								
									<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
									<input type="submit" name="btnCart" class="Btn" value="Add to Cart">
								</form>
							<?php
								}
								else
								{
							?>
								<form action="Products.php" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									
									<button type="submit" name="btnFavorite" class="Btn" title="Add to Favorite"><div class="fas fa-heart"></div></button>
									<input type="submit" disabled name="btnStock" class="Btn" value="Out of Stock !">
								</form>
							<?php
								}
							?>		
						</div>
				<?php
						}
					}
				?>
			</div>

		<?php
			}
		?>

		<?php include "Footer.php" ?>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js"></script>
	</body>
</html>