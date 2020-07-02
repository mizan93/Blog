<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php 
if (!isset($_GET['edit_catid']) || $_GET['edit_catid']==null) {
   header('location:catlist.php');
  // echo "<script>window.location='catlist.php';</script>";
} else {
    $getid=$_GET['edit_catid'];
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo '<span class="error">Field Must not be empty!</span>';
                } else {
                    $query = "UPDATE category_tbl SET
                     name='$name'
                     WHERE id='$getid' ";
                    $updated = $db->update($query);
                    if ($updated) {
                        echo '<span class="success">Category Updated succesfully!</span><a href=catlist.php>Go to Categorylist</a>';
                    } else {
                        echo '<span class="error">Category not Updated !</span>';
                    }
                }
            }
            ?>
            <?php 
            $query= "SELECT * FROM category_tbl WHERE id='$getid' ORDER BY id DESC";
           $category=$db->select($query);
          if ($category) {
            
           while ($result=$category->fetch_assoc()) {
              
           ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                   
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                        <td>
                            <a href="catlist.php">Go to categoryList</a>
                        </td>
                    </tr>
                </table>
            </form>
           <?php }} ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>