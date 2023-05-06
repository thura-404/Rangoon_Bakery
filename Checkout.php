<?php 
	session_start();
	include("Connect.php");
	include("SQL.php");
	include("Cart_Function.php");

	if(isset($_POST['btnOrder']))
	{
		$ID 		= Max_ID("ID", "Order_Record");
		$Name 		= $_POST['txtName'];
		$Phone		= $_POST['txtPhone'];
		$Email		= $_POST['txtEmail'];
		$Location	= $_POST['txtAddress'] . ", " . $_POST['cboCity'] . ", " . $_POST['cboTownship'];
		$Delivery 	= $_POST['txtDelivery'];
		$Total		= $_POST['txtTotal'];
		$Count 		= 0;

		if(isset($_SESSION['Cart']))
		{
			$Count		= $Count + count($_SESSION['Cart']);
		}

		if(isset($_SESSION['Birthday']))
		{
			$Count		= $Count + count($_SESSION['Birthday']);
		}
		
		if($_POST['rdoPayment'] == "COD")
		{
			$Payment 	= $_POST['rdoPayment'];
		}
		else
		{
			$Payment 	= $_POST['rdoMobile'];
		}

		if(isset($_SESSION['User_ID']))
		{
			$CRows = mysqli_fetch_array(Multi_Select("Name", "Customer", "ID", $_SESSION['User_ID']));
			$Customer = $CRows['Name'];

			if(Insert_Data("Order_Record", "(ID, Customer, Name, Phone, Email, Payment, Location, Delivery, Date, Status)", "('" . $ID . "', '" . $Customer . "', '" . $Name . "', '" . $Phone . "', '" . $Email . "', '" . $Payment . "', '" . $Location . "', '" . $Delivery . "', '" .  date("Y/m/d") . "', 'Pending')"))
			{
				for ($i=0; $i < $Count; $i++) 
				{ 
					$DetailID = Max_ID("ID", "Order_Details");
					if(isset($_SESSION['Cart']))
					{
						if($i >= count($_SESSION['Cart']))
						{
							$temp 	= count($_SESSION['Cart']);
							if(Insert_Data("Order_Details" ,"(ID, Product, Price, Quantity, OrderID)", "('" . $DetailID . "', '" . $_SESSION['Birthday'][($i - $temp)]['Design'] . " Design Cake', '" . $_SESSION['Birthday'][($i - $temp)]['Price'] . "', '" . $_SESSION['Birthday'][($i - $temp)]['Quantity'] . "', '" . $ID . "')"))
							{

							}
							else
							{
								Delete_Data("Order_Record", "ID", $ID);
								Delete_Data("Order_Details", "OrderID", $ID);
								echo "<script>window.alert('Error! Please try Again later')</script>";
								echo "<script>window.location='Home.php'</script>";
								exit();
							}
						}
						else
						{
							$Product = mysqli_fetch_array(Multi_Select("*", "Product", "ID", $_SESSION['Cart'][$i]['Product']));


							if(Insert_Data("Order_Details" ,"(ID, Product, Price, Quantity, OrderID)", "('" . $DetailID . "', '" . $Product['Name'] . "', '" . $Product['Price'] . "', '" . $_SESSION['Cart'][$i]['Quantity'] . "', '" . $ID . "')"))
							{
								Update_Data("Product", "Stock = Stock - " . $_SESSION['Cart'][$i]['Quantity'] . "", "ID", $Product['ID']);
							}
							else
							{
								Delete_Data("Order_Record", "ID", $ID);
								Delete_Data("Order_Details", "OrderID", $ID);
								echo "<script>window.alert('Error! Please try Again later')</script>";
								echo "<script>window.location='Home.php'</script>";
								exit();
							}
						}
					}
					elseif (isset($_SESSION['Birthday'])) 
					{
						if(Insert_Data("Order_Details" ,"(ID, Product, Price, Quantity, OrderID)", "('" . $DetailID . "', '" . $_SESSION['Birthday'][$i]['Design'] . " Design Cake', '" . $_SESSION['Birthday'][$i]['Price'] . "', '" . $_SESSION['Birthday'][$i]['Quantity'] . "', '" . $ID . "')"))
						{

						}
						else
						{
							Delete_Data("Order_Record", "ID", $ID);
							Delete_Data("Order_Details", "OrderID", $ID);
							echo "<script>window.alert('Error! Please try Again later')</script>";
							echo "<script>window.location='Home.php'</script>";
							exit();
						}
					}
				}

				unset($_SESSION['Cart']);
				unset($_SESSION['Birthday']);
				echo "<script>window.alert('Order is Palced! We will be in touch soon.')</script>";
				echo "<script>window.location='Home.php'</script>";
			}
			else
			{
				echo "<script>window.alert('Error! Please try Again later')</script>";
				echo "<script>window.location='Home.php'</script>";
			}
		}
		else
		{
			if(Insert_Data("Order_Record", "(ID, Name, Phone, Email, Payment, Location, Delivery, Date, Status)", "('" . $ID . "', '" . $Name . "', '" . $Phone . "', '" . $Email . "', '" . $Payment . "', '" . $Location . "', '" . $Delivery . "', '" .  date("Y/m/d") . "', 'Pending')"))
			{	
				for ($i=0; $i < $Count; $i++) 
				{ 
					$DetailID = Max_ID("ID", "Order_Details");
					if(isset($_SESSION['Cart']))
					{
						if($i >= count($_SESSION['Cart']))
						{
							$temp 	= count($_SESSION['Cart']);
							if(Insert_Data("Order_Details" ,"(ID, Product, Price, Quantity, OrderID)", "('" . $DetailID . "', '" . $_SESSION['Birthday'][($i - $temp)]['Design'] . " Design Cake', '" . $_SESSION['Birthday'][($i - $temp)]['Price'] . "', '" . $_SESSION['Birthday'][($i - $temp)]['Quantity'] . "', '" . $ID . "')"))
							{

							}
							else
							{
								Delete_Data("Order_Record", "ID", $ID);
								Delete_Data("Order_Details", "OrderID", $ID);
								echo "<script>window.alert('Error! Please try Again later')</script>";
								echo "<script>window.location='Home.php'</script>";
								exit();
							}
						}
						else
						{
							$Product = mysqli_fetch_array(Multi_Select("*", "Product", "ID", $_SESSION['Cart'][$i]['Product']));


							if(Insert_Data("Order_Details" ,"(ID, Product, Price, Quantity, OrderID)", "('" . $DetailID . "', '" . $Product['Name'] . "', '" . $Product['Price'] . "', '" . $_SESSION['Cart'][$i]['Quantity'] . "', '" . $ID . "')"))
							{
								Update_Data("Product", "Stock = Stock - " . $_SESSION['Cart'][$i]['Quantity'] . "", "ID", $Product['ID']);
							}
							else
							{
								Delete_Data("Order_Record", "ID", $ID);
								Delete_Data("Order_Details", "OrderID", $ID);
								echo "<script>window.alert('Error! Please try Again later')</script>";
								echo "<script>window.location='Home.php'</script>";
								exit();
							}
						}
					}
					elseif (isset($_SESSION['Birthday'])) 
					{
						if(Insert_Data("Order_Details" ,"(ID, Product, Price, Quantity, OrderID)", "('" . $DetailID . "', '" . $_SESSION['Birthday'][$i]['Design'] . " Design Cake', '" . $_SESSION['Birthday'][$i]['Price'] . "', '" . $_SESSION['Birthday'][$i]['Quantity'] . "', '" . $ID . "')"))
						{

						}
						else
						{
							Delete_Data("Order_Record", "ID", $ID);
							Delete_Data("Order_Details", "OrderID", $ID);
							echo "<script>window.alert('Error! Please try Again later')</script>";
							echo "<script>window.location='Home.php'</script>";
							exit();
						}
					}
				}

				unset($_SESSION['Cart']);
				unset($_SESSION['Birthday']);
				echo "<script>window.alert('Order is Palced! We will be in touch soon.')</script>";
				echo "<script>window.location='Home.php'</script>";
			}
			else
			{
				echo "<script>window.alert('Error! Please try Again later 2')</script>";
				echo "<script>window.location='Home.php'</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="select2.min.css" />

		<script src="https://kit.fontawesome.com/976970d2ed.js"></script>

		<link  rel="stylesheet"  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.cs">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
		<link rel="stylesheet" href="Style2.css">
		<link rel="stylesheet" href="Checkout.css">

		<title>Rangoon Bakery</title>
	</head>
	<body>

		<?php include "heading.php" ?>
		
		<form action="Checkout.php" method="post">
			<div class="Checkout_Page">
				<div class="Billing_Details">
					<div class="Checkout_Form">
						<h4>Shippign Details</h4>

						<div class="Form_Inline">
							<div class="Form_Group">
								<label for="txtName">Delivery Name</label>
								<input type="text" name="txtName" value="" required>
							</div>

							<div class="Form_Group">
								<label for="txtPhone">Delivery Phone</label>
								<input type="text" name="txtPhone" value="" required>
							</div>
						</div>

						<div class="Form_Group">
							<label for="txtPhone">Contanct Email</label>
							<input type="email" name="txtEmail" value="" required>
						</div>

						<div class="Form_Inline">
							<div class="Form_Group">
								<label for="cboCity">City</label>
								<select name="cboCity" id="City" class="form-control" required>
									<option value="" disable selected hidden>City</option>
								<?php
									$CResult 	= Single_Select("DISTINCT City","Township");
									$CCount		= mysqli_num_rows($CResult);

									for ($i=0; $i < $CCount; $i++) 
									{ 
										$City 	= mysqli_fetch_array($CResult);
										echo "<option value=" . $City[0] . ">" . $City[0] . "</option>";
									}
								?>
								</select>
							</div>

							<div class="Form_Group">
								<label for="cboTownship">Township</label>
								<select name="cboTownship" id="Township" class="form-control" required>
									<option value="" disable selected hidden>Township</option>
								
								</select>
							</div>
						</div>
 
						<div class="Form_Group">
							<label for="txtAddress">Full Address</label>
							<textarea name="txtAddress" id="" cols="30" rows="10" required></textarea>
							<!--<button class="Btn">Choose from map <i class="fas fa-map-marker-alt"></i></button>-->
						</div>
					</div>
				</div>
				<div class="Order_Summary">
					<div class="Checkout_Total">
						<h4>Cart Items</h4>
						<ul>
						<?php
							$Count = 0;
							if(isset($_SESSION['Cart']))
							{
								$Count	= $Count + count($_SESSION['Cart']);
							}
							
							if(isset($_SESSION['Birthday']))
							{
								$Count	= $Count + count($_SESSION['Birthday']);
							}

							for ($i=0; $i < $Count; $i++) 
							{ 
								if(isset($_SESSION['Cart']))
								{
									if($i >= (count($_SESSION['Cart'])))
									{
						?>
										<li><?php echo $_SESSION['Birthday'][($i - count($_SESSION['Cart']))]['Design'] ?> <span><?php echo $_SESSION['Birthday'][($i - count($_SESSION['Cart']))]['Price'] ; ?></span></li>
						<?php
									}
									else
									{
										$Product 	= mysqli_fetch_array(Multi_Select("*", "Product", "ID", $_SESSION['Cart'][$i]['Product']));
						?>
										<li><?php echo $Product['Name']; ?> <span><?php echo ($Product['Price'] * $_SESSION['Cart'][$i]['Quantity']) ; ?></span></li>
						<?php
									}
								}
								elseif (isset($_SESSION['Birthday'])) 
								{
								?>
									<li><?php echo $_SESSION['Birthday'][$i]['Design'] ?> <span><?php echo $_SESSION['Birthday'][$i]['Price'] ; ?></span></li>
								<?php
								}
							}
						?>
							<li><hr></li>
							<li><hr></li>
							<li><hr></li>
							<li><hr></li>
							<li>Cart Amount : <span><?php echo Total_Price() ; ?> MMK</span></li>
							<?php
								if(Total_Price() > 25000)
								{
							?>
									<li>Deliver Charges : <span ><?php  echo $Delivery = 0;  ?> MMK</span><input type="hidden" name="txtDelivery" value="0"></li>
							<?php
								}
								else
								{
							?>
									<li>Deliver Charges : <span ><?php $R = array(1000, 1250, 1500, 1750, 2000); $R1 = rand(0, 3); echo $Delivery = $R[$R1];  ?> MMK</span><input type="hidden" name="txtDelivery" value="<?php echo $Delivery; ?>"></li>
							<?php	
								}
							?>
							<li>Tax : <span>.5%</span></li>
							<li><hr></li>
							<li><hr></li>
							<li><hr></li>
							<li><hr></li>
							<li>Total Amount : <span><?php $Total = Total_Price();  $Total = $Total + (($Total * .5)/100); echo $Total + $Delivery; ?></span><input type="hidden" name="txtTotal" value="<?php echo $Total; ?>"></li>
							<li><a href="Cart.php">Go to Cart</a></li>
						</ul>
					</div>
				</div>
				<div class="Order_Summary">
					<div class="Checkout_Total Payment">
						<h4>Order Summary</h4>
						<ul>
							<li><input type="radio" name="rdoPayment" class="Payment" value="COD" id="COD" required="required"> <label for="COD">Cash on Delivery</label> </li>
							<li><input type="radio" name="rdoPayment" class="Payment" value="Payment" id="Payment"  checked="checked" required="required"> <label for="Payment">Moblie Banking</label> </li>						
						</ul>
						<ul id="Bullshit">
							<li><input type="radio" name="rdoMobile"  value="KBZ" id="KBZ" class="Hide_Radio" checked="checked" required="required"><label for="KBZ"><img src="Payment/KBZ.jpg" alt=""></label></li>
							<li><input type="radio" name="rdoMobile"  value="Wave" id="Wave"  class="Hide_Radio" required="required"><label for="Wave"><img src="Payment/WaveMoney.png" alt="" class="Wave"></label></li>
						</ul>
						<img src="Payment/KBZPay.jpg" id="QR">
						<ul>
							<li><input type="submit" name="btnOrder" value="Order Now!"></li>
						</ul>
					</div>
				</div>
			</div>
		</form>

		<?php include "footer.php" ?>

		<script src="select2.min.js"></script>

		<script >
			$(document).ready( function ()
            {
                $('input[type="radio"]').change(function(){
					if($('#Payment').is(':checked'))
					{
						$('#Bullshit').css('display', 'block');
					}

					if($('#KBZ').is(':checked'))
					{
						$('#QR').fadeIn();
						$("#QR").attr("src","Payment/KBZPay.jpg");
					}

					if($('#Wave').is(':checked'))
					{
						$('#QR').fadeIn();
						$("#QR").attr("src","Payment/Wave.png");
					}

					if($('#COD').is(':checked'))
					{
						$('#Bullshit').css('display', 'none');
						$('#QR').fadeOut();
					}
				});

				jQuery('#City').change(function(){
                    var City = jQuery(this).val(); 
                    jQuery.ajax({
                        type:'post',
                        url:'Test.php',
                        data:'City='+City,
                        success:function(result){
                            jQuery('#Township').html(result);
                            jQuery('.#Township').chosen();
                        }
                    });
                });

				$("#Township").select2( {
					placeholder: "Township",
					allowClear: false
				} );
            });
		</script>
		
		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
		<script src="Script.js"></script>
	</body>
</html>