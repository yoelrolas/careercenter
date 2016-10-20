<?php
class Setting extends MY_Controller {
    function __construct() {
        parent::__construct();
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }
    }

    function main() {
        $data['title'] = "Main Setting";
        if(!empty($_POST)) {
            SetSetting(SETTING_WEBMAIL, $this->input->post(SETTING_WEBMAIL));
            SetSetting(SETTING_EMAILSENDER, $this->input->post(SETTING_EMAILSENDER));
            SetSetting(SETTING_EMAILSENDERNAME, $this->input->post(SETTING_EMAILSENDERNAME));
            SetSetting(SETTING_EMAILPROTOCOL, $this->input->post(SETTING_EMAILPROTOCOL));
            SetSetting(SETTING_SMTPHOST, $this->input->post(SETTING_SMTPHOST));
            SetSetting(SETTING_SMTPPORT, $this->input->post(SETTING_SMTPPORT));
            SetSetting(SETTING_SMTPPASSWORD, $this->input->post(SETTING_SMTPPASSWORD));
            SetSetting(SETTING_SMTPEMAIL, $this->input->post(SETTING_SMTPEMAIL));
        }
        $this->load->view('setting/main', $data);
    }

    function notification() {
        $data['title'] = "Notification Setting";
        if(!empty($_POST)) {
            $allnotification = $this->db->get(TBL_NOTIFICATIONS)->result_array();
            foreach($allnotification as $notif) {
                $datanotif = array(
                    COL_NOTIFICATIONSUBJECT => $this->input->post(COL_NOTIFICATIONSUBJECT."-".$notif[COL_NOTIFICATIONID]),
                    COL_NOTIFICATIONCONTENT => $this->input->post(COL_NOTIFICATIONCONTENT."-".$notif[COL_NOTIFICATIONID]),
                    COL_NOTIFICATIONSENDEREMAIL => $this->input->post(COL_NOTIFICATIONSENDEREMAIL."-".$notif[COL_NOTIFICATIONID]),
                    COL_NOTIFICATIONSENDERNAME => $this->input->post(COL_NOTIFICATIONSENDERNAME."-".$notif[COL_NOTIFICATIONID]),
                    COL_ISACTIVE => $this->input->post(COL_ISACTIVE."-".$notif[COL_NOTIFICATIONID]) ? $this->input->post(COL_ISACTIVE."-".$notif[COL_NOTIFICATIONID]) : false
                );

                SetNotification($notif[COL_NOTIFICATIONID], $datanotif);
            }
        }
        $this->load->view('setting/notification', $data);
    }
}