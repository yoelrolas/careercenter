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
            $username = $this->input->post(COL_USERNAME);
            $password = $this->input->post(COL_PASSWORD);

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
}