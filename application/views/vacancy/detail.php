<?php
if(is_file(FRONTENDVIEWPATH."/vacancy/detail.php")) {
    include(FRONTENDVIEWPATH."/vacancy/detail.php");
}else{
    show_404();
}