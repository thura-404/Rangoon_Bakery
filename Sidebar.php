<div class="sidebar">
        <div class="logo-details">
                <div class="logo_name">Rangoon</div>
                <i class='bx bx-menu' id="btn" ></i>
        </div>


        <ul class="nav-list">
            
        <?php
        if(isset($Position))
        {
            if($Position['Position'] == "HR")
            {
        ?>
                <li>
                    <a href="Role.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Role</span>
                    </a>
                    <span class="tooltip">Role</span>
                </li>

                <li>
                    <a href="Staff.php">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Staff</span>
                    </a>
                    <span class="tooltip">Staff</span>
                </li>
        <?php
            }
            elseif ($Position['Position'] == "Manager")
            {
        ?>

                <!--<li>
                    <i class='bx bx-search' ></i>
                    <input type="text" placeholder="Search...">
                    <span class="tooltip">Search</span>
                </li>-->

                <li>
                    <a href="Search.php">
                    <i class='bx bx-folder' ></i>
                        <span class="links_name">Search & Report</span>
                    </a>
                    <span class="tooltip">Search & Report</span>
                </li>
                
                <li>
                    <a href="Role.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Role</span>
                    </a>
                    <span class="tooltip">Role</span>
                </li>

                <li>
                    <a href="Type.php">
                    <i class='bx bx-category'></i>
                        <span class="links_name">Type</span>
                    </a>
                    <span class="tooltip">Type</span>
                </li>

                <li>
                    <a href="Staff.php">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Staff</span>
                    </a>
                    <span class="tooltip">Staff</span>
                </li>
                
                <li>
                    <a href="Factory.php">
                    <i class='bx bxs-factory'></i>
                        <span class="links_name">Factory</span>
                    </a>
                    <span class="tooltip">Factory</span>
                </li>


                <li>
                    <a href="Category.php">
                    <i class='bx bx-category-alt'></i>
                        <span class="links_name">Cateogry</span>
                    </a>
                    <span class="tooltip">Cateogry</span>
                </li>

                <li>
                    <a href="Birthday_Entry.php">
                    <i class='bx bx-category-alt'></i>
                        <span class="links_name">Birthday Cakes</span>
                    </a>
                    <span class="tooltip">Birthday Cakes</span>
                </li>


                <li>
                    <a href="Product.php">
                        <i class='bx bx-heart' ></i>
                        <span class="links_name">Product</span>
                    </a>
                    <span class="tooltip">Product</span>
                </li>


                <li>
                    <a href="Product_Entry.php">
                        <i class='bx bx-cart-alt' ></i>
                        <span class="links_name">Stock In</span>
                    </a>
                    <span class="tooltip">Stock In</span>
                </li>

        <?php
            }
            elseif ($Position['Position'] == "Receptionist") 
            {
        ?>
                <li>
                    <a href="Search.php">
                    <i class='bx bx-folder' ></i>
                        <span class="links_name">Search & Report</span>
                    </a>
                    <span class="tooltip">Search & Report</span>
                </li>

                <li>
                    <a href="Product.php">
                        <i class='bx bx-heart' ></i>
                        <span class="links_name">Product</span>
                    </a>
                    <span class="tooltip">Product</span>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-cog' ></i>
                        <span class="links_name">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
                </li>
        <?php
            }
            elseif ($Position['Position'] == "Driver") {
        ?>
                <li>
                    <a href="Delivery.php">
                    <i class='bx bxs-truck'></i>
                        <span class="links_name">Delivery</span>
                    </a>
                    <span class="tooltip">Delivery</span>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-cog' ></i>
                        <span class="links_name">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
                </li>
        <?php
            }
        }
        ?>    
        

        <li class="profile">

        <?php
            if(isset($Position))        
            {
        ?>
            <div class="profile-details">
                <div class="name_job">
                    <div class="name"><?php echo $Position['Name'] ; ?></div>
                    <div class="job"><?php echo $Position['Position'] ; ?></div>
                </div>
            </div>
        <?php
            }
        ?>
            <form action="Staff.php" method="post">
                <button class="submit" name="btnLogout"><i class='bx bx-log-out' id="log_out" ></i></button>
            </form>
            
        </li>

        </ul>
    </div>