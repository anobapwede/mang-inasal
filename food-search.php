<?php include('partials-front/menu.php');
?>

<section class="food-search text-center">
    <div class="container">
        <?php
        //get the search keyword
        $search = mysqli_real_escape_string($conn,$_POST['search']);
        ?>
        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>
    </div>
</section>



<section class="food-menu">
    <div class="container">
        <h2 class="text-center" style="color: white;">Food Menu</h2>
        <?php
        //sql query to get foods based on search keyword
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        //execute the query 
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        //check wether food available or not
        if ($count > 0) {
            //food available
            while ($row = mysqli_fetch_assoc($res)) {
                //get the details
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
            echo "<div class='error'>Food Not Found</div>";
        }
        ?>


        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>