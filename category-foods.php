<?php include('partials-front/menu.php');?>

<?php   
    // check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        // category id is set
        $category_id = $_GET['category_id'];
        // get category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        // execute the query
        $res = mysqli_query($conn,$sql);

        // get the value from DB
        $row = mysqli_fetch_assoc($res);
        // get the title
        $category_title = $row['title'];
    }
    else
    {
        // category not passed
        // redirect to home page
        header('locaton:'.SITEURL); 
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // create sql query to get foods based selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                // execute the query
                $res2 = mysqli_query($conn,$sql2);

                // count the rows
                $count = mysqli_num_rows($res2);

                // check food is available or not
                if($count>0)
                {
                    // food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $image_name = $row2['image_name'];

                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php
                                        // check whether image is available or not
                                        if($image_name=="")
                                        {
                                            // image not available
                                            echo "<div class='error'>Image Not Available.</div>";

                                        } 
                                        else
                                        {
                                            // image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ;?>" alt="Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    ?>

                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">&#8377;<?php echo $price;?></p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    // food not available
                    echo "<div class='error'>Foood not Available.</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>