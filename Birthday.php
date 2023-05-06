<?php 
	session_start();
	include("Connect.php");
	include("SQL.php");
	include("Cart_Function.php");
	

	if (isset($_POST['btnCart']))
	{			
		
		Birthday_Add($_POST['txtPhoto'], $_POST['txtDesign'], $_POST['cboSize'], $_POST['cboType'], $_POST['txtQuantity'], $_POST['txtPrice']);
	}
	elseif (isset($_POST['btnDelete']))
	{
		Remove_Birthday($_POST['txtDelete']);
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

	<style type="text/css">

		.Product_Preview .Preview
		{
			display: none;
			padding: 2rem;
			text-align: center;
			background: #fff;
			position: relative;
			margin: 2rem;
			width: 50rem;
			border-radius: 1rem;
			margin-top: 9rem;
		}

		.Product_Preview .Preview .Price select
		{
			padding: 1rem 0;
			color: var(--light-color);
			font-size: 2rem;
			margin: auto 3rem;
		}

		.Product_Preview .Preview img
		{
			height: 40rem;
			margin-top: 0rem;
		}
	</style>

	<body>

		<script>
            $(document).ready( function ()
            {

				$(".Preview").each(function(index) {
					jQuery('#Size'+index).change(function(){
						var Size 		= jQuery(this).val(); 
						var Type 		= jQuery('#Type'+index).val(); 
						var Quantity	= jQuery('#Quantity'+index).val();
						jQuery.ajax({
							type:'post',
							url:'Test.php',
							data:'Size='+Size+'&&Type='+Type,
							success:function(result){
								jQuery('#Price'+index).val(result * Quantity);
								jQuery('#Size'+index).chosen();
								jQuery('#Type'+index).chosen();
							}
						});
					});


					jQuery('#Type'+index).change(function(){
						var Type 		= jQuery(this).val(); 
						var Size 		= jQuery('#Size'+index).val(); 
						var Quantity 	= jQuery('#Quantity'+index).val();
						jQuery.ajax({
							type:'post',
							url:'Test.php',
							data:'Size='+Size+'&&Type='+Type,
							success:function(result){
								jQuery('#Price'+index).val(result * Quantity);
								jQuery('#Size'+index).chosen();
								jQuery('#Type'+index).chosen();
							}
						});
					});

					jQuery('#Quantity'+index).change(function(){
						var Quantity = jQuery(this).val();                     

						var Type = jQuery('#Type'+index).val(); 
						var Size = jQuery('#Size'+index).val(); 
						jQuery.ajax({
							type:'post',
							url:'Test.php',
							data:'Size='+Size+'&&Type='+Type,
							success:function(result){
								jQuery('#Price'+index).val(result * Quantity);
								jQuery('#Size'+index).chosen();
								jQuery('#Type'+index).chosen();
							}
						});
					});
				});

					

                
            } );

         
        </script>

	<?php include "Heading.php" ?>
		
		
			<section class="Categories Product">
				<?php 
					if (isset($_REQUEST['Chocolate'])) 
					{
						$Birthday 	= Multi_Select("*", "Birthday", "Design", "Chocolate Design");
						$Count 		= mysqli_num_rows($Birthday);
				?>
						<h1 class="Heading"><span>Chocolate</span> Design</h1>
						<div class="Box_Container">
				<?php
						for ($i=0; $i < $Count; $i++) 
						{ 
							$BRows 	= mysqli_fetch_array($Birthday);
				?>
							<div class="Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $BRows['Photo'] ?>">
								<ul class="Action">
									<li>
										<div class="fas fa-eye" id=""></div>
										<span>View</span>
									</li>
								</ul>
							</div>
					
				<?php
						}
				?>
						</div>
				<?php
					}
					elseif (isset($_REQUEST['Flower'])) 
					{
						$Birthday 	= Multi_Select("*", "Birthday", "Design", "Flower Design");
						$Count 		= mysqli_num_rows($Birthday);
				?>
						<h1 class="Heading"><span>Chocolate</span> Design</h1>
						<div class="Box_Container">
				<?php
						for ($i=0; $i < $Count; $i++) 
						{ 
							$BRows 	= mysqli_fetch_array($Birthday);
				?>
							<div class="Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $BRows['Photo'] ?>">
								<ul class="Action">
									<li>
										<div class="fas fa-eye" id=""></div>
										<span>View</span>
									</li>
								</ul>
								<h3><?php echo $BRows['Design'] ?></h3>
							</div>
					
				<?php
						}
				?>
						</div>
				<?php
					}
					else
					{
				?>
						<h1 class="Heading"><span>Designs</span></h1>
						<div class="Box_Container">

							<div class="Box">
								<img src="HomePhotos/Chocolate_Cake.png">
								<h3>Chocolate Design</h3>
                                <a href="Birthday.php?Chocolate" class="Btn">Shop Now</a>
                            </div>

							<div class="Box">
								<img src="HomePhotos/Flower_Cake.png">
								<h3>Flower Design</h3>
                                <a href="Birthday.php?Flower" class="Btn">Shop Now</a>
                            </div>

							<div class="Box">
								<img src="HomePhotos/Fruit_Cake.png">
								<h3>Fruit Design</h3>
                                <a href="Birthday.php?Fruit" class="Btn">Shop Now</a>
                            </div>

							<div class="Box">
								<img src="HomePhotos/Cream_Cake.png">
								<h3>Cream Design</h3>
								<a href="Birthday.php?Cream" class="Btn">Shop Now</a>
							</div>
						</div>
				<?php
					}
				?>
				
			</section>

			<div class="Product_Preview">
				<?php 	
					if (isset($_REQUEST['Chocolate'])) 
					{
						$PProducts 	= Multi_Select("*", "Birthday", "Design", "Chocolate Design");
						$PCount 		= mysqli_num_rows($PProducts);
						for ($j=0; $j < $PCount; $j++) 
						{ 
							$PRows 	= mysqli_fetch_array($PProducts);
							$PID 	= $PRows['ID'];
				?>
						<div class="Preview" data-target="<?php echo "P-" . ($j+1) . "" ?>">
							<h3><?php echo $PRows['Design']; ?></h3>
							<i class="fas fa-times"></i>
							
							<img src="<?php echo $PRows['Photo'] ?>">
							
							
                            <form action="Birthday.php?Chocolate" method="post">
								<input type="hidden" name="txtDesign" value="Chocolate" ?>">
								<input type="hidden" name="txtPhoto" value="<?php echo $PRows['Photo']; ?>">

								<div class="Price">
									<select name="cboSize" required="required" class="form-control" id="<?php echo "Size" . $j ; ?>">
										<option value="" disable selected>Size</option>
										<?php
											for ($b=8; $b < 25; $b+= 2) 
											{ 
												echo ("<option value='$b'>$b</option>");	
											}
										?>
									</select>

									<select name="cboType" required="required" class="form-control" id="<?php echo "Type" . $j ; ?>">
										<option value="" disable selected>Type of Cake</option>
										<?php
											$Result = Single_Select("DISTINCT Type", "Type");
											$Count  = mysqli_num_rows($Result);
											for ($a=0; $a < $Count; $a++) 
											{ 
												$Type = mysqli_fetch_array($Result);
												echo ("<option value='" . $Type['Type'] . "'>" . $Type['Type'] . "</option>");	
											}
										?>
									</select>
								</div>

								<div class="Price">Price : <input type="text" value="" class="Price" id="<?php echo "Price" . $j ; ?>" name="txtPrice" readonly> Qty : <input type="number" min="1" max="10" value="1" name="txtQuantity" id="<?php echo "Quantity" . $j ; ?>" onkeydown="return false"></div>								
                                <input type="submit" name="btnCart" class="Btn" value="Add to Cart">
                            </form>
												
						</div>
				<?php
						}
					}
					elseif (isset($_REQUEST['Flower'])) 
					{
						$PProducts 	= Multi_Select("*", "Birthday", "Design", "Flower Design");
						$PCount 		= mysqli_num_rows($PProducts);
						for ($j=0; $j < $PCount; $j++) 
						{ 
							$PRows 	= mysqli_fetch_array($PProducts);
							$PID 	= $PRows['ID'];
				?>
						<div class="Preview" data-target="<?php echo "P-" . ($j+1) . "" ?>">
							<h3><?php echo $PRows['Design']; ?></h3>
							<i class="fas fa-times"></i>
							
							<img src="<?php echo $PRows['Photo'] ?>">
							
							
                            <form action="Birthday.php?Flower" method="post">
								<input type="hidden" name="txtDesign" value="Flower" ?>">
								<input type="hidden" name="txtPhoto" value="<?php echo $PRows['Photo']; ?>">

								<div class="Price">
									<select name="cboSize" required="required" class="form-control" id="<?php echo "Size" . $j ; ?>">
										<option value="" disable selected>Size</option>
										<?php
											for ($b=8; $b < 25; $b+= 2) 
											{ 
												echo ("<option value='$b'>$b</option>");	
											}
										?>
									</select>

									<select name="cboType" required="required" class="form-control" id="<?php echo "Type" . $j ; ?>">
										<option value="" disable selected>Type of Cake</option>
										<?php
											$Result = Single_Select("DISTINCT Type", "Type");
											$Count  = mysqli_num_rows($Result);
											for ($a=0; $a < $Count; $a++) 
											{ 
												$Type = mysqli_fetch_array($Result);
												echo ("<option value='" . $Type['Type'] . "'>" . $Type['Type'] . "</option>");	
											}
										?>
									</select>
								</div>

								<div class="Price">Price : <input type="text" value="" class="Price" id="<?php echo "Price" . $j ; ?>" name="txtPrice" readonly> Qty : <input type="number" min="1" max="10" value="1" name="txtQuantity" id="<?php echo "Quantity" . $j ; ?>" onkeydown="return false"></div>								
                                <input type="submit" name="btnCart" class="Btn" value="Add to Cart">
                            </form>
												
						</div>
				<?php
						}
					}
					elseif (isset($_REQUEST['Fruit'])) 
					{
						$PProducts 	= Multi_Select("*", "Birthday", "Design", "Fruit Design");
						$PCount 		= mysqli_num_rows($PProducts);
						for ($j=0; $j < $PCount; $j++) 
						{ 
							$PRows 	= mysqli_fetch_array($PProducts);
							$PID 	= $PRows['ID'];
				?>
						<div class="Preview" data-target="<?php echo "P-" . ($j+1) . "" ?>">
							<h3><?php echo $PRows['Design']; ?></h3>
							<i class="fas fa-times"></i>
							
							<img src="<?php echo $PRows['Photo'] ?>">
							
							
                            <form action="Birthday.php?Flower" method="post">
								<input type="hidden" name="txtDesign" value="Flower" ?>">
								<input type="hidden" name="txtPhoto" value="<?php echo $PRows['Photo']; ?>">

								<div class="Price">
									<select name="cboSize" required="required" class="form-control" id="<?php echo "Size" . $j ; ?>">
										<option value="" disable selected>Size</option>
										<?php
											for ($b=8; $b < 25; $b+= 2) 
											{ 
												echo ("<option value='$b'>$b</option>");	
											}
										?>
									</select>

									<select name="cboType" required="required" class="form-control" id="<?php echo "Type" . $j ; ?>">
										<option value="" disable selected>Type of Cake</option>
										<?php
											$Result = Single_Select("DISTINCT Type", "Type");
											$Count  = mysqli_num_rows($Result);
											for ($a=0; $a < $Count; $a++) 
											{ 
												$Type = mysqli_fetch_array($Result);
												echo ("<option value='" . $Type['Type'] . "'>" . $Type['Type'] . "</option>");	
											}
										?>
									</select>
								</div>

								<div class="Price">Price : <input type="text" value="" class="Price" id="<?php echo "Price" . $j ; ?>" name="txtPrice" readonly> Qty : <input type="number" min="1" max="10" value="1" name="txtQuantity" id="<?php echo "Quantity" . $j ; ?>" onkeydown="return false"></div>								
                                <input type="submit" name="btnCart" class="Btn" value="Add to Cart">
                            </form>
												
						</div>
				<?php
						}
					}
					elseif (isset($_REQUEST['Cream'])) 
					{
						$PProducts 	= Multi_Select("*", "Birthday", "Design", "Cream Design");
						$PCount 		= mysqli_num_rows($PProducts);
						for ($j=0; $j < $PCount; $j++) 
						{ 
							$PRows 	= mysqli_fetch_array($PProducts);
							$PID 	= $PRows['ID'];
				?>
						<div class="Preview" data-target="<?php echo "P-" . ($j+1) . "" ?>">
							<h3><?php echo $PRows['Design']; ?></h3>
							<i class="fas fa-times"></i>
							
							<img src="<?php echo $PRows['Photo'] ?>">
							
							
                            <form action="Birthday.php?Flower" method="post">
								<input type="hidden" name="txtDesign" value="Flower" ?>">
								<input type="hidden" name="txtPhoto" value="<?php echo $PRows['Photo']; ?>">

								<div class="Price">
									<select name="cboSize" required="required" class="form-control" id="<?php echo "Size" . $j ; ?>">
										<option value="" disable selected>Size</option>
										<?php
											for ($b=8; $b < 25; $b+= 2) 
											{ 
												echo ("<option value='$b'>$b</option>");	
											}
										?>
									</select>

									<select name="cboType" required="required" class="form-control" id="<?php echo "Type" . $j ; ?>">
										<option value="" disable selected>Type of Cake</option>
										<?php
											$Result = Single_Select("DISTINCT Type", "Type");
											$Count  = mysqli_num_rows($Result);
											for ($a=0; $a < $Count; $a++) 
											{ 
												$Type = mysqli_fetch_array($Result);
												echo ("<option value='" . $Type['Type'] . "'>" . $Type['Type'] . "</option>");	
											}
										?>
									</select>
								</div>

								<div class="Price">Price : <input type="text" value="" class="Price" id="<?php echo "Price" . $j ; ?>" name="txtPrice" readonly> Qty : <input type="number" min="1" max="10" value="1" name="txtQuantity" id="<?php echo "Quantity" . $j ; ?>" onkeydown="return false"></div>								
                                <input type="submit" name="btnCart" class="Btn" value="Add to Cart">
                            </form>
												
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
									<div class="Price">Qty : <input type="number" min="1" max="<?php echo $PRows['Stock'] ; ?>" value="1" name="txtQuantity"></div>
								
									<input type="submit" name="btnCart" class="Btn" value="Add to Cart">
								</form>
							<?php
								}
								else
								{
							?>
								<form action="Products.php" method="post">
									<input type="text" name="txtProduct" value="<?php echo $PID ?>" hidden >
									
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

		<?php include "Footer.php" ?>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js"></script>
	</body>
</html>