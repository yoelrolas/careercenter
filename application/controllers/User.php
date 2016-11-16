<?php
class User extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->helper('captcha');
        $this->load->library('user_agent');
        $this->load->model('muser');
    }

    function index() {
        if(!IsLogin()) {
            redirect('user/login');
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
            show_error('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }

        $data['title'] = "User";
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->join(TBL_ROLES,TBL_ROLES.'.'.COL_ROLEID." = ".TBL_USERS.".".COL_ROLEID,"inner");
        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_USERINFORMATION.".".COL_COMPANYID,"left");
        $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"left");
        $this->db->order_by(TBL_USERS.".".COL_USERNAME, 'asc');
        $data['res'] = $this->db->get(TBL_USERS)->result_array();
        $this->load->view('user/index', $data);
    }

    function Login(){
        if(IsLogin()) {
            redirect('user/dashboard');
        }
        $rules = array(
            array(
                'field' => 'UserName',
                'label' => 'UserName',
                'rules' => 'required'
            ),
            array(
                'field' => 'Password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $this->load->library('si/securimage');
            $username = $this->input->post(COL_USERNAME);
            $password = $this->input->post(COL_PASSWORD);

            if($this->securimage->check($this->input->post('Captcha')) != true){
                redirect(site_url('user/login')."?msg=captcha");
            }

            if($this->muser->authenticate($username, $password)) {
                if($this->muser->IsSuspend($username)) {
                    redirect(site_url('user/login')."?msg=suspend");
                }

                // Update Last Login IP
                $this->db->where(COL_USERNAME, $username);
                $this->db->update(TBL_USERS, array(COL_LASTLOGIN=>date('Y-m-d H:i:s'), COL_LASTLOGINIP=>$this->input->ip_address()));

                $userdetails = $this->muser->getdetails($username);
                SetLoginSession($userdetails);
                redirect('user/dashboard');
            }
            else {
                redirect(site_url('user/login')."?msg=notmatch");
            }
        } else {
            $this->load->view('user/login');
        }

    }
    function Logout(){
        UnsetLoginSession();
        redirect(site_url());
    }
    function Dashboard() {
        if(!IsLogin()) {
            redirect('user/login');
        }
        $this->load->model('mvacancy');
        $this->load->model('mpost');
        $this->load->view('user/dashboard');
    }
    function Profile() {
        if(!IsLogin()) {
            redirect('user/login');
        }
        $user = GetLoggedUser();
        $data['data'] = $rdata = $this->muser->getdetails($user[COL_USERNAME]);
        $data['title'] = 'Profile';
        if(!$rdata) {
            echo $this->db->last_query();
            return;
        }
        if(!empty($_POST)) {
            //$data['data'] = $_POST;
            $this->load->model('mcompany');
            $rules = $this->muser->rules(false, $user[COL_ROLEID]);
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
                        $this->load->view('user/profile', $data);
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
                    COL_INDUSTRYTYPEID => $this->input->post(COL_INDUSTRYTYPEID),
                    COL_COMPANYDESCRIPTION => $this->input->post(COL_COMPANYDESCRIPTION)
                );
                if(!empty($dataupload) && $dataupload['file_name']) {
                    $companydata[COL_FILENAME] = $dataupload['file_name'];
                }

                $userdata = array(
                    COL_NAME => $this->input->post(COL_NAME),
                    COL_IDENTITYNO => $this->input->post(COL_IDENTITYNO),
                    COL_BIRTHDATE => $this->input->post(COL_BIRTHDATE)?date('Y-m-d', strtotime($this->input->post(COL_BIRTHDATE))):null,
                    COL_RELIGIONID => $this->input->post(COL_RELIGIONID),
                    COL_GENDER => $this->input->post(COL_GENDER),
                    COL_ADDRESS => $this->input->post(COL_ADDRESS),
                    COL_PHONENUMBER => $this->input->post(COL_PHONENUMBER),
                    COL_EDUCATIONID => $this->input->post(COL_EDUCATIONID),
                    COL_UNIVERSITYNAME => $this->input->post(COL_UNIVERSITYNAME),
                    COL_FACULTYNAME => $this->input->post(COL_FACULTYNAME),
                    COL_MAJORNAME => $this->input->post(COL_MAJORNAME),
                    COL_ISGRADUATED => $this->input->post(COL_ISGRADUATED) ? $this->input->post(COL_ISGRADUATED) : false,
                    COL_GRADUATEDDATE => ($this->input->post(COL_ISGRADUATED) && $this->input->post(COL_GRADUATEDDATE) ? date('Y-m-d', strtotime($this->input->post(COL_GRADUATEDDATE))) : null),
                    COL_YEAROFEXPERIENCE => $this->input->post(COL_YEAROFEXPERIENCE),
                    COL_RECENTPOSITION => $this->input->post(COL_RECENTPOSITION),
                    COL_RECENTSALARY => $this->input->post(COL_RECENTSALARY),
                    COL_EXPECTEDSALARY => $this->input->post(COL_EXPECTEDSALARY)
                );
                if(!empty($dataupload) && $dataupload['file_name']) {
                    $userdata[COL_IMAGEFILENAME] = $dataupload['file_name'];
                }

                // Upload CV
                if(!empty($_FILES["cvfile"]["name"])) {
                    if(!$this->upload->do_upload("cvfile")){
                        $data['upload_errors'] = $this->upload->display_errors();
                        $this->load->view('user/profile', $data);
                        return;
                    }
                    $dataupload = $this->upload->data();
                    if(!empty($dataupload) && $dataupload['file_name']) {
                        $userdata[COL_CVFILENAME] = $dataupload['file_name'];
                    }
                }

                if($user[COL_ROLEID] == ROLECOMPANY) {
                    $reg = $this->db->where(COL_COMPANYID, $rdata[COL_COMPANYID])->update(TBL_COMPANIES, $companydata);
                } else {
                    $reg = $this->db->where(COL_USERNAME, $rdata[COL_USERNAME])->update(TBL_USERINFORMATION, $userdata);
                }

                $userdetails = $this->muser->getdetails($user[COL_USERNAME]);
                SetLoginSession($userdetails);

                if($reg) redirect(site_url('user/profile')."?success=1");
                else redirect(site_url('user/profile')."?error=1");
            }
            else {
                $this->load->view('user/profile', $data);
            }
        }
        else {
            $this->load->view('user/profile', $data);
        }
    }
    function ChangePassword() {
        if(!IsLogin()) {
            redirect('user/login');
        }
        $user = GetLoggedUser();
        $data['title'] = 'Change Password';
        $rules = array(
            array(
                'field' => 'OldPassword',
                'label' => 'Old Password',
                'rules' => 'required'
            ),
            array(
                'field' => COL_PASSWORD,
                'label' => COL_PASSWORD,
                'rules' => 'required'
            ),
            array(
                'field' => 'RepeatPassword',
                'label' => 'Repeat Password',
                'rules' => 'required|matches[Password]'
            )
        );
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()){
            $rcheck = $this->db->where(COL_USERNAME, $user[COL_USERNAME])->get(TBL_USERS)->row_array();
            if(!$rcheck) {
                redirect(site_url('user/changepassword'));
            }
            if($rcheck[COL_PASSWORD] != md5($this->input->post("OldPassword"))) {
                redirect(site_url('user/changepassword')."?nomatch=1");
            }
            $upd = $this->db->where(COL_USERNAME, $user[COL_USERNAME])->update(TBL_USERS, array(COL_PASSWORD=>md5($this->input->post(COL_PASSWORD))));
            if($upd) redirect(site_url('user/changepassword')."?success=1");
            else redirect(site_url('user/changepassword')."?error=1");
        }
        else {
            $this->load->view('user/changepassword', $data);
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
        $this->load->model('muser');
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            if($this->muser->delete($datum)) {
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
            if($this->db->where(COL_USERNAME, $datum)->update(TBL_USERS, array(COL_ISSUSPEND=>$suspend))) {
                $deleted++;
            }
            if(!$suspend) {
                $this->db->where(COL_USERNAME, $datum)->update(TBL_USERINFORMATION, array(COL_REGISTEREDDATE=>date('Y-m-d H:i:s')));
            }
        }
        if($deleted){
            ShowJsonSuccess($deleted." data diubah");
        }else{
            ShowJsonError("Tidak ada data yang diubah");
        }
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

        $data['title'] = "Users";
        $data['edit'] = FALSE;
        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->muser->rules(true, $this->input->post(COL_ROLEID));
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()) {
                $config['upload_path'] = MY_UPLOADPATH;
                $config['allowed_types'] = UPLOAD_ALLOWEDTYPES;
                $config['max_size']	= 500;
                $config['max_width']  = 1024;
                $config['max_height']  = 768;
                $config['overwrite'] = FALSE;

                $this->load->library('upload',$config);
                if(!empty($_FILES["companyfile"]["name"])) {
                    if(!$this->upload->do_upload("companyfile")){
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
                    COL_ROLEID => $this->input->post(COL_ROLEID),
                    COL_ISSUSPEND => false
                );

                $userinfo = array(
                    COL_USERNAME => $this->input->post(COL_USERNAME),
                    COL_EMAIL => $this->input->post(COL_EMAIL),
                    COL_COMPANYID => ($userdata[COL_ROLEID] == ROLECOMPANY ? $companyid : null),
                    COL_NAME => $this->input->post(COL_NAME),
                    COL_IDENTITYNO => $this->input->post(COL_IDENTITYNO),
                    COL_BIRTHDATE => $this->input->post(COL_BIRTHDATE)?date('Y-m-d', strtotime($this->input->post(COL_BIRTHDATE))):null,
                    COL_RELIGIONID => $this->input->post(COL_RELIGIONID),
                    COL_GENDER => $this->input->post(COL_GENDER),
                    COL_ADDRESS => $this->input->post(COL_ADDRESS),
                    COL_PHONENUMBER => $this->input->post(COL_PHONENUMBER),
                    COL_EDUCATIONID => $this->input->post(COL_EDUCATIONID),
                    COL_UNIVERSITYNAME => $this->input->post(COL_UNIVERSITYNAME),
                    COL_FACULTYNAME => $this->input->post(COL_FACULTYNAME),
                    COL_MAJORNAME => $this->input->post(COL_MAJORNAME),
                    COL_ISGRADUATED => $this->input->post(COL_ISGRADUATED) ? $this->input->post(COL_ISGRADUATED) : false,
                    COL_GRADUATEDDATE => ($this->input->post(COL_ISGRADUATED) && $this->input->post(COL_GRADUATEDDATE) ? date('Y-m-d', strtotime($this->input->post(COL_GRADUATEDDATE))) : null),
                    COL_YEAROFEXPERIENCE => $this->input->post(COL_YEAROFEXPERIENCE),
                    COL_RECENTPOSITION => $this->input->post(COL_RECENTPOSITION),
                    COL_RECENTSALARY => $this->input->post(COL_RECENTSALARY),
                    COL_EXPECTEDSALARY => $this->input->post(COL_EXPECTEDSALARY),
                    COL_REGISTEREDDATE => date('Y-m-d')
                );

                $companydata = array();
                if($userdata[COL_ROLEID] == ROLECOMPANY) {
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
                }

                $reg = $this->muser->register($userdata, $userinfo, $companydata);
                if($reg) redirect(site_url('user/index'));
                else redirect(current_url().'?error=1');
            }
            else {
                $this->load->view('user/form', $data);
            }
        }
        else {
            $this->load->view('user/form', $data);
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
        $data['title'] = "Users";
        $data['edit'] = TRUE;

        $data['data'] = $edited = $this->muser->getdetails($id);
        if(empty($edited)){
            show_404();
            return;
        }

        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->muser->rules(false, $edited[COL_ROLEID]);
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
                $config['upload_path'] = MY_UPLOADPATH;
                $config['allowed_types'] = UPLOAD_ALLOWEDTYPES;
                $config['max_size']	= 500;
                $config['max_width']  = 1024;
                $config['max_height']  = 768;
                $config['overwrite'] = FALSE;

                $this->load->library('upload',$config);
                if(!empty($_FILES["companyfile"]["name"])) {
                    if(!$this->upload->do_upload("companyfile")){
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

                $userdata = array(
                    COL_NAME => $this->input->post(COL_NAME),
                    COL_IDENTITYNO => $this->input->post(COL_IDENTITYNO),
                    COL_BIRTHDATE => $this->input->post(COL_BIRTHDATE)?date('Y-m-d', strtotime($this->input->post(COL_BIRTHDATE))):null,
                    COL_RELIGIONID => $this->input->post(COL_RELIGIONID),
                    COL_GENDER => $this->input->post(COL_GENDER),
                    COL_ADDRESS => $this->input->post(COL_ADDRESS),
                    COL_PHONENUMBER => $this->input->post(COL_PHONENUMBER),
                    COL_EDUCATIONID => $this->input->post(COL_EDUCATIONID),
                    COL_UNIVERSITYNAME => $this->input->post(COL_UNIVERSITYNAME),
                    COL_FACULTYNAME => $this->input->post(COL_FACULTYNAME),
                    COL_MAJORNAME => $this->input->post(COL_MAJORNAME),
                    COL_ISGRADUATED => $this->input->post(COL_ISGRADUATED) ? $this->input->post(COL_ISGRADUATED) : false,
                    COL_GRADUATEDDATE => ($this->input->post(COL_ISGRADUATED) && $this->input->post(COL_GRADUATEDDATE) ? date('Y-m-d', strtotime($this->input->post(COL_GRADUATEDDATE))) : null),
                    COL_YEAROFEXPERIENCE => $this->input->post(COL_YEAROFEXPERIENCE),
                    COL_RECENTPOSITION => $this->input->post(COL_RECENTPOSITION),
                    COL_RECENTSALARY => $this->input->post(COL_RECENTSALARY),
                    COL_EXPECTEDSALARY => $this->input->post(COL_EXPECTEDSALARY)
                );

                if($edited[COL_ROLEID] == ROLECOMPANY) {
                    $reg = $this->db->where(COL_COMPANYID, $edited[COL_COMPANYID])->update(TBL_COMPANIES, $companydata);
                }
                else {
                    $reg = $this->db->where(COL_USERNAME, $edited[COL_USERNAME])->update(TBL_USERINFORMATION, $userdata);
                }

                if($reg) redirect(site_url('user/index'));
                else redirect(current_url().'?error=1');
            }
            else {
                $this->load->view('user/form', $data);
            }
        }
        else {
            $this->load->view('user/form', $data);
        }
    }

    function detail($uname) {
        $username = GetDecryption($uname);

        $data['data'] = $rdata = $this->muser->getdetails($username);
        if(!$rdata) {
            show_404();
            return false;
        }
        $data['title'] = $rdata[COL_NAME];
        $this->load->view('user/detail', $data);
    }

    function encrypt() {
        echo GetEncryption("yoelrolas");
    }

    function Preference() {
        if(!IsLogin()) {
            redirect('user/login');
        }
        $loginuser = GetLoggedUser();
        if(!$loginuser || $loginuser[COL_ROLEID] != ROLEUSER) {
            show_error('Anda tidak memiliki akses terhadap modul ini.');
            return;
        }

        $data["title"] = "Preference";
        if(!empty($_POST)) {
            $this->db->trans_begin();
            // Delete preference of this user
            if(!$this->db->where(COL_USERNAME, $loginuser[COL_USERNAME])->delete(TBL_USERPREFERENCES)) {
                $this->db->trans_rollback();
                echo "gagal delete";
                return;
                redirect(current_url());
            }

            $pref_industry = $this->input->post(COL_PREFERENCEVALUE."-".PREFERENCETYPE_INDUSTRYTYPE);
            if($pref_industry && count($pref_industry) > 0) {
                $arrinsert = array();
                for($i=0; $i<count($pref_industry); $i++) {
                    $p = $pref_industry[$i];
                    $arrinsert[] = array(
                        COL_USERNAME => $loginuser[COL_USERNAME],
                        COL_PREFERENCETYPEID => PREFERENCETYPE_INDUSTRYTYPE,
                        COL_PREFERENCEVALUE => $p
                    );
                }
                if(!$this->db->insert_batch(TBL_USERPREFERENCES, $arrinsert)) {
                    $this->db->trans_rollback();
                    redirect(current_url());
                }
            }

            $pref_education = $this->input->post(COL_PREFERENCEVALUE."-".PREFERENCETYPE_EDUCATIONTYPE);
            if($pref_education && count($pref_education) > 0) {
                $arrinsert = array();
                for($i=0; $i<count($pref_education); $i++) {
                    $p = $pref_education[$i];
                    $arrinsert[] = array(
                        COL_USERNAME => $loginuser[COL_USERNAME],
                        COL_PREFERENCETYPEID => PREFERENCETYPE_EDUCATIONTYPE,
                        COL_PREFERENCEVALUE => $p
                    );
                }
                if(!$this->db->insert_batch(TBL_USERPREFERENCES, $arrinsert)) {
                    $this->db->trans_rollback();
                    redirect(current_url());
                }
            }

            $pref_position = $this->input->post(COL_PREFERENCEVALUE."-".PREFERENCETYPE_POSITION);
            if($pref_position && count($pref_position) > 0) {
                $arrinsert = array();
                for($i=0; $i<count($pref_position); $i++) {
                    $p = $pref_position[$i];
                    $arrinsert[] = array(
                        COL_USERNAME => $loginuser[COL_USERNAME],
                        COL_PREFERENCETYPEID => PREFERENCETYPE_POSITION,
                        COL_PREFERENCEVALUE => $p
                    );
                }
                if(!$this->db->insert_batch(TBL_USERPREFERENCES, $arrinsert)) {
                    $this->db->trans_rollback();
                    redirect(current_url());
                }
            }

            $pref_location = $this->input->post(COL_PREFERENCEVALUE."-".PREFERENCETYPE_LOCATION);
            if($pref_location && count($pref_location) > 0) {
                $arrinsert = array();
                for($i=0; $i<count($pref_location); $i++) {
                    $p = $pref_location[$i];
                    $arrinsert[] = array(
                        COL_USERNAME => $loginuser[COL_USERNAME],
                        COL_PREFERENCETYPEID => PREFERENCETYPE_LOCATION,
                        COL_PREFERENCEVALUE => $p
                    );
                }
                if(!$this->db->insert_batch(TBL_USERPREFERENCES, $arrinsert)) {
                    $this->db->trans_rollback();
                    redirect(current_url());
                }
            }

            $pref_type = $this->input->post(COL_PREFERENCEVALUE."-".PREFERENCETYPE_VACANCYTYPE);
            if($pref_type && count($pref_type) > 0) {
                $arrinsert = array();
                for($i=0; $i<count($pref_type); $i++) {
                    $p = $pref_type[$i];
                    $arrinsert[] = array(
                        COL_USERNAME => $loginuser[COL_USERNAME],
                        COL_PREFERENCETYPEID => PREFERENCETYPE_VACANCYTYPE,
                        COL_PREFERENCEVALUE => $p
                    );
                }
                if(!$this->db->insert_batch(TBL_USERPREFERENCES, $arrinsert)) {
                    $this->db->trans_rollback();
                    redirect(current_url());
                }
            }
            $this->db->trans_commit();
        }

        $pref_industry = array();
        $pref_education = array();
        $pref_position = array();
        $pref_location = array();
        $pref_type = array();
        $data["pref"] = $pref = $this->db->where(COL_USERNAME, $loginuser[COL_USERNAME])->get(TBL_USERPREFERENCES)->result_array();

        if($pref && count($pref) > 0) {
            foreach($pref as $p) {
                if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_INDUSTRYTYPE) $pref_industry[] = $p[COL_PREFERENCEVALUE];
                if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_EDUCATIONTYPE) $pref_education[] = $p[COL_PREFERENCEVALUE];
                if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_POSITION) $pref_position[] = $p[COL_PREFERENCEVALUE];
                if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_LOCATION) $pref_location[] = $p[COL_PREFERENCEVALUE];
                if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_VACANCYTYPE) $pref_type[] = $p[COL_PREFERENCEVALUE];
            }
        }
        $data["industry"] = $pref_industry;
        $data["education"] = $pref_education;
        $data["position"] = $pref_position;
        $data["location"] = $pref_location;
        $data["type"] = $pref_type;

        $this->load->view('user/preference', $data);
    }

    function register() {
        $data['title'] = "Register as Jobseeker";
        $datapost = !empty($_POST) ? $this->input->post() : null;
        $data['data'] = $datapost;
        $rules = $this->muser->rules(true, ROLEUSER);
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()){
            $userdata = array(
                COL_USERNAME => $this->input->post(COL_USERNAME),
                COL_PASSWORD => md5($this->input->post(COL_PASSWORD)),
                COL_ROLEID => ROLEUSER,
                COL_ISSUSPEND => false
            );
            $userinfo = array(
                COL_USERNAME => $this->input->post(COL_USERNAME),
                COL_EMAIL => $this->input->post(COL_EMAIL),
                COL_NAME => $this->input->post(COL_NAME),
                COL_IDENTITYNO => $this->input->post(COL_IDENTITYNO),
                COL_BIRTHDATE => $this->input->post(COL_BIRTHDATE)?date('Y-m-d', strtotime($this->input->post(COL_BIRTHDATE))):null,
                COL_RELIGIONID => $this->input->post(COL_RELIGIONID),
                COL_GENDER => $this->input->post(COL_GENDER),
                COL_ADDRESS => $this->input->post(COL_ADDRESS),
                COL_PHONENUMBER => $this->input->post(COL_PHONENUMBER),
                COL_EDUCATIONID => $this->input->post(COL_EDUCATIONID),
                COL_UNIVERSITYNAME => $this->input->post(COL_UNIVERSITYNAME),
                COL_FACULTYNAME => $this->input->post(COL_FACULTYNAME),
                COL_MAJORNAME => $this->input->post(COL_MAJORNAME),
                COL_ISGRADUATED => $this->input->post(COL_ISGRADUATED) ? $this->input->post(COL_ISGRADUATED) : false,
                COL_GRADUATEDDATE => ($this->input->post(COL_ISGRADUATED) && $this->input->post(COL_GRADUATEDDATE) ? date('Y-m-d', strtotime($this->input->post(COL_GRADUATEDDATE))) : null),
                COL_YEAROFEXPERIENCE => $this->input->post(COL_YEAROFEXPERIENCE),
                COL_RECENTPOSITION => $this->input->post(COL_RECENTPOSITION),
                COL_RECENTSALARY => $this->input->post(COL_RECENTSALARY),
                COL_EXPECTEDSALARY => $this->input->post(COL_EXPECTEDSALARY),
                COL_REGISTEREDDATE => date('Y-m-d')
            );

            $reg = $this->muser->register($userdata, $userinfo, null);
            if($reg) redirect(site_url('user/login'));
            else redirect(current_url().'?error=1');

        }else{
            $this->load->view('user/register', array('data' => $datapost));
        }
    }

    function ForgotPassword() {
        $data["title"] = "Lupa Password";
        if(!empty($_POST)) {
            $email = $this->input->post(COL_EMAIL);

            $this->db->where(COL_EMAIL, $email);
            $ruser = $this->db->get(TBL_USERINFORMATION)->row_array();
            if(!$ruser) {
                redirect(current_url()."?notfound=1");
                return false;
            }

            $encryptedmail= GetEncryption($ruser[COL_EMAIL]);
            if(IsNotificationActive(NOTIFICATION_LUPAPASSWORD)) {
                $this->load->library('email',GetEmailConfig());
                $this->email->set_newline("\r\n");

                $pref = GetNotification(NOTIFICATION_LUPAPASSWORD);

                $content = $pref[COL_NOTIFICATIONCONTENT];
                $subject = $pref[COL_NOTIFICATIONSUBJECT];

                $subject = str_replace(array("@SITENAME@"), array(SITENAME), $subject);
                $content = str_replace(array("@NAME@", "@RECOVERYLINK@", "@SITENAME@"),
                    array((!empty($ruser[COL_NAME])?$ruser[COL_NAME]:"Unknown"), site_url("user/resetpassword")."?token=".$encryptedmail, SITENAME),
                    $content);

                $this->email->from($pref[COL_NOTIFICATIONSENDEREMAIL], $pref[COL_NOTIFICATIONSENDERNAME]);
                $this->email->to($ruser[COL_EMAIL]);
                $this->email->subject($subject);
                $this->email->message($content);
                $this->email->send();
            }

            redirect(current_url()."?success=1");
            return true;
        } else {
            $this->load->view("user/forgotpassword", $data);
            return true;
        }
    }

    function ResetPassword() {
        $data["title"] = "Reset Password";
        $data["token"] = $token = $this->input->get("token");
        if(!$token) {
            show_404();
            return false;
        }

        $email = GetDecryption($token);
        $this->db->join(TBL_USERS,TBL_USERS.'.'.COL_USERNAME." = ".TBL_USERINFORMATION.".".COL_USERNAME,"inner");
        $this->db->where(COL_EMAIL, $email);
        $ruser = $this->db->get(TBL_USERINFORMATION)->row_array();
        if(!$ruser) {
            show_404();
            return false;
        }

        $rules = array(
            array(
                'field' => COL_PASSWORD,
                'label' => COL_PASSWORD,
                'rules' => 'required|min_length[6]',
                'errors' => array(
                    'required' => 'Password harap diisi',
                    'min_length' => 'Password harus mengandung minimal {param} karakter'
                )
            ),
            array(
                'field' => 'RepeatPassword',
                'label' => 'Repeat Password',
                'rules' => 'required|matches[Password]',
                'errors' => array(
                    'required' => 'Ulangi Password harap diisi',
                    'matches' => 'Isi Ulangi Password sesuai Password'
                )
            )
        );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()) {
            $this->db->where(COL_USERNAME, $ruser[COL_USERNAME]);
            if(!$this->db->update(TBL_USERS, array(COL_PASSWORD=>md5($this->input->post(COL_PASSWORD))))) {
                redirect(current_url()."?error=1");
            } else {
                redirect(site_url());
            }
        } else {
            $this->load->view("user/resetpassword", $data);
            return false;
        }
    }

    function import() {
        header('Content-Type: application/json');
        $token = "horasitdel";
        $posttoken = $this->input->post("token");
        $datapost = $_POST;
        if(!$posttoken || $posttoken != $token) {
            ShowJsonError("Parameter API tidak valid");
            return false;
        }

        $rules = $this->muser->rules(true, ROLEUSER);
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run()){
            $userdata = array(
                COL_USERNAME => $this->input->post(COL_USERNAME),
                COL_PASSWORD => md5($this->input->post(COL_PASSWORD)),
                COL_ROLEID => ROLEUSER,
                COL_ISSUSPEND => false
            );
            $userinfo = array(
                COL_USERNAME => $this->input->post(COL_USERNAME),
                COL_EMAIL => $this->input->post(COL_EMAIL),
                COL_NAME => $this->input->post(COL_NAME),
                COL_IDENTITYNO => $this->input->post(COL_IDENTITYNO),
                COL_BIRTHDATE => $this->input->post(COL_BIRTHDATE)?date('Y-m-d', strtotime($this->input->post(COL_BIRTHDATE))):null,
                COL_RELIGIONID => $this->input->post(COL_RELIGIONID),
                COL_GENDER => $this->input->post(COL_GENDER),
                COL_ADDRESS => $this->input->post(COL_ADDRESS),
                COL_PHONENUMBER => $this->input->post(COL_PHONENUMBER),
                COL_EDUCATIONID => $this->input->post(COL_EDUCATIONID),
                COL_UNIVERSITYNAME => $this->input->post(COL_UNIVERSITYNAME),
                COL_FACULTYNAME => $this->input->post(COL_FACULTYNAME),
                COL_MAJORNAME => $this->input->post(COL_MAJORNAME),
                COL_ISGRADUATED => $this->input->post(COL_ISGRADUATED) ? $this->input->post(COL_ISGRADUATED) : false,
                COL_GRADUATEDDATE => ($this->input->post(COL_ISGRADUATED) && $this->input->post(COL_GRADUATEDDATE) ? date('Y-m-d', strtotime($this->input->post(COL_GRADUATEDDATE))) : null),
                COL_YEAROFEXPERIENCE => $this->input->post(COL_YEAROFEXPERIENCE),
                COL_RECENTPOSITION => $this->input->post(COL_RECENTPOSITION),
                COL_RECENTSALARY => $this->input->post(COL_RECENTSALARY),
                COL_EXPECTEDSALARY => $this->input->post(COL_EXPECTEDSALARY),
                COL_REGISTEREDDATE => date('Y-m-d')
            );

            $reg = $this->muser->register($userdata, $userinfo, null);
            if($reg) {
                ShowJsonSuccess("Berhasil.");
                return true;
            }
            else {
                ShowJsonError("Gagal.");
                return false;
            }

        }else{
            ShowJsonError("Parameter API tidak valid.");
            return false;
        }
    }
}