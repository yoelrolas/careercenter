<?php
if(is_file(FRONTENDVIEWPATH."/company/detail.php")) {
    include(FRONTENDVIEWPATH."/company/detail.php");
}else{
    show_404();
}