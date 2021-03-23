<?php foreach($side_bar as $tondro => $sb):?>
       <li id="<?php echo $menu."-".$tondro;?>" class="side_bar_item <?php echo ( $side_bar_active == $sb)?"active":'';?>" style="list-style-type:none;padding:1% !important;"> <a href="#" id="article-<?php echo $tondro;?>"  style="text-decoration:none;color:rgb(187, 8, 8);"><?php echo $sb;?></a> </li>
 <?php endforeach;?>
