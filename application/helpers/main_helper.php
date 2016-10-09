<?php
function SetLoginSession($login){
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->session->set_userdata('logged_in', $login);
}
function UnsetLoginSession(){
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->session->unset_userdata('logged_in');
}
function IsLogin(){
    $CI =& get_instance();
    $CI->load->library('session');
    if($CI->session->userdata('logged_in')){
        return true;
    }else{
        return false;
    }
}
function GetLoggedUser() {
    $CI =& get_instance();
    $CI->load->library('session');
    return $CI->session->userdata('logged_in');
}
function ShowJsonError($error){
    echo json_encode(array('error'=>$error));
}
function ShowJsonSuccess($success){
    echo json_encode(array('error'=>0,'success'=>$success));
}
function GetCombobox($query,$primary,$view,$selected=null){
    $CI =& get_instance();
    $q = $CI->db->query($query)->result_array();
    foreach($q as $r){
        if(is_array($view)){
            $views = $r[$view[0]]."(".$r[$view[1]].")";
        }else{
            $views = $r[$view];
        }
        if(!empty($selected)) {
            if(is_array($selected)) {
                if(in_array($r[$primary], $selected)) {
                    echo '<option selected="selected" value="'.$r[$primary].'">'.$views.'</option>';
                }
                else {
                    echo '<option value="'.$r[$primary].'">'.$views.'</option>';
                }
            }
            else {
                if($r[$primary] == $selected){
                    echo '<option selected="selected" value="'.$r[$primary].'">'.$views.'</option>';
                }else{
                    echo '<option value="'.$r[$primary].'">'.$views.'</option>';
                }
            }
        }
        else {
            echo '<option value="'.$r[$primary].'">'.$views.'</option>';
        }
    }
}
function GetLastID($tbl, $col) {
    $CI =& get_instance();
    $last = $CI->db->select($col)->order_by($col, 'desc')->get($tbl)->row_array();
    return $last ? $last[$col] : 0;
}