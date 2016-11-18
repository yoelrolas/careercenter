<?php
class Company extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('mcompany');
    }

    function register() {
        $data['title'] = "Register as Employer";
        $datapost = !empty($_POST) ? $this->input->post() : null;
        $data['data'] = $datapost;
        $rules = $this->mcompany->rules();

        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $config['upload_path'] = MY_UPLOADPATH;
            $config['allowed_types'] = UPLOAD_ALLOWEDTYPES;
            $config['max_size']	= 500;
            $config['max_width']  = 1024;
            $config['max_height']  = 768;
            $config['overwrite'] = FALSE;

            $this->load->library('upload',$config);
            if(!empty($_FILES["userfile"]["name"])) {
                if(!$this->upload->do_upload()){
                    $data['upload_errors'] = $this->upload->display_errors();
                    $this->load->view('company/register', $data);
                    return;
                }
            }

            $dataupload = $this->upload->data();
            $companyid = GetLastID(TBL_COMPANIES, COL_COMPANYID) + 1;

            $userdata = array(
                COL_USERNAME => $this->input->post(COL_USERNAME),
                COL_PASSWORD => md5($this->input->post(COL_PASSWORD)),
                COL_ROLEID => ROLECOMPANY,
                COL_ISSUSPEND => true
            );

            $userinfo = array(
                COL_USERNAME => $this->input->post(COL_USERNAME),
                COL_EMAIL => $this->input->post(COL_EMAIL),
                COL_COMPANYID => $companyid
            );

            $companydata = array(
                COL_COMPANYID => $companyid,
                COL_COMPANYNAME => $this->input->post(COL_COMPANYNAME),
                COL_COMPANYADDRESS => $this->input->post(COL_COMPANYADDRESS),
                COL_COMPANYTELP => $this->input->post(COL_COMPANYTELP),
                COL_COMPANYFAX => $this->input->post(COL_COMPANYFAX),
                COL_COMPANYWEBSITE => $this->input->post(COL_COMPANYWEBSITE),
                COL_COMPANYEMAIL => $this->input->post(COL_COMPANYEMAIL),
                COL_INDUSTRYTYPEID => $this->input->post(COL_INDUSTRYTYPEID),
                COL_REGISTERDATE => date('Y-m-d H:i:s'),
                COL_FILENAME => $dataupload['file_name']
            );
            if(!empty($dataupload) && $dataupload['file_name']) {
                $companydata[COL_FILENAME] = $dataupload['file_name'];
            }

            $reg = $this->mcompany->register($userdata, $userinfo, $companydata);

            // Notifications
            if(IsNotificationActive(NOTIFICATION_PERUSAHAANBARU)) {
                $this->load->library('email',GetEmailConfig());
                $this->email->set_newline("\r\n");

                $pref = GetNotification(NOTIFICATION_PERUSAHAANBARU);

                $content = $pref[COL_NOTIFICATIONCONTENT];
                $subject = $pref[COL_NOTIFICATIONSUBJECT];

                $content = str_replace(array("@USERNAME@", "@EMAIL@", "@COMPANYNAME@", "@SITENAME@", "@URL@"),
                    array($userinfo[COL_USERNAME], $userinfo[COL_EMAIL], $companydata[COL_COMPANYNAME], SITENAME, site_url('company/index')),
                    $content);

                /*$this->email->from($pref[COL_NOTIFICATIONSENDEREMAIL], $pref[COL_NOTIFICATIONSENDERNAME]);
                $this->email->to(GetSetting(SETTING_WEBMAIL));
                $this->email->subject($subject);
                $this->email->message($content);
                $this->email->send();*/

                $headers = 'From: '.$pref[COL_NOTIFICATIONSENDERNAME].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                    'Reply-To: '.$pref[COL_NOTIFICATIONSENDEREMAIL].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                    'Return-Path: '.$pref[COL_NOTIFICATIONSENDEREMAIL].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                    //'Cc: '.$rvacancy[COL_COMPANYEMAIL] . PHP_EOL .
                    'MIME-Version: 1.0' . PHP_EOL .
                    'Content-Type: text/html; charset=ISO-8859-1' . PHP_EOL;
                mail(GetSetting(SETTING_WEBMAIL), $subject, str_replace("\n.", "\n..", $content), $headers);
            }

            if($reg) redirect(site_url('company/register')."?success=1");
            else redirect(site_url('company/register')."?error=1");
        }else{
            $this->load->view('company/register', array('data' => $datapost));
        }
    }

    function index() {
        if(!IsLogin()) {
            redirect(site_url('user/login'));
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
            show_error('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }
        $data['title'] = "Companies";

        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_USERINFORMATION.".".COL_COMPANYID,"inner");
        $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"inner");
        $this->db->order_by(TBL_COMPANIES.".".COL_REGISTERDATE, 'desc');
        $data['res'] = $this->db->get(TBL_USERS)->result_array();
        $this->load->view('company/index', $data);
    }

    function add() {
        if(!IsLogin()) {
            redirect(site_url('user/login'));
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
            show_error('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }

        $data['title'] = "Companies";
        $data['edit'] = FALSE;
        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->mcompany->rules();
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()) {
                $config['upload_path'] = MY_UPLOADPATH;
                $config['allowed_types'] = UPLOAD_ALLOWEDTYPES;
                $config['max_size']	= 500;
                $config['max_width']  = 1024;
                $config['max_height']  = 768;
                $config['overwrite'] = FALSE;

                $this->load->library('upload',$config);
                if(!empty($_FILES["userfile"]["name"])) {
                    if(!$this->upload->do_upload()){
                        $data['upload_errors'] = $this->upload->display_errors();
                        $this->load->view('company/form', $data);
                        return;
                    }
                }

                $dataupload = $this->upload->data();
                $companyid = GetLastID(TBL_COMPANIES, COL_COMPANYID) + 1;

                $userdata = array(
                    COL_USERNAME => $this->input->post(COL_USERNAME),
                    COL_PASSWORD => md5($this->input->post(COL_PASSWORD)),
                    COL_ROLEID => ROLECOMPANY,
                    COL_ISSUSPEND => false
                );

                $userinfo = array(
                    COL_USERNAME => $this->input->post(COL_USERNAME),
                    COL_EMAIL => $this->input->post(COL_EMAIL),
                    COL_COMPANYID => $companyid
                );

                $companydata = array(
                    COL_COMPANYID => $companyid,
                    COL_COMPANYNAME => $this->input->post(COL_COMPANYNAME),
                    COL_COMPANYADDRESS => $this->input->post(COL_COMPANYADDRESS),
                    COL_COMPANYTELP => $this->input->post(COL_COMPANYTELP),
                    COL_COMPANYFAX => $this->input->post(COL_COMPANYFAX),
                    COL_COMPANYWEBSITE => $this->input->post(COL_COMPANYWEBSITE),
                    COL_COMPANYEMAIL => $this->input->post(COL_COMPANYEMAIL),
                    COL_INDUSTRYTYPEID => $this->input->post(COL_INDUSTRYTYPEID),
                    COL_REGISTERDATE => date('Y-m-d H:i:s'),
                    COL_APPROVEDDATE => date('Y-m-d H:i:s'),
                    COL_FILENAME => $dataupload['file_name']
                );

                $reg = $this->mcompany->register($userdata, $userinfo, $companydata);
                if($reg) redirect(site_url('company/index'));
                else redirect(current_url().'?error=1');
            }
            else {
                $this->load->view('company/form', $data);
            }
        }
        else {
            $this->load->view('company/form', $data);
        }
    }

    function edit($id) {
        if(!IsLogin()) {
            redirect(site_url('user/login'));
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
            show_error('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }
        $data['title'] = "Companies";
        $data['edit'] = TRUE;
        $data['data'] = $edited = $this->db->where(COL_COMPANYID, $id)->get(TBL_COMPANIES)->row_array();
        if(empty($edited)){
            show_404();
            return;
        }

        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->mcompany->rules(false);
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
                $config['upload_path'] = MY_UPLOADPATH;
                $config['allowed_types'] = UPLOAD_ALLOWEDTYPES;
                $config['max_size']	= 500;
                $config['max_width']  = 1024;
                $config['max_height']  = 768;
                $config['overwrite'] = FALSE;

                $this->load->library('upload',$config);
                if(!empty($_FILES["userfile"]["name"])) {
                    if(!$this->upload->do_upload()){
                        $data['upload_errors'] = $this->upload->display_errors();
                        $this->load->view('company/form', $data);
                        return;
                    }
                }

                $dataupload = $this->upload->data();
                $companydata = array(
                    COL_COMPANYNAME => $this->input->post(COL_COMPANYNAME),
                    COL_COMPANYADDRESS => $this->input->post(COL_COMPANYADDRESS),
                    COL_COMPANYTELP => $this->input->post(COL_COMPANYTELP),
                    COL_COMPANYFAX => $this->input->post(COL_COMPANYFAX),
                    COL_COMPANYWEBSITE => $this->input->post(COL_COMPANYWEBSITE),
                    COL_COMPANYEMAIL => $this->input->post(COL_COMPANYEMAIL),
                    COL_INDUSTRYTYPEID => $this->input->post(COL_INDUSTRYTYPEID)
                );
                if(!empty($dataupload) && $dataupload['file_name']) {
                    $companydata[COL_FILENAME] = $dataupload['file_name'];
                }

                $reg = $this->db->where(COL_COMPANYID, $id)->update(TBL_COMPANIES, $companydata);
                if($reg) redirect(site_url('company/index'));
                else redirect(current_url().'?error=1');
            }
            else {
                $this->load->view('company/form', $data);
            }
        }
        else {
            $this->load->view('company/form', $data);
        }
    }

    function delete(){
        if(!IsLogin()) {
            ShowJsonError('Silahkan login terlebih dahulu');
            return;
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
            ShowJsonError('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }
        $this->load->model('mcompany');
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            if($this->mcompany->delete($datum)) {
                $deleted++;
            }
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada data dihapus");
        }
    }

    function activate($suspend=false) {
        if(!IsLogin()) {
            ShowJsonError('Silahkan login terlebih dahulu');
            return;
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
            ShowJsonError('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            // Get User
            $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"inner");
            $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_COMPANYID." = ".TBL_COMPANIES.".".COL_COMPANYID,"inner");
            $this->db->join(TBL_USERS,TBL_USERS.'.'.COL_USERNAME." = ".TBL_USERINFORMATION.".".COL_USERNAME,"inner");
            $row = $this->db->where(TBL_COMPANIES.".".COL_COMPANYID, $datum)->get(TBL_COMPANIES)->row_array();
            if($row) {
                if($this->db->where(COL_USERNAME, $row[COL_USERNAME])->update(TBL_USERS, array(COL_ISSUSPEND=>$suspend))) {
                    $deleted++;
                }
                if(!$suspend) {
                    $this->db->where(COL_COMPANYID, $datum)->update(TBL_COMPANIES, array(COL_APPROVEDDATE=>date('Y-m-d H:i:s')));
                    $this->db->where(COL_COMPANYID, $datum)->update(TBL_USERINFORMATION, array(COL_REGISTEREDDATE=>date('Y-m-d H:i:s')));

                    // Notifications
                    if(IsNotificationActive(NOTIFICATION_AKTIVASIAKUNPERUSAHAAN)) {
                        $this->load->library('email',GetEmailConfig());
                        $this->email->set_newline("\r\n");

                        $pref = GetNotification(NOTIFICATION_AKTIVASIAKUNPERUSAHAAN);

                        $content = $pref[COL_NOTIFICATIONCONTENT];
                        $subject = $pref[COL_NOTIFICATIONSUBJECT];

                        $content = str_replace(array("@USERNAME@", "@EMAIL@", "@COMPANYNAME@", "@SITENAME@", "@URL@"),
                            array($row[COL_USERNAME], $row[COL_EMAIL], $row[COL_COMPANYNAME], SITENAME, site_url('user/login')),
                            $content);

                        /*$this->email->from($pref[COL_NOTIFICATIONSENDEREMAIL], $pref[COL_NOTIFICATIONSENDERNAME]);
                        $this->email->to($row[COL_EMAIL]);
                        $this->email->subject($subject);
                        $this->email->message($content);
                        $this->email->send();*/

                        $headers = 'From: '.$pref[COL_NOTIFICATIONSENDERNAME].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                            'Reply-To: '.$pref[COL_NOTIFICATIONSENDEREMAIL].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                            'Return-Path: '.$pref[COL_NOTIFICATIONSENDEREMAIL].' <'.$pref[COL_NOTIFICATIONSENDEREMAIL].'>' . PHP_EOL .
                            //'Cc: '.$rvacancy[COL_COMPANYEMAIL] . PHP_EOL .
                            'MIME-Version: 1.0' . PHP_EOL .
                            'Content-Type: text/html; charset=ISO-8859-1' . PHP_EOL;
                        mail($row[COL_EMAIL], $subject, str_replace("\n.", "\n..", $content), $headers);
                    }
                }
            }
        }
        if($deleted){
            ShowJsonSuccess($deleted." data diubah");
        }else{
            ShowJsonError("Tidak ada data yang diubah");
        }
    }

    function detail($id) {
        $this->load->model('mcompany');
        $this->load->model('mvacancy');
        $data['company'] = $rcompany = $this->mcompany->detail($id);
        if(!$rcompany) {
            show_404();
            return;
        }
        $data['title'] = $rcompany[COL_COMPANYNAME];
        $data['vacancies'] = $this->mvacancy->getbycompany($id, false);

        $this->load->view('company/detail', $data);
    }

    function all() {
        $data['keyword'] =  $keyword = $this->input->post('Keyword');
        $data['industry'] =  $industry = $this->input->post(COL_INDUSTRYTYPEID);

        $data['title'] = "Lowongan";
        $data['res'] = $res = $this->mcompany->search(0, $keyword, $industry);
        //echo $this->db->last_query();
        $this->load->view('company/all', $data);
    }
}