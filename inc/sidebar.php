 <div class="sidebar clear">
     <div class="samesidebar clear">
         <h2>Categories</h2>
         <ul>
             <?php
                $catquery = "SELECT * FROM  category_tbl ";
                $catgory = $db->select($catquery);
                if ($catgory) {
                    while ($catresult = $catgory->fetch_assoc()) {
                ?>

                     <li><a href="posts.php?category=<?php echo $catresult['id']; ?>"><?php echo $catresult['name']; ?></a></li>
                 <?php }
                } else { ?>
                 <li>No category created !!</li>
             <?php } ?>
         </ul>
     </div>

     <div class="samesidebar clear">
         <h2>Latest articles</h2>

         <div class="popular clear">
             <?php
                $query = "SELECT * FROM  post_tbl limit 5 ";
                $post = $db->select($query);
                if ($post) {
                    while ($result = $post->fetch_assoc()) {
                ?>
                     <h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
                     <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>
                     <?php echo $format->Readmore($result['body'], 120); ?>
             <?php }
                } else {
                    header('Location: 404.php');
                } ?>
         </div>


     </div>
 </div>