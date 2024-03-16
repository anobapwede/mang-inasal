<?php include('partials-front/menu.php');
?>

<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for food..">
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center" style="color:white;">Products</h2>

        <?php
        //display food that are active
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";
        // Execute the query
        $res = mysqli_query($conn, $sql2);
        //count row
        $count = mysqli_num_rows($res);
        //check wether the food are available or not
        if ($count > 0) 
        {
            //foods available
            while ($row = mysqli_fetch_assoc($res)) 
            {
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
            //food not available
            echo "<div class='error>Food Not Found</div>";
        }


        ?>


        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); 
?>