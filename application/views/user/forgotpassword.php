<?php
if(is_file(FRONTENDVIEWPATH."/user/forgotpassword.php")) {
    include(FRONTENDVIEWPATH."/user/forgotpassword.php");
}else{
    show_404();
}