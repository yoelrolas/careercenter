<?php
class Master extends MY_Controller {
    function __construct() {
        parent::__construct();
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }
    }

    function ets() {
        $data['title'] = 'Education Types';
        $this->db->order_by(COL_EDUCATIONTYPENAME, 'asc');
        $data['res'] = $this->db->get(TBL_EDUCATIONTYPES)->result_array();
        $this->load->view('master/ets', $data);
    }
    function etadd() {
        $data['title'] = "Education Types";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/ets');
            $data = array(
                COL_EDUCATIONTYPENAME => $this->input->post(COL_EDUCATIONTYPENAME)
            );
            if(!$this->db->insert(TBL_EDUCATIONTYPES, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/etform',$data);
        }
    }
    function etedit($id) {
        $rdata = $data['data'] = $this->db->where(COL_EDUCATIONTYPEID, $id)->get(TBL_EDUCATIONTYPES)->row_array();
        if(empty($rdata)){
            show_404();
            return;
        }

        $data['title'] = 'Education Types';
        $data['edit'] = TRUE;
        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/ets');
            $data = array(
                COL_EDUCATIONTYPENAME => $this->input->post(COL_EDUCATIONTYPENAME)
            );
            if(!$this->db->where(COL_EDUCATIONTYPEID, $id)->update(TBL_EDUCATIONTYPES, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/etform',$data);
        }
    }
    function etdelete(){
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            $this->db->delete(TBL_EDUCATIONTYPES, array(COL_EDUCATIONTYPEID => $datum));
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada dihapus");
        }
    }

    function its() {
        $data['title'] = 'Industry Types';
        $this->db->order_by(COL_INDUSTRYTYPENAME, 'asc');
        $data['res'] = $this->db->get(TBL_INDUSTRYTYPES)->result_array();
        $this->load->view('master/its', $data);
    }
    function itadd() {
        $data['title'] = "Industry Types";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/its');
            $data = array(
                COL_INDUSTRYTYPENAME => $this->input->post(COL_INDUSTRYTYPENAME)
            );
            if(!$this->db->insert(TBL_INDUSTRYTYPES, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/itform',$data);
        }
    }
    function itedit($id) {
        $rdata = $data['data'] = $this->db->where(COL_INDUSTRYTYPEID, $id)->get(TBL_INDUSTRYTYPES)->row_array();
        if(empty($rdata)){
            show_404();
            return;
        }

        $data['title'] = 'Industry Types';
        $data['edit'] = TRUE;
        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/its');
            $data = array(
                COL_INDUSTRYTYPENAME => $this->input->post(COL_INDUSTRYTYPENAME)
            );
            if(!$this->db->where(COL_INDUSTRYTYPEID, $id)->update(TBL_INDUSTRYTYPES, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/itform',$data);
        }
    }
    function itdelete(){
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            $this->db->delete(TBL_INDUSTRYTYPES, array(COL_INDUSTRYTYPEID => $datum));
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada dihapus");
        }
    }

    function vts() {
        $data['title'] = 'Vacancy Types';
        $this->db->order_by(COL_VACANCYTYPENAME, 'asc');
        $data['res'] = $this->db->get(TBL_VACANCYTYPES)->result_array();
        $this->load->view('master/vts', $data);
    }
    function vtadd() {
        $data['title'] = "Vacancy Types";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/vts');
            $data = array(
                COL_VACANCYTYPENAME => $this->input->post(COL_VACANCYTYPENAME)
            );
            if(!$this->db->insert(TBL_VACANCYTYPES, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/vtform',$data);
        }
    }
    function vtedit($id) {
        $rdata = $data['data'] = $this->db->where(COL_VACANCYTYPEID, $id)->get(TBL_VACANCYTYPES)->row_array();
        if(empty($rdata)){
            show_404();
            return;
        }

        $data['title'] = 'Vacancy Types';
        $data['edit'] = TRUE;
        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/vts');
            $data = array(
                COL_VACANCYTYPENAME => $this->input->post(COL_VACANCYTYPENAME)
            );
            if(!$this->db->where(COL_VACANCYTYPEID, $id)->update(TBL_VACANCYTYPES, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/vtform',$data);
        }
    }
    function vtdelete(){
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            $this->db->delete(TBL_VACANCYTYPES, array(COL_VACANCYTYPEID => $datum));
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada dihapus");
        }
    }

    function locations() {
        $data['title'] = 'Locations';
        $this->db->order_by(COL_LOCATIONNAME, 'asc');
        $data['res'] = $this->db->get(TBL_LOCATIONS)->result_array();
        $this->load->view('master/locations', $data);
    }
    function locationadd() {
        $data['title'] = "Locations";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/locations');
            $data = array(
                COL_LOCATIONNAME => $this->input->post(COL_LOCATIONNAME)
            );
            if(!$this->db->insert(TBL_LOCATIONS, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/locationform',$data);
        }
    }
    function locationedit($id) {
        $rdata = $data['data'] = $this->db->where(COL_LOCATIONID, $id)->get(TBL_LOCATIONS)->row_array();
        if(empty($rdata)){
            show_404();
            return;
        }

        $data['title'] = 'Locations';
        $data['edit'] = TRUE;
        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/locations');
            $data = array(
                COL_LOCATIONNAME => $this->input->post(COL_LOCATIONNAME)
            );
            if(!$this->db->where(COL_LOCATIONID, $id)->update(TBL_LOCATIONS, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/locationform',$data);
        }
    }
    function locationdelete(){
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            $this->db->delete(TBL_LOCATIONS, array(COL_LOCATIONID => $datum));
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada dihapus");
        }
    }

    function positions() {
        $data['title'] = 'Positions';
        $this->db->order_by(COL_POSITIONNAME, 'asc');
        $data['res'] = $this->db->get(TBL_POSITIONS)->result_array();
        $this->load->view('master/positions', $data);
    }
    function positionadd() {
        $data['title'] = "Positions";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/positions');
            $data = array(
                COL_POSITIONNAME => $this->input->post(COL_POSITIONNAME)
            );
            if(!$this->db->insert(TBL_POSITIONS, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/positionform',$data);
        }
    }
    function positionedit($id) {
        $rdata = $data['data'] = $this->db->where(COL_POSITIONID, $id)->get(TBL_POSITIONS)->row_array();
        if(empty($rdata)){
            show_404();
            return;
        }

        $data['title'] = 'Positions';
        $data['edit'] = TRUE;
        if(!empty($_POST)){
            $resp = array();
            $resp['error'] = 0;
            $resp['success'] = 1;
            $resp['redirect'] = site_url('master/positions');
            $data = array(
                COL_POSITIONNAME => $this->input->post(COL_POSITIONNAME)
            );
            if(!$this->db->where(COL_POSITIONID, $id)->update(TBL_POSITIONS, $data)){
                $resp['error'] = 1;
                $resp['success'] = 0;
            }
            echo json_encode($resp);
        }else{
            $this->load->view('master/positionform',$data);
        }
    }
    function positiondelete(){
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            $this->db->delete(TBL_POSITIONS, array(COL_POSITIONID => $datum));
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada dihapus");
        }
    }
}