<?php
if(is_file(FRONTENDVIEWPATH."/company/all.php")) {
    include(FRONTENDVIEWPATH."/company/all.php");
}else{
    show_404();
}