<?php
if(is_file(FRONTENDVIEWPATH."/user/detail.php")) {
    include(FRONTENDVIEWPATH."/user/detail.php");
}else{
    show_404();
}