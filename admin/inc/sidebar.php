 <div class="grid_2">
     <div class="box sidemenu">
         <div class="block" id="section-menu">
             <ul class="section menu">
                 <li><a class="menuitem">Site Option</a>
                     <ul class="submenu">
                         <?php
                            if (Session::get('userRole') == 0) {

                            ?>
                             <li><a href="copyright.php">Copyright</a></li>

                             <li><a href="titleslogan.php">Title & Slogan</a></li>
                         <?php } ?>
                         <li><a href="social.php">Social Media</a></li>

                     </ul>
                 </li>

                 <li><a class="menuitem"> Pages</a>
                     <ul class="submenu">
                         <li><a href="addpage.php">
                                 Add new page</a> </li>

                         <?php
                            $query = "SELECT * FROM page";
                            $pages = $db->select($query);
                            if ($pages) {

                                while ($result = $pages->fetch_assoc()) {

                            ?>
                                 <li><a href="page.php?page_id=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                         <?php }
                            } ?>
                     </ul>
                 </li>
                 <li><a class="menuitem">Category Option</a>
                     <ul class="submenu">

                         <li><a href="addcat.php">Add Category</a> </li>

                         <li><a href="catlist.php">Category List</a> </li>
                     </ul>
                 </li>
                 <li><a class="menuitem">Slider Option</a>
                     <ul class="submenu">

                         <li><a href="addslider.php">Add Slider</a> </li>

                         <li><a href="sliderlist.php">Slider List</a> </li>
                     </ul>
                 </li>
                 <li><a class="menuitem">Post Option</a>
                     <ul class="submenu">
                         <?php if (Session::get('userRole') == 0 || Session::get('userRole') == 1 || Session::get('userRole') == 2) { ?>
                             <li><a href="addpost.php">Add Post</a> </li>
                             <li><a href="postlist.php">Post List</a> </li>
                         <?php } ?>


                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </div>