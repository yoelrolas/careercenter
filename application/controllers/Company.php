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
        $rules = $this->mcompany->rules();

        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
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
                COL_REGISTERDATE => date('Y-m-d H:i:s')
            );

            $reg = $this->mcompany->register($userdata, $userinfo, $companydata);
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
        $data['title'] = "Companies";
        $data['edit'] = FALSE;
        if(!empty($_POST)){
            $rules = $this->mcompany->rules();
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
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
                    COL_APPROVEDDATE => date('Y-m-d H:i:s')
                );

                $reg = $this->mcompany->register($userdata, $userinfo, $companydata);
                if($reg) echo json_encode(array('error'=>0, 'redirect'=>site_url('company/index')));
                else ShowJsonError('Gagal menambah data');
            }
            else {
                ShowJsonError(validation_errors());
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
        $data['title'] = "Companies";
        $data['edit'] = TRUE;
        $data['data'] = $edited = $this->db->where(COL_COMPANYID, $id)->get(TBL_COMPANIES)->row_array();
        if(empty($edited)){
            show_404();
            return;
        }

        if(!empty($_POST)){
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
                    COL_INDUSTRYTYPEID => $this->input->post(COL_INDUSTRYTYPEID)
                );

                $reg = $this->db->where(COL_COMPANYID, $id)->update(TBL_COMPANIES, $companydata);
                if($reg) echo json_encode(array('error'=>0, 'redirect'=>site_url('company/index')));
                else ShowJsonError('Gagal mengubah data');
            }
            else {
                ShowJsonError(validation_errors());
            }
        }
        else {
            $this->load->view('company/form', $data);
        }
    }

    function delete(){
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

    function activate($suspend=false){
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            // Get User
            $user = $this->db->where(COL_COMPANYID, $datum)->get(TBL_USERINFORMATION)->row_array();
            if($user) {
                if($this->db->where(COL_USERNAME, $user[COL_USERNAME])->update(TBL_USERS, array(COL_ISSUSPEND=>$suspend))) {
                    $deleted++;
                }
                if(!$suspend) {
                    $this->db->where(COL_COMPANYID, $datum)->update(TBL_COMPANIES, array(COL_APPROVEDDATE=>date('Y-m-d H:i:s')));
                }
            }
        }
        if($deleted){
            ShowJsonSuccess($deleted." data diubah");
        }else{
            ShowJsonError("Tidak ada data yang diubah");
        }
    }
}