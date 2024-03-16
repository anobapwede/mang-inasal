<?php include('partials-front/menu.php'); ?>

<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<?php
        if (isset($_SESSION['order'])) 
        {

            echo $_SESSION['order'];
            unset($_SESSION['order']);

        }
?>

<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore foods</h2>

        <?php
        // Create SQL query to display categories from the database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
        // Execute the query
        $res = mysqli_query($conn, $sql);

        if ($res) {
            // Check if any categories are available
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                // Categories available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3">
                            <?php
                            // Check whether the image is available or not
                            if ($image_name == "") {
                                // Display message
                                echo "<div class='error'>Image Not Available</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>category/<?php echo $image_name ?>" class="img-responsive">
                                <?php
                            }
                            ?>

                            <h3 style="text-align: center;">
                                <?php echo $title ?>
                            </h3>
                        </div>
                    </a>

                    <?php
                }
            } else {
                // Categories not available
                echo "<div class='error'>Category Not Added</div>";
            }
        } else {
            // Error executing the query
            echo "Error: " . mysqli_error($conn);
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center" style="color: white;">Food Menu</h2>

        <?php
        // Get foods from the database that are active and featured
        // SQL query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            // Check if any foods are available
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                // Foods available
                while ($row = mysqli_fetch_assoc($res2)) {
                    // Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // Check whether the image is available or not
                            if ($image_name == "") {
                                // Image not available
                                echo "<div class='error'>Image Not Available</div>";
                            } else {
                                // Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>food/<?php echo $image_name ?>" class="img-responsive">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title ?></h4>
                            <p class="food-price"><?php echo $price ?></p>
                            <p class="food-detail"><?php echo $description ?></p>
                            <br>
                            <a href="<?php echo SITEURL?>order.php?food_id=<?php echo$id ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Foods not available
                echo "<div class='error'>Food Not Available</div>";
            }
        } else {
            // Error executing the query
            echo "Error: " . mysqli_error($conn);
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
