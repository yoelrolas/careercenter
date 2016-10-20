<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public function index()
    {
        $this->load->model('mvacancy');
        $this->load->model('mcompany');
        $data['vacancies'] = $this->mvacancy->search(10);
        $data['companies'] = $this->mcompany->search(10);
        /*$data['news'] = $this->mpost->search(10,"",POSTCATEGORY_NEWS);
        $data['blogs'] = $this->mpost->search(10,"",POSTCATEGORY_BLOG);
        $data['events'] = $this->mpost->search(10,"",POSTCATEGORY_EVENT);*/
        $this->load->view('home/index', $data);
        //echo $this->db->last_query();
    }
}
