<?php
if(is_file(FRONTENDVIEWPATH."/user/resetpassword.php")) {
    include(FRONTENDVIEWPATH."/user/resetpassword.php");
}else{
    show_404();
}