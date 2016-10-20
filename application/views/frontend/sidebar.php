<?php
if(is_file(FRONTENDPATH."/sidebar.php")) {
    include(FRONTENDPATH."/sidebar.php");
}else{
    show_404();
}