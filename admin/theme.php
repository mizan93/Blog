<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Theme</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $theme = mysqli_real_escape_string($db->link,  $_POST['theme']);

                $query = "UPDATE themes SET
                     theme='$theme'
                     WHERE id='1' ";
                $updated = $db->update($query);
                if ($updated) {
                    echo '<span class="success">Theme Updated succesfully.</span>';
                } else {
                    echo '<span class="error">Theme not Updated !</span>';
                }
            }
            ?>
            <?php
            $sql = "SELECT * FROM themes WHERE id='1' ";
            $gettheme = $db->select($sql);
             
            while ($result = $gettheme->fetch_assoc()) {

            ?>
                <form action="" method="post">
        <table class="form">
            <tr>
                <td>
                    <input <?php if ($result['theme'] == "defult") {
                                echo "checked";
                            } ?> type="radio" name="theme" value="defult" />Defult
                </td>
            </tr>
            <tr>
                <td>
                    <input <?php if ($result['theme'] == "green") {
                                echo "checked";
                            } ?> type="radio" name="theme" value="green" />Green
                </td>
            </tr> 
            <tr>
                <td>
                    <input <?php if ($result['theme'] == "red") {
                                echo "checked";
                            } ?> type="radio" name="theme" value="red" />Red
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" Value="change" />
                </td>

            </tr>
        </table>
                </form>
            <?php }   ?>

        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>