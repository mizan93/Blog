 <?php
    if (isset($_GET['page_id'])) {
        $page_title = $_GET['page_id'];

        $query = "SELECT * FROM page WHERE id='$page_title'";
        $pages = $db->select($query);
        if ($pages) {

            while ($result = $pages->fetch_assoc()) { ?>
             <title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>

         <?php }
        }
    } elseif (isset($_GET['id'])) {
        $postid = $_GET['id'];

        $query = "SELECT * FROM post_tbl WHERE id='$postid'";
        $post = $db->select($query);
        if ($post) {

            while ($result = $post->fetch_assoc()) { ?>
             <title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>

         <?php }
        }
    } elseif (isset($_GET['category'])) {
        $catid = $_GET['category'];

        $query = "SELECT * FROM category_tbl WHERE id='$catid'";
        $category = $db->select($query);
        if ($category) {

            while ($result = $category->fetch_assoc()) { ?>
             <title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>

     <?php }
        }
    } else { ?>
     <title><?php echo $format->title(); ?>-<?php echo TITLE; ?></title>

 <?php } ?>
 <meta name="language" content="English">
 <meta name="description" content="It is a website about education">
 <?php
    if (isset($_GET['id'])) {
        $keyword = $_GET['id'];

        $query = "SELECT * FROM post_tbl WHERE id='$keyword'";
        $keywords = $db->select($query);
        if ($keywords) {

            while ($result = $keywords->fetch_assoc()) { ?>
             <meta name="keywords" content="<?php echo $result['tags']; ?>">

     <?php }
        }
    } else { ?>
     <meta name="keywords" content="<?php echo KEYWORDS; ?>">

 <?php } ?>


 <meta name="author" content="Delowar">