<?php
if(is_file(FRONTENDPATH."/header.php")) {
    include(FRONTENDPATH."/header.php");
}else{
    show_404();
}