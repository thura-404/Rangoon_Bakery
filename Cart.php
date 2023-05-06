<?php
	session_start();
	include("Connect.php");
	include("SQL.php");
	include("Cart_Function.php");

	
	/*$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
	 
	if($is_page_refreshed ) 
	{
		
	} 
	else 
	{
		echo "
			<script type='text/javascript'>
				window.onbeforeunload = confirmExit;
				function confirmExit()
				{
					return 'You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?';
				}
			</script>
		";
	}*/

	if(isset($_SESSION['Cart']))
	{
		if(count($_SESSION['Cart']) < 1)
		{
			echo ("<script>window.alert('The Cart is Empty!')</script>");
			echo ("<script>window.location='Products.php'</script>");
		}
	}
	else
	{
		echo ("<script>window.alert('The Cart is Empty!')</script>");
		echo ("<script>window.location='Products.php'</script>");
	}

	if(isset($_POST['btnRemove']))
	{
		Remove($_POST['txtRemove']);

		if(count($_SESSION['Cart']) < 1)
		{
			echo ("<script>window.location='Products.php'</script>");
		}
	}
	elseif(isset($_POST['btnUpdate']))
	{
		Update($_POST['txtUpdate'], $_POST['txtQuantity']);
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


		<script src="https://kit.fontawesome.com/976970d2ed.js"></script>

		<link  rel="stylesheet"  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="Style2.css">

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>Rangoon Bakery - Cart</title>
    </head>
    <body>
		<?php include "Heading.php" ?>

		<section class="Categories Product">
			<h1 class="Heading">Shopping <span>Cart</span></h1>

			<div class="Box_Container" id="Box_Container">
			<?php
				if(isset($_SESSION['Cart']))
				{
					$Count 		= count($_SESSION['Cart']);

					if(isset($_SESSION['Birthday']))
					{
						$Count 		= $Count + count($_SESSION['Birthday']);

						for ($i=0; $i < $Count; $i++) 
						{ 
							if($i >= count($_SESSION['Cart']))
							{
								$temp = count($_SESSION['Cart']);
			?>
								<div class="Box BChange" id="#Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
									<img src="<?php echo $_SESSION['Birthday'][($i - $temp)]['Photo'] ?>">
									<h3><?php echo $_SESSION['Birthday'][($i - $temp)]['Design'] . " Design" ?></h3>
									<div class="Price" >Price : <span id="<?php echo "BPrice" . ($i - $temp); ?>"><?php echo $_SESSION['Birthday'][($i - $temp)]['Price']; ?></span> MMK</div>
									<form action="Cart.php" method="post">
										<div class="Price">Qty : <input type="number" min="1" class="Quantity" value="<?php echo $_SESSION['Birthday'][($i - $temp)]['Quantity'] ?>" name="txtQuantity" id="<?php echo "BQuantity" . ($i - $temp); ?>" onkeydown="return false"></div>
										<div class="Price" >Total : <span id="<?php echo "BTotal" . ($i - $temp); ?>"><?php echo ($_SESSION['Birthday'][($i - $temp)]['Price'] * $_SESSION['Birthday'][($i - $temp)]['Quantity']); ?></span> MMK</div>
									
										<input type="text" value="<?php echo ($i - $temp); ?>" name="txtRemove" hidden>
										<input type="submit" class="Btn" onclick=" return confirm('Remove Form Cart?')" name="btnRemove" value="Remove">
									</form>
								</div>				
			<?php
							}
							else 
							{
								$Products	= Multi_Select("*", "Product", "ID", $_SESSION['Cart'][$i]['Product']);
								$Rows 	= mysqli_fetch_array($Products);
								$PID	= $Rows['ID'];
			?>
				
							<div class="Box Change" id="#Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $Rows['Photo'] ?>">
								<h3><?php echo $Rows['Name'] ?></h3>
								<div class="Price" >Price : <span id="<?php echo "Price" . $i; ?>"><?php echo $Rows['Price']; ?></span> MMK</div>
								<form action="Cart.php" method="post">
									<div class="Price">Qty : <input type="number" min="1" class="Quantity" value="<?php echo $_SESSION['Cart'][$i]['Quantity'] ?>" name="txtQuantity" id="<?php echo "Quantity" . $i; ?>" onkeydown="return false"></div>
									<div class="Price" >Total : <span id="<?php echo "Total" . $i; ?>"><?php echo ($Rows['Price'] * $_SESSION['Cart'][$i]['Quantity']); ?></span> MMK</div>
								
									<input type="text" value="<?php echo $i; ?>" name="txtRemove" hidden>
									<input type="submit" class="Btn" onclick=" return confirm('Remove Form Cart?')" name="btnRemove" value="Remove">
								</form>
								
							</div>
				
			<?php
							}
						}
					}
					else
					{
						for ($i=0; $i < $Count; $i++) 
						{ 
							$Products	= Multi_Select("*", "Product", "ID", $_SESSION['Cart'][$i]['Product']);
							$Rows 	= mysqli_fetch_array($Products);
							$PID	= $Rows['ID'];
			?>
				
							<div class="Box Change" id="#Box" data-name="<?php echo "P-" .( $i+1) . "" ?>">
								<img src="<?php echo $Rows['Photo'] ?>">
								<h3><?php echo $Rows['Name'] ?></h3>
								<div class="Price" >Price : <span id="<?php echo "Price" . $i; ?>"><?php echo $Rows['Price']; ?></span> MMK</div>
								<form action="Cart.php" method="post">
									<div class="Price">Qty : <input type="number" min="1" class="Quantity" value="<?php echo $_SESSION['Cart'][$i]['Quantity'] ?>" name="txtQuantity" id="<?php echo "Quantity" . $i; ?>" onkeydown="return false"></div>
									<div class="Price" >Total : <span id="<?php echo "Total" . $i; ?>"><?php echo ($Rows['Price'] * $_SESSION['Cart'][$i]['Quantity']); ?></span> MMK</div>
								
									<input type="text" value="<?php echo $i; ?>" name="txtRemove" hidden>
									<input type="submit" class="Btn" onclick=" return confirm('Remove Form Cart?')" name="btnRemove" value="Remove">
								</form>
								
							</div>
				
			<?php
						}
					}
				}
			?>
			</div>
		</section>

		<section class="Categories">
			<div class="Box_Container">
				<?php
					if(isset($_SESSION['Cart']))
					{
				?>
						<div class="Box">
							<h3 class="Heading">Grand Total : <span class="Price" id="Total"><?php echo Total_Price() . " MMK"; ?></span></h3>
							<form action="Checkout.php" method="post"><input type="submit" class="Btn" name="btnCheckout" value="Checkout"></form>
						</div>
				<?php
					}
					else
					{
				?>
						<div class="Box">
							<h3>The Cart is Empty</h3>
							<a href="Products.php" class="Btn">Shop</a>
						</div>
				<?php
					}
				?>
				
			</div>
		</section>

		<?php include "Footer.php" ?>

		<script>
            $(document).ready( function ()
            {
				function Reload_Total()
				{
					var Total = 0;
					var Birthday=0;

					$(".Change").each(function(index) {
					
					var Quantity 		= jQuery('#Quantity'+index).val(); 
					var Price			= parseInt(jQuery('#Price'+index).text());

					var temp 			= Quantity * Price;
					Total 				= temp + Total;

					});

					$('#Total').text(Total+" MMK");		


					$(".BChange").each(function(index) {

					var Quantity 		= jQuery('#BQuantity'+index).val(); 

					var temp=0;

						jQuery.ajax({
							type:'post',
							url:'Test.php',
							data:'BIndex='+index,
							success:function(result){
								temp 			= Quantity * result;
								var Price			= parseInt(jQuery('#Total'+index).text());
								$('#Total').text((Price+temp)+" MMK");		
							}
						});

					});		
				};

				$(".Change").each(function(index) {
					var Total = 0;

					jQuery('#Quantity'+index).change(function(){

						var Quantity 		= jQuery(this).val(); 
						var Price			= parseInt(jQuery('#Price'+index).text());

						var temp 			= Price * Quantity;

						jQuery.ajax({
							type:'post',
							url:'Test.php',
							data:'Index='+index+'&&Quantity='+Quantity,
							success:function(){
								jQuery('#Total'+index).text(temp);
								Reload_Total();
							}
						});
					});
				});


				$(".BChange").each(function(index) {
					var Total = 0;

					jQuery('#BQuantity'+index).change(function(){

						var Quantity 		= jQuery(this).val(); 
						var Price			= parseInt(jQuery('#BPrice'+index).text());


						jQuery.ajax({
							type:'post',
							url:'Test.php',
							data:'BIndex='+index+'&&BQuantity='+Quantity,
							success:function(result){
								jQuery('#BTotal'+index).text(result);
								Reload_Total();
							}
						});
					});
				});
            } );

         
        </script>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js" async></script>
	</body>
</html>