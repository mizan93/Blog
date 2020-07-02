 <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
 <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="style.css">
 <?php

    $sql = "SELECT * FROM themes WHERE id='1' ";
    $gettheme = $db->select($sql);
if ($gettheme) {
  
    while ($result = $gettheme->fetch_assoc()) {
        if ($result['theme'] == 'defult') { ?>
         <link rel="stylesheet" href="theme/defult.css">
     <?php } elseif ($result['theme'] == 'green') { ?>
         <link rel="stylesheet" href="theme/green.css">
     <?php  } elseif ($result['theme'] == 'red')  { ?>
         <link rel="stylesheet" href="theme/red.css">
    
 <?php }?>
     <?php }
} ?>