<?php
class Applicant extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('mvacancy');
    }

    function response() {
        $user = GetLoggedUser();
        if(!$user || $user[COL_ROLEID] != ROLECOMPANY) {
            ShowJsonError("Anda memiliki akses terhadap modul ini.");
            return;
        }

        $data = $this->input->post('cekbox');
        $message = $this->input->post('message');
        $accept = $this->input->post('accept');
        $processed = 0;
        $arremail = array();

        foreach ($data as $datum) {
            // check current status
            $rapply = $this->db->where(COL_VACANCYAPPLYID, $datum)->get(TBL_VACANCYAPPLIES)->row_array();
            if(!$rapply || $rapply[COL_STATUSID] != STATUS_DIPROSES) {
                continue;
            }

            // update status
            if($accept) {
                $this->db->where(COL_VACANCYAPPLYID, $datum)->update(TBL_VACANCYAPPLIES, array(COL_STATUSID=>STATUS_DITERIMA));
            } else {
                $this->db->where(COL_VACANCYAPPLYID, $datum)->update(TBL_VACANCYAPPLIES, array(COL_STATUSID=>STATUS_DITOLAK));
            }

            // get email
            $ruser = $this->db->where(COL_USERNAME, $rapply[COL_USERNAME])->get(TBL_USERINFORMATION)->row_array();
            if($ruser && $ruser[COL_EMAIL]) {
                $arremail[] = $ruser[COL_EMAIL];
            }
            $processed++;
        }

        // send email
        if(IsNotificationActive(NOTIFICATION_LAMARANDIRESPONUSER) && count($arremail) > 0) {
            $this->load->library('email',GetEmailConfig());
            $this->email->set_newline("\r\n");

            $pref = GetNotification(NOTIFICATION_LAMARANDIRESPONUSER);

            $content = $pref[COL_NOTIFICATIONCONTENT];
            $subject = $pref[COL_NOTIFICATIONSUBJECT];

            $subject = str_replace(array("@APPLYSTATUS@"), array(($accept?"Diterima":"Ditolak")), $subject);
            $content = str_replace(array("@MESSAGECONTENT@", "@SITENAME@"),
                array($message, SITENAME),
                $content);

            /*$this->email->from($pref[COL_NOTIFICATIONSENDEREMAIL], $pref[COL_NOTIFICATIONSENDERNAME]);
            $this->email->to($arremail);
            $this->email->subject($subject);
            $this->email->message($content);
            $this->email->send();*/

            $headers = 'From: '.$pref[COL_NOTIFICATIONSENDERNAME].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                'Reply-To: '.$pref[COL_NOTIFICATIONSENDEREMAIL].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                'Return-Path: '.$pref[COL_NOTIFICATIONSENDEREMAIL].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                //'Cc: '.$rvacancy[COL_COMPANYEMAIL] . PHP_EOL .
                'MIME-Version: 1.0' . PHP_EOL .
                'Content-Type: text/html; charset=ISO-8859-1' . PHP_EOL;
            mail(implode(',', $arremail), $subject, str_replace("\n.", "\n..", $content), $headers);
        }

        if($processed){
            ShowJsonSuccess($processed." data diproses");
        }else{
            ShowJsonError("Tidak ada data yang diproses");
        }
    }
}