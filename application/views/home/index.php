<?php
if(is_file(FRONTENDVIEWPATH."/home/index.php")) {
    include(FRONTENDVIEWPATH."/home/index.php");
}else{
    show_404();
}