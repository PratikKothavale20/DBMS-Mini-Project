<?php
    // include constants file
    include('../config/constants.php');

    // echo "delete food page";

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // process to delete

        // 1. get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. remove image if available
        if($image_name !="")
        {
            // image is available. so delete it.
            $path = "../images/food/".$image_name;

            // remove the image
            $remove = unlink($path);

            // check whether the image is remove or not
            if($remove==false)
            {
                // set session msg
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                // redirect to manage category page 
                header('location:'.SITEURL.'admin/manage-food.php');
                // stop the process
                die();
            }
        }

        // 3. delete food from database
        // sql query
        $sql = "DELETE FROM tbl_food WHERE id=$id";

         // execute the query
         $res = mysqli_query($conn,$sql);

         // check whether data is delete from database or not and set session message respectively
        // 4. redirect to manage food page
         if($res==true)
         {
             // set success food deleted msg and redirect
             $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
             // redirect to manage category page 
             header('location:'.SITEURL.'admin/manage-food.php');
         }
         else
         {
             // set failed msg and redirect
             $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
 
             // redirect to manage category page 
             header('location:'.SITEURL.'admin/manage-food.php');
         }

  
    }
    else{
        // redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>