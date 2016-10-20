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
function GetSetting($settingname) {
    $CI =& get_instance();
    $setting = $CI->db->where(COL_SETTINGNAME, $settingname)->get(TBL_SETTINGS)->row_array();
    if($setting) return $setting[COL_SETTINGVALUE];
    else return "";
}
function SetSetting($settingname, $settingvalue) {
    $CI =& get_instance();
    $CI->db->where(COL_SETTINGNAME, $settingname);
    $CI->db->update(TBL_SETTINGS, array(COL_SETTINGVALUE=>$settingvalue));

}
function IsNotificationActive($id){
    $CI =& get_instance();
    $CI->load->database();
    $row = $CI->db->where(COL_NOTIFICATIONID,$id)->get(TBL_NOTIFICATIONS)->row();
    if(empty($row)){
        return FALSE;
    }else{
        if($row->IsActive){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
function GetNotification($id){
    $CI =& get_instance();
    $CI->load->database();
    $row = $CI->db->where(COL_NOTIFICATIONID,$id)->get(TBL_NOTIFICATIONS)->row_array();
    if(empty($row)){
        return FALSE;
    }else{
        return $row;
    }
}
function SetNotification($id, $value) {
    $CI =& get_instance();
    $CI->db->where(COL_NOTIFICATIONID, $id);
    $CI->db->update(TBL_NOTIFICATIONS, $value);

}
function GetEmailConfig(){
    $local = array(
        'protocol' => 'smtp',
        'smtp_host' => GetSetting(SETTING_SMTPHOST),
        'smtp_port' => GetSetting(SETTING_SMTPPORT),
        'mailtype' => 'html',
        'smtp_user' => GetSetting(SETTING_SMTPEMAIL),
        'smtp_pass' => GetSetting(SETTING_SMTPPASSWORD)
    );
    $hosted = array(
        'mailtype' => 'html'
    );
    if(GetSetting(SETTING_EMAILPROTOCOL) == "smtp"){
        return $local;
    }else{
        return $hosted;
    }
}
function slugify($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}