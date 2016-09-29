<?php
if(is_file(FRONTENDPATH."/footer.php")) {
    include(FRONTENDPATH."/footer.php");
}else{
    show_404();
}