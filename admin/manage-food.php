<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>

            <br/><br/><br/>
                <!-- button to add food  -->
                 <a href="<?php echo SITEURL;?>admin/add-food.php " class="btn-primary">Add Food</a>

                 <br/><br/><br/>

                 <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }  

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['remove-failed']))
                    {
                        echo $_SESSION['remove-failed'];
                        unset($_SESSION['remove-failed']);
                    }
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>Sr.No.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category ID</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // create sql query to get all food
                        $sql = "SELECT * FROM tbl_food";

                        // execute the query
                        $res = mysqli_query($conn,$sql);

                        // count rows
                        $count = mysqli_num_rows($res);

                        // create serial no. variable and assign as 1
                        $sn = 1;

                        // check we have data in database or not
                        if($count>0)
                        {
                            // we have data in databse
                            // get data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category_id = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>&#8377;<?php echo $price; ?></td>
                                        <td>
                                            <?php 
                                                 // check wehther img name is available or not
                                                 if($image_name!="")
                                                 {
                                                    // display the image
                                                    ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php    echo$image_name;?>" width="90px" height="70px" >
                                                    <?php
                                                 }
                                                 else{
                                                     // display the error message
                                                     echo "<div class='error'>Image Not Available.</div>";
                                                 }
                                            ?>
                                        </td>
                                        <td><?php echo $category_id;?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-secondary">Update Food</a>

                                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            // food not added in database
                            echo "<tr> <td colspan='7' class='error'> Food Not Added Yet.</td></tr>";
                        }
                    ?>

                </table>
        </div>
    </div>
    
<?php include('partials/footer.php');?>