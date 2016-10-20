<?php
if(is_file(FRONTENDPATH."/view/post/all.php")) {
    include(FRONTENDPATH."/view/post/all.php");
}else{
    show_404();
}