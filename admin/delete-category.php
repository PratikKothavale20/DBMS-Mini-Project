<?php
    // include constants file
    include('../config/constants.php');

    // check whether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // get the vaue and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove physical image file is available
        if($image_name !="")
        {
            // image is available. so delete it.
            $path = "../images/category/".$image_name;

            // remove the image
            $remove = unlink($path);

            // if failed to remove image then add an error message and stop process
            if($remove==false)
            {
                // set session msg
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Caategory Image.</div>";
                // redirect to manage category page 
                header('location:'.SITEURL.'admin/manage-category.php');
                // stop the process
                die();
            }
        }

        // delete data from database
        // sql query
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // execute the query
        $res = mysqli_query($conn,$sql);

        // check whether data is delete from database or not
        if($res==true)
        {
            // set success msg and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

            // redirect to manage category page 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // set failed msg and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";

            // redirect to manage category page 
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        

    }
    else
    {
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>