<?php
class Vacancy extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('mvacancy');
    }

    function index() {
        if(!IsLogin()) {
            redirect('user/dashboard');
        }
        $user = GetLoggedUser();
        $data['title'] = "Vacancies";

        $data['res'] = $this->mvacancy->getall($user[COL_COMPANYID], $user[COL_ROLEID]);
        $this->load->view('vacancy/index', $data);
    }

    function add() {
        if(!IsLogin()) {
            redirect('user/dashboard');
        }
        $user = GetLoggedUser();
        $data['title'] = "Vacancy";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->mvacancy->rules();
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
                $id = GetLastID(TBL_VACANCIES, COL_VACANCYID) + 1;
                $locations = array();
                $educations = array();
                $data = array(
                    COL_VACANCYID => $id,
                    COL_COMPANYID => $this->input->post(COL_COMPANYID),
                    COL_VACANCYTYPEID => $this->input->post(COL_VACANCYTYPEID),
                    COL_POSITIONID => $this->input->post(COL_POSITIONID),
                    COL_VACANCYTITLE => $this->input->post(COL_VACANCYTITLE),
                    COL_ENDDATE => date('Y-m-d', strtotime($this->input->post(COL_ENDDATE))),
                    COL_VACANCYEMAIL => $this->input->post(COL_VACANCYEMAIL),
                    COL_VACANCYDESC => $this->input->post(COL_VACANCYDESC),
                    COL_VACANCYREQUIREMENT => $this->input->post(COL_VACANCYREQUIREMENT),
                    COL_VACANCYRESPONSIBILITY => $this->input->post(COL_VACANCYRESPONSIBILITY),
                    COL_ISALLLOCATION => $this->input->post(COL_ISALLLOCATION) ? $this->input->post(COL_ISALLLOCATION) : false,
                    COL_CREATEDBY => $user[COL_USERNAME],
                    COL_CREATEDON => date('Y-m-d H:i:s'),
                    COL_UPDATEDBY => $user[COL_USERNAME],
                    COL_UPDATEDON => date('Y-m-d H:i:s'),
                    COL_ISSUSPEND => ($user[COL_ROLEID] == ROLEADMIN ? ($this->input->post(COL_ISSUSPEND) ? $this->input->post(COL_ISSUSPEND) : false) : true)
                );

                if(empty($data[COL_ISALLLOCATION]) || !$data[COL_ISALLLOCATION]) {
                    $locs = $this->input->post(COL_LOCATIONID);
                    if(is_array($locs)) {
                        foreach ($locs as $loc) {
                            $locations[] = array(
                                COL_LOCATIONID => $loc,
                                COL_VACANCYID => $id
                            );
                        }
                    }
                }

                $edus = $this->input->post(COL_EDUCATIONTYPEID);
                if(is_array($edus)) {
                    foreach ($edus as $e) {
                        $educations[] = array(
                            COL_EDUCATIONTYPEID => $e,
                            COL_VACANCYID => $id
                        );
                    }
                }

                $this->db->trans_begin();
                if(count($locations) > 0) {
                    if(!$this->db->insert_batch(TBL_VACANCYLOCATIONS, $locations)) {
                        $this->db->trans_rollback();
                        redirect(site_url('vacancy/add').'?error=1');
                    }
                }
                if(count($educations) > 0) {
                    if(!$this->db->insert_batch(TBL_VACANCYEDUCATIONS, $educations)) {
                        $this->db->trans_rollback();
                        redirect(site_url('vacancy/add').'?error=1');
                    }
                }
                if(!$this->db->insert(TBL_VACANCIES, $data)) {
                    $this->db->trans_rollback();
                    redirect(site_url('vacancy/add').'?error=1');
                }
                $this->db->trans_commit();
                $this->mvacancy->sendnotification($data);
                redirect(site_url('vacancy/index'));
            }
            else {
                $this->load->view('vacancy/form', $data);
            }
        }
        else {
            $this->load->view('vacancy/form', $data);
        }
    }

    function edit($id) {
        if(!IsLogin()) {
            redirect('user/dashboard');
        }
        $user = GetLoggedUser();
        $data['title'] = "Vacancy";
        $data['edit'] = FALSE;
        $data['data'] = $rdata = $this->db->where(COL_VACANCYID, $id)->get(TBL_VACANCIES)->row_array();
        if(!$rdata) {
            show_404();
            return;
        }

        $locs = array();
        $rlocs = $this->db->where(COL_VACANCYID, $id)->get(TBL_VACANCYLOCATIONS)->result_array();
        if($rlocs) {
            foreach($rlocs as $l) {
                $locs[] = $l[COL_LOCATIONID];
            }
        }
        $data['locs'] = $locs;

        $edus = array();
        $redus = $this->db->where(COL_VACANCYID, $id)->get(TBL_VACANCYEDUCATIONS)->result_array();
        if($redus) {
            foreach($redus as $l) {
                $edus[] = $l[COL_EDUCATIONTYPEID];
            }
        }
        $data['edus'] = $edus;

        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->mvacancy->rules();
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
                $locations = array();
                $educations = array();
                $data = array(
                    COL_COMPANYID => $this->input->post(COL_COMPANYID),
                    COL_VACANCYTYPEID => $this->input->post(COL_VACANCYTYPEID),
                    COL_POSITIONID => $this->input->post(COL_POSITIONID),
                    COL_VACANCYTITLE => $this->input->post(COL_VACANCYTITLE),
                    COL_ENDDATE => date('Y-m-d', strtotime($this->input->post(COL_ENDDATE))),
                    COL_VACANCYEMAIL => $this->input->post(COL_VACANCYEMAIL),
                    COL_VACANCYDESC => $this->input->post(COL_VACANCYDESC),
                    COL_VACANCYREQUIREMENT => $this->input->post(COL_VACANCYREQUIREMENT),
                    COL_VACANCYRESPONSIBILITY => $this->input->post(COL_VACANCYRESPONSIBILITY),
                    COL_ISALLLOCATION => $this->input->post(COL_ISALLLOCATION) ? $this->input->post(COL_ISALLLOCATION) : false,
                    COL_UPDATEDBY => $user[COL_USERNAME],
                    COL_UPDATEDON => date('Y-m-d H:i:s'),
                    COL_ISSUSPEND => ($user[COL_ROLEID] == ROLEADMIN ? ($this->input->post(COL_ISSUSPEND) ? $this->input->post(COL_ISSUSPEND) : true) : true)
                );

                if(empty($data[COL_ISALLLOCATION]) || !$data[COL_ISALLLOCATION]) {
                    $locs = $this->input->post(COL_LOCATIONID);
                    if(is_array($locs)) {
                        foreach ($locs as $loc) {
                            $locations[] = array(
                                COL_LOCATIONID => $loc,
                                COL_VACANCYID => $id
                            );
                        }
                    }
                }

                $edus = $this->input->post(COL_EDUCATIONTYPEID);
                if(is_array($edus)) {
                    foreach ($edus as $e) {
                        $educations[] = array(
                            COL_EDUCATIONTYPEID => $e,
                            COL_VACANCYID => $id
                        );
                    }
                }

                $this->db->trans_begin();
                if(!$this->db->delete(TBL_VACANCYLOCATIONS, array(COL_VACANCYID=>$id))) {
                    $this->db->trans_rollback();
                    redirect(site_url('vacancy/add').'?error=1');
                }
                if(count($locations) > 0) {
                    if(!$this->db->insert_batch(TBL_VACANCYLOCATIONS, $locations)) {
                        $this->db->trans_rollback();
                        redirect(site_url('vacancy/add').'?error=1');
                    }
                }

                if(!$this->db->delete(TBL_VACANCYEDUCATIONS, array(COL_VACANCYID=>$id))) {
                    $this->db->trans_rollback();
                    redirect(site_url('vacancy/add').'?error=1');
                }
                if(count($educations) > 0) {
                    if(!$this->db->insert_batch(TBL_VACANCYEDUCATIONS, $educations)) {
                        $this->db->trans_rollback();
                        redirect(site_url('vacancy/add').'?error=1');
                    }
                }

                if(!$this->db->insert(TBL_VACANCIES, $data)) {
                    $this->db->trans_rollback();
                    redirect(site_url('vacancy/add').'?error=1');
                }
                $this->db->trans_commit();
                $this->mvacancy->sendnotification($data);
                redirect(site_url('vacancy/index'));
            }
            else {
                $this->load->view('vacancy/form', $data);
            }
        }
        else {
            $this->load->view('vacancy/form', $data);
        }
    }

    function delete(){
        $this->load->model('mvacancy');
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            if($this->mvacancy->delete($datum)) {
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
            $this->db->where(COL_VACANCYID, $datum)->update(TBL_VACANCIES, array(COL_ISSUSPEND=>$suspend));
            $rvacancy = $this->db->where(COL_VACANCYID, $datum)->get(TBL_VACANCIES)->row_array();
            $this->mvacancy->sendnotification($rvacancy);
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data diubah");
        }else{
            ShowJsonError("Tidak ada data yang diubah");
        }
    }

    function all() {
        $data['keyword'] =  $keyword = $this->input->post('Keyword');
        $data['pos'] =  $pos = $this->input->post(COL_POSITIONID);
        $data['industry'] =  $industry = $this->input->post(COL_INDUSTRYTYPEID);
        $data['loc'] =  $location = $this->input->post(COL_LOCATIONID);

        $data['title'] = "Lowongan";
        $data['res'] = $res = $this->mvacancy->search(0, $keyword, $pos, $industry, $location);
        //echo $this->db->last_query();
        $this->load->view('vacancy/all', $data);
    }

    function detail($id) {
        $this->load->model('mvacancy');
        $data['vacancy'] = $rvacancy = $this->mvacancy->detail($id, false);
        if(!$rvacancy) {
            show_404();
            return;
        }
        $data['title'] = $rvacancy[COL_VACANCYTITLE];

        // Update total view
        $this->db->where(COL_VACANCYID, $id);
        $this->db->set(COL_TOTALVIEW, COL_TOTALVIEW."+1", FALSE);
        $this->db->update(TBL_VACANCIES);

        $this->load->view('vacancy/detail', $data);
    }
}