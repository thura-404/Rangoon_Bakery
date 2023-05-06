<?php
	session_start();
	include("Connect.php");
	include("SQL.php");
	include("Cart_Function.php");

	if(isset($_POST['btnLogout']))
    {
        unset($_SESSION['User_ID']);
        unset($_SESSION['User_Name']);
        unset($_SESSION['User_Email']);
		unset($_SESSION['access_token']);
    }
	elseif (isset($_POST['btnLogin'])) 
	{
		$_SESSION['Location'] 	= $_SERVER['REQUEST_URI'];
		echo("<script>window.location='User_Login.php'</script>");
	}

	
	if (isset($_POST['btnView']))
	{
		echo "<script>window.location='Cart.php'</script>";
	}
	elseif (isset($_POST['btnCheckout'])) 
	{
		echo "<script>window.location='Checkout.php'</script>";
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

		<section class="Home" id="Home">
			<div class="Content">
				<h3>Fresh Products for you</h3>
				<p>You don't have to love cooking to cook, but you have to do more than love baking to bake. You have to bake out of love.</p>
				<a href="Products.php" class="Btn">Shop Now</a>
			</div>
		</section>

		<section class="Feature">
			<h1 class="Heading">Our <span>Features</span></h1>

			<div class="Box_Container">	
				<div class="Box">
					<img src="HomePhotos/feature-img-1.png" alt="" srcset="">
					<h3>Fresh & Organic</h3>
					<p>Fresh foods lengthen lifespan. <br> Organic foods have more vitamins, minerals, antioxidants and secondary metabolites than non-organic foods.</p>
				</div>

				<div class="Box">
					<img src="HomePhotos/feature-img-2.png" alt="" srcset="">
					<h3>Free Delivery</h3>
					<p>Free when you need it to be. <br> if it's delivered, it's delivered for free. if it's on time, it's still free. <br> Free Delivery above 25000MMK.</p>
				</div>

				<div class="Box">
					<img src="HomePhotos/feature-img-3.png" alt="" srcset="">
					<h3>Easy Payments</h3>
					<p>My Mobile... My bank... My Wallet... <br> Pay with Mobile pay (KBZ Pay, Wave Pay)</p>
				</div>
			</div>
		</section>

		<section class="Products" id="Products">
			<h1 class="Heading">Our <span>Products</span></h1>

			<div class="swiper Product_Slider">
				<div class="swiper-wrapper">

				<?php
					$Bread = Multi_Select("*", "Product", "Category", "Bread");
					
					for ($i=0; $i < 5; $i++) 
					{ 
						$BRows 	= mysqli_fetch_array($Bread);
						$BID 	= $BRows['ID'];
				?>

					<form action="Home.php" method="post" class="swiper-slide">
						<div class="Box">
							<img src="<?php echo $BRows['Photo'] ?>" alt="">
							<h3><?php echo $BRows['Name'] ?></h3>
							<div class="Price"><?php echo $BRows['Price'] ?></div>
							<input type="hidden" value="<?php echo($BID) ?> " id="Product"  name="txtProduct">
							<input type="hidden" value="1" name="txtQuantity" id="Quantity">  
							<input type="submit" value="Add to Cart" id="Cart" name="btnCart" class="Btn">
						</div>
					</form>
				<?php
					}
				?>
				</div>
			</div>

			<div class="swiper Product_Slider">
				<div class="swiper-wrapper">

				<?php
					$Cake = Multi_Select("*", "Product", "Category", "Cake");
					
					for ($i=0; $i < 5; $i++) 
					{ 
						$CRows 	= mysqli_fetch_array($Cake);
						$CID 	= $CRows['ID'];
				?>
					
					<form action="Home.php" method="post" class="swiper-slide">
						<div class="Box">
							<img src="<?php echo $CRows['Photo'] ?>" alt="">
							<h3><?php echo $CRows['Name'] ?></h3>
							<div class="Price"><?php echo $CRows['Price'] ?></div>
							<input type="hidden" value="<?php echo($CID) ?> " id="Product" name="txtProduct">
							<input type="hidden" value="1" name="txtQuantity" id="Quantity" >  
							<input type="submit" value="Add to Cart" id="Cart" name="btnCart" class="Btn">
						</div>
					</form>

				<?php
					}
				?>
				</div>
			</div>
		</section>

		<?php 
			if(isset($_SESSION['User_ID']))
			{
				$Result 	= Multi_Select("*", "Favorite", "User", $_SESSION['User_ID']);
				$Count 		= mysqli_num_rows($Result);

				if($Count > 0)
				{
		?>
			<section class="Products" id="Products">
				<h1 class="Heading"><span>Favorite</span> Products</h1>

				<div class="swiper Product_Slider">
					<div class="swiper-wrapper">
		<?php
					for ($i=0; $i < $Count; $i++) 
					{ 
						$Favorite 	= mysqli_fetch_array($Result);
						$FPRoduct	= mysqli_fetch_array(Multi_Select("*", "Product", "ID", $Favorite['Product']));
						$FID 		= $FPRoduct['ID'];
						
 
		?>
						<form action="Home.php" class="post" class="swiper-slide">
							<div class="Box">
								<img src="<?php echo $FPRoduct['Photo']?>" alt="">
								<h3><?php echo $FPRoduct['Name'] ?></h3>
								<div class="Price"><?php echo $FPRoduct['Price'] ?></div>
								<input type="hidden" value="<?php echo($FID) ?> " id="Product" name="txtProduct">
								<input type="hidden" value="1" id="Quantity" name="txtQuantity" >  
								<input type="submit" value="Add to Cart" id="Cart" name="btnCart" class="Btn">
							</div>
						</form>
		<?php
					}
		?>
					</div>
				</div>
			</section>
		<?php
				}
			}
		?>

		<section class="Categories" id="Categories">
			<h1 class="Heading">Product <span>Categories</span></h1>

			<div class="Box_Container">	
				<div class="Box">
					<img src="HomePhotos/Categories_Bread.png" alt="">
					<h3>Bread</h3>
					<a href="Products.php?Bread" class="Btn">Shop Now</a>
				</div>

				<div class="Box">
					<img src="HomePhotos/Categories_Cake.png" alt="">
					<h3>Cake</h3>
					<a href="Products.php?Cake" class="Btn">Shop Now</a>
				</div>

				<div class="Box">
					<img src="HomePhotos/Custom_Cake.png" alt="">
					<h3>Birthday Cake</h3>
					<a href="Birthday.php" class="Btn">Shop Now</a>
				</div>
			</div>
		</section>

		<?php include "Footer.php" ?>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js"></script>

		
	</body>
</html>