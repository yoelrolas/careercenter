<?php
class User extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->helper('captcha');
        $this->load->library('user_agent');
        $this->load->model('muser');
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
        }else{
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
            $this->load->model('mcompany');
            $rules = $this->mcompany->rules(false);
            $this->form_validation->set_rules($rules);

            if($this->form_validation->run()){
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

                $reg = $this->db->where(COL_COMPANYID, $rdata[COL_COMPANYID])->update(TBL_COMPANIES, $companydata);
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
}