<?php
class Post extends MY_Controller {
    function __construct() {
        parent::__construct();
        /*if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }*/
        $this->load->model('mpost');
    }

    function index() {
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }
        $data['title'] = "Posts";
        $data['res'] = $this->mpost->getall();
        $this->load->view('post/index', $data);
    }

    function add() {
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }
        $user = GetLoggedUser();
        $data['title'] = "Post";
        $data['edit'] = FALSE;

        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->mpost->rules();
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
                $id = GetLastID(TBL_POSTS, COL_POSTID) + 1;

                $config['upload_path'] = MY_UPLOADPATH;
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']	= 512000;
                $config['max_width']  = 1024;
                $config['max_height']  = 768;
                $config['overwrite'] = FALSE;

                $this->load->library('upload',$config);
                if(!empty($_FILES["userfile"]["name"])) {
                    if(!$this->upload->do_upload()){
                        $data['upload_errors'] = $this->upload->display_errors();
                        $this->load->view('post/add', $data);
                        return;
                    }
                }
                $dataupload = $this->upload->data();
                $data = array(
                    COL_POSTID => $id,
                    COL_POSTCATEGORYID => $this->input->post(COL_POSTCATEGORYID),
                    COL_POSTDATE => date('Y-m-d'),
                    COL_POSTTITLE => $this->input->post(COL_POSTTITLE),
                    COL_POSTSLUG => slugify($this->input->post(COL_POSTTITLE)),
                    COL_POSTCONTENT => $this->input->post(COL_POSTCONTENT),
                    COL_POSTEXPIREDDATE => date('Y-m-d', strtotime($this->input->post(COL_POSTEXPIREDDATE))),
                    COL_ISSUSPEND => ($user[COL_ROLEID] == ROLEADMIN ? ($this->input->post(COL_ISSUSPEND) ? $this->input->post(COL_ISSUSPEND) : false) : true),
                    COL_CREATEDBY => $user[COL_USERNAME],
                    COL_CREATEDON => date('Y-m-d H:i:s'),
                    COL_UPDATEDBY => $user[COL_USERNAME],
                    COL_UPDATEDON => date('Y-m-d H:i:s')
                );
                if(!empty($dataupload) && $dataupload['file_name']) {
                    $data[COL_FILENAME] = $dataupload['file_name'];
                }

                $res = $this->db->insert(TBL_POSTS, $data);
                if($res) {
                    redirect('post/index');
                } else {
                    redirect(current_url()."?error=1");
                }
            }
            else {
                $this->load->view('post/form', $data);
            }
        }
        else {
            $this->load->view('post/form', $data);
        }
    }

    function edit($id) {
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }
        $user = GetLoggedUser();
        $data['title'] = "Post";
        $data['edit'] = TRUE;
        $data['data'] = $edited = $this->db->where(COL_POSTID, $id)->get(TBL_POSTS)->row_array();
        if(empty($edited)){
            show_404();
            return;
        }

        if(!empty($_POST)){
            $data['data'] = $_POST;
            $rules = $this->mpost->rules(false);
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run()){
                $config['upload_path'] = MY_UPLOADPATH;
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']	= 512000;
                $config['max_width']  = 1024;
                $config['max_height']  = 768;
                $config['overwrite'] = FALSE;

                $this->load->library('upload',$config);
                if(!empty($_FILES["userfile"]["name"])) {
                    if(!$this->upload->do_upload()){
                        $data['upload_errors'] = $this->upload->display_errors();
                        $this->load->view('post/form', $data);
                        return;
                    }
                }

                $dataupload = $this->upload->data();
                $data = array(
                    COL_POSTCATEGORYID => $this->input->post(COL_POSTCATEGORYID),
                    COL_POSTDATE => date('Y-m-d'),
                    COL_POSTTITLE => $this->input->post(COL_POSTTITLE),
                    //COL_POSTSLUG => $this->input->post(COL_POSTSLUG) ? $this->input->post(COL_POSTSLUG) : str_replace(" ", "-", strtolower($this->input->post(COL_POSTTITLE))),
                    COL_POSTSLUG => slugify($this->input->post(COL_POSTTITLE)),
                    COL_POSTCONTENT => $this->input->post(COL_POSTCONTENT),
                    COL_POSTEXPIREDDATE => date('Y-m-d', strtotime($this->input->post(COL_POSTEXPIREDDATE))),
                    COL_ISSUSPEND => ($user[COL_ROLEID] == ROLEADMIN ? ($this->input->post(COL_ISSUSPEND) ? $this->input->post(COL_ISSUSPEND) : false) : true),
                    COL_UPDATEDBY => $user[COL_USERNAME],
                    COL_UPDATEDON => date('Y-m-d H:i:s')
                );
                if(!empty($dataupload) && $dataupload['file_name']) {
                    $data[COL_FILENAME] = $dataupload['file_name'];
                }

                $reg = $this->db->where(COL_POSTID, $id)->update(TBL_POSTS, $data);
                if($reg) redirect(site_url('post/index'));
                else redirect(current_url().'?error=1');
            }
            else {
                $this->load->view('post/form', $data);
            }
        }
        else {
            $this->load->view('post/form', $data);
        }
    }

    function delete(){
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }
        $data = $this->input->post('cekbox');
        $deleted = 0;
        foreach ($data as $datum) {
            $this->db->delete(TBL_POSTS, array(COL_POSTID => $datum));
            $deleted++;
        }
        if($deleted){
            ShowJsonSuccess($deleted." data dihapus");
        }else{
            ShowJsonError("Tidak ada dihapus");
        }
    }

    function activate($suspend=false) {
        if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
            redirect('user/dashboard');
        }

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
            if($this->db->where(COL_POSTID, $datum)->update(TBL_POSTS, array(COL_ISSUSPEND=>$suspend))) {
                $deleted++;
            }
        }
        if($deleted){
            ShowJsonSuccess($deleted." data diubah");
        }else{
            ShowJsonError("Tidak ada data yang diubah");
        }
    }

    function all($catid) {
        $rcat = $this->db->where(COL_POSTCATEGORYID, $catid)->get(TBL_POSTCATEGORIES)->row_array();
        if(!$rcat) {
            show_404();
            return false;
        }
        $data['title'] = $rcat[COL_POSTCATEGORYNAME];
        /*$data['news'] = $this->mpost->search(10,"",POSTCATEGORY_NEWS);
        $data['blogs'] = $this->mpost->search(10,"",POSTCATEGORY_BLOG);
        $data['events'] = $this->mpost->search(10,"",POSTCATEGORY_EVENT);*/
        $data['data'] = $this->mpost->search(0,"",$rcat[COL_POSTCATEGORYID]);
        $this->load->view('post/all', $data);
    }

    function view($slug) {
        $this->db->join(TBL_POSTCATEGORIES,TBL_POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL_POSTS.".".COL_POSTCATEGORYID,"inner");
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_POSTS.".".COL_CREATEDBY,"inner");
        $this->db->where("(".TBL_POSTS.".".COL_POSTSLUG." = '".$slug."' OR ".TBL_POSTS.".".COL_POSTID." = '".$slug."')");
        $rpost = $this->db->get(TBL_POSTS)->row_array();
        if(!$rpost) {
            show_404();
            return false;
        }

        $this->db->where(COL_POSTID, $rpost[COL_POSTID]);
        $this->db->set(COL_TOTALVIEW, COL_TOTALVIEW."+1", FALSE);
        $this->db->update(TBL_POSTS);

        $data['title'] = $rpost[COL_POSTTITLE];
        $data['data'] = $rpost;

        $this->load->view('post/view', $data);
    }

    function search() {
        $data['title'] = "Posts";
        $cat = $this->input->post(COL_POSTCATEGORYID);
        $keyword = $this->input->post("Keyword");
        $data['data'] = $this->mpost->search(0,$keyword,$cat);
        $data['datapost'] = array(
            "Keyword" => $keyword,
            COL_POSTCATEGORYID => $cat
        );
        $this->load->view('post/all', $data);
    }
}