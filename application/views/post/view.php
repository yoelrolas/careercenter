<?php
if(is_file(FRONTENDPATH."/view/post/view.php")) {
    include(FRONTENDPATH."/view/post/view.php");
}else{
    show_404();
}