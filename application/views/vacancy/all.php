<?php
if(is_file(FRONTENDVIEWPATH."/vacancy/all.php")) {
    include(FRONTENDVIEWPATH."/vacancy/all.php");
}else{
    show_404();
}