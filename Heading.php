<header class="Header">
			<a href="Home.php" class="Logo"><i class="fas fa-birthday-cake"></i> RANGOON</a>

			<nav class="Navbar">
				<a href="Home.php">Home</a>
				<a href="Products.php">Product</a>
				<a href="Products.php?Bread">Bread</a>
				<a href="Products.php?Cake">Cake</a>
				<a href="Birthday.php">Birthday</a>
				<?php
					if(isset($_SESSION['User_ID']))
					{
				?>
					<a href="Favorite.php">Favorite</a>
				<?php
					}
				?>
			</nav>

			<div class="Icons">
				<div class="fas fa-bars" id="Menu_Btn"></div>
				<div class="fas fa-search" id="Search_Btn"></div>
				<div class="fas fa-shopping-cart" id="Cart_Btn"></div>
				<div class="fas fa-user" id="Login_Btn"></div>
			</div>

			<form action="Products.php" class="Search_Form" method="post">
				<input type="search" id="Search_Box" placeholder="Search Here ......." name="txtSearch" required>
				<button class="submit fas fa-search" name="btnSearch" ></button>
			</form>

			<div class="Shopping_Cart">
				<?php
					if(isset($_SESSION['Cart']))
					{
						$size = count($_SESSION['Cart']);

						for ($i=0; $i < $size; $i++) 
						{ 
							$Cart  = Multi_Select("*", "Product", "ID", $_SESSION['Cart'][$i]['Product']);
							$CRows = mysqli_fetch_array($Cart);
				?>
							<div class="Box">
								<form action="products.php" method="post">
									<input type="text" name="txtDelete" value="<?php echo $i; ?>" hidden>
									<button class="submit" name="btnDelete" onclick="return confirm('Remove Form Cart?')"><i class="fas fa-trash"></i></button>
								</form>
								<img src="<?php echo $CRows['Photo']; ?>">
								<div class="Content">
									<h3><?php echo $CRows['Name']; ?></h3>
									<span class="Price">$<?php echo $CRows['Price'] ?>-</span>
									<span class="Quantity">Qty : <?php echo $_SESSION['Cart'][$i]['Quantity'] ?></span>
								</div>
							</div>
				<?php			
						}

						if(isset($_SESSION['Birthday']))
						{
					
							$size = count($_SESSION['Birthday']);

							for ($i=0; $i < $size; $i++) 
							{ 
				?>
								<div class="Box">
									<form action="Birthday.php?<?php echo $_SESSION['Birthday'][$i]['Design'] ?>" method="post">
										<input type="text" name="txtDelete" value="<?php echo $_SESSION['Birthday'][$i]['Photo']; ?>" hidden>
										<button class="submit" name="btnDelete" onclick="return confirm('Remove Form Cart?')"><i class="fas fa-trash"></i></button>
									</form>
									<img src="<?php echo $_SESSION['Birthday'][$i]['Photo']; ?>">
									<div class="Content">
										<h3><?php echo $_SESSION['Birthday'][$i]['Design']; ?></h3>
										<span class="Price">$<?php echo $_SESSION['Birthday'][$i]['Price'] ?>-</span>
										<span class="Quantity">Qty : <?php echo $_SESSION['Birthday'][$i]['Quantity'] ?></span>
									</div>
								</div>
				<?php			
							}
						}

						if (count($_SESSION['Cart']) == 0) 
						{
							if(isset($_SESSION['Birthday']))
							{
								if (count($_SESSION['Birthday']) == 0) 
								{
				?>
									<form action="Home.php" method="post">
										<div class="Total"> The cart is empty! </div>
									</form>
				<?php
								}
								else
								{
				?>
									<form action="Home.php" method="post">
										<div class="Total"> Total : <?php echo Total_Price(); ?>/- </div>
										<div class="Buttons">
											<input type="submit" name="btnView" value="View Cart" class="Btn">
											<input type="submit" name="btnCheckout" value="Checkout" class="Btn">
										</div>
									</form>
				<?php
								}
							}
							else
							{
				?>
									<form action="Home.php" method="post">
										<div class="Total"> The cart is empty! </div>
									</form>
				<?php
							}
						}
						else 
						{
				?>
							<form action="Home.php" method="post">
								<div class="Total"> Total : <?php echo Total_Price(); ?>/- </div>
								<div class="Buttons">
									<input type="submit" name="btnView" value="View Cart" class="Btn">
									<input type="submit" name="btnCheckout" value="Checkout" class="Btn">
								</div>
							</form>
				<?php
						}
					}
					elseif (isset($_SESSION['Birthday'])) 
					{
						$size = count($_SESSION['Birthday']);

						for ($i=0; $i < $size; $i++) 
						{ 
				?>
							<div class="Box">
								<form action="Birthday.php?<?php echo $_SESSION['Birthday'][$i]['Design'] ?>" method="post">
									<input type="text" name="txtDelete" value="<?php echo $_SESSION['Birthday'][$i]['Photo']; ?>" hidden>
									<button class="submit" name="btnDelete" onclick="return confirm('Remove Form Cart?')"><i class="fas fa-trash"></i></button>
								</form>
								<img src="<?php echo $_SESSION['Birthday'][$i]['Photo']; ?>">
								<div class="Content">
									<h3><?php echo $_SESSION['Birthday'][$i]['Design']; ?></h3>
									<span class="Price">$<?php echo $_SESSION['Birthday'][$i]['Price'] ?>-</span>
									<span class="Quantity">Qty : <?php echo $_SESSION['Birthday'][$i]['Quantity'] ?></span>
								</div>
							</div>
				<?php			
						}

						if ($size == 0) 
						{
							if(isset($_SESSION['Cart']))
							{
								if(count($_SESSION['Cart']) == 0)
								{
				?>
									<form action="Home.php" method="post">
										<div class="Total"> The cart is empty! </div>
									</form>
				<?php
								}
								else
								{
				?>
									<form action="Home.php" method="post">
										<div class="Total"> Total : <?php echo Total_Price(); ?>/- </div>
										<div class="Buttons">
											<input type="submit" name="btnView" value="View Cart" class="Btn">
											<input type="submit" name="btnCheckout" value="Checkout" class="Btn">
										</div>
									</form>
				<?php
								}
							}
							else
							{
				?>
								<form action="Home.php" method="post">
									<div class="Total"> Total : <?php echo Total_Price(); ?>/- </div>
									<div class="Buttons">
										<input type="submit" name="btnView" value="View Cart" class="Btn">
										<input type="submit" name="btnCheckout" value="Checkout" class="Btn">
									</div>
								</form>
				<?php
							}
						}
						else
						{
				?>
							<form action="Home.php" method="post">
								<div class="Total"> Total : <?php echo Total_Price(); ?>/- </div>
								<div class="Buttons">
									<input type="submit" name="btnView" value="View Cart" class="Btn">
									<input type="submit" name="btnCheckout" value="Checkout" class="Btn">
								</div>
							</form>
				<?php
						}
					}
					else
					{
				?>
							<form action="Home.php" method="post">
								<div class="Total"> The cart is empty! </div>
							</form>
				<?php
					}
					
				?>
			</div>

			<form action="Home.php" class="Login_Form" method='post'>
                <?php
                    if (isset($_SESSION['User_ID'])) 
                    {
                ?>
                        <h3><?php echo $_SESSION['User_Name'] ?></h3>
                        <p><?php echo $_SESSION['User_Email'] ?></p>


                        <input type="submit" value="Logout" name="btnLogout" class="Btn">
                <?php
                    }
                    else
                    {
                ?>
                        <h3>Already a user?</h3>

                        <input type="submit" value="Login" name="btnLogin" class="Btn">
                <?php
                    }
                ?>
				
			</form>
		</header>