<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $query = "SELECT  *  FROM slider 
			ORDER BY id LIMIT 5
			";
        $post = $db->select($query);
        if ($post) {

            while ($result = $post->fetch_assoc()) {


        ?>
                <a href="#"><img src="admin/<?php echo $result['image'] ?>" alt="<?php echo $result['title'] ?>" title="T<?php echo $result['title'] ?>" /></a>
        <?php }
        } ?>

    </div>

</div>