<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text = $format->validation($_POST['text']);

            $text = mysqli_real_escape_string($db->link, $text);

            if ($text == "") {
                echo '<span class="error">Field must not  be empty !</span>';
            } else {
                $query = "UPDATE  footer SET
                 
                  text='$text'

                  WHERE id='1'
                  ";

                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Data updated Successfully.
        </span>";
                } else {
                    echo "<span class='error'>Data Not updated !</span>";
                }
            }
        }
        ?>
        <div class="block copyblock">
            <?php
            $sql = "SELECT * FROM footer WHERE id='1' ";
            $social = $db->select($sql);
            if ($social) {
                while ($result = $social->fetch_assoc()) {

            ?>

                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['text'] ?>" name="text" class="large" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php }
            } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>