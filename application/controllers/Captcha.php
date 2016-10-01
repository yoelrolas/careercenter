<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Captcha extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('si/securimage');
    }
    function show(){
        $this->securimage->show();
    }
}