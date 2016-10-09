<?php

class MCompany extends CI_Model {
    private $table = TBL_COMPANIES;

    function rules($newdata=true) {
        $rules = array(
            array(
                'field' => COL_COMPANYNAME,
                'label' => 'Company Name',
                'rules' => 'required'
            ),
            array(
                'field' => COL_COMPANYADDRESS,
                'label' => 'Company Address',
                'rules' => 'required'
            ),
            array(
                'field' => COL_COMPANYTELP,
                'label' => 'Company Telephone No.',
                'rules' => 'required'
            ),
            array(
                'field' => COL_COMPANYEMAIL,
                'label' => 'Company Email',
                'rules' => 'valid_email'
            ),
            array(
                'field' => COL_INDUSTRYTYPEID,
                'label' => 'Industry Type',
                'rules' => 'required'
            )
        );

        if($newdata) {
            $arr = array(
                array(
                    'field' => COL_USERNAME,
                    'label' => COL_USERNAME,
                    'rules' => 'required|min_length[5]|alpha_dash|is_unique[users.UserName]',
                    'errors' => array('is_unique' => 'Username already registered on system')
                ),
                array(
                    'field' => COL_PASSWORD,
                    'label' => COL_PASSWORD,
                    'rules' => 'required|min_length[6]'
                ),
                array(
                    'field' => 'RepeatPassword',
                    'label' => 'Repeat Password',
                    'rules' => 'required|matches[Password]'
                ),
                array(
                    'field' => COL_EMAIL,
                    'label' => COL_EMAIL,
                    'rules' => 'required|valid_email|is_unique[userinformation.Email]',
                    'errors' => array('is_unique' => 'Email already registered on system')
                )
            );
            $rules = array_merge($arr, $rules);
        }
        return $rules;
    }

    function register($userdata, $userinfo, $companydata) {
        $retval = true;

        $this->db->trans_begin();
        if(!$this->db->insert(TBL_USERS, $userdata)) {
            $this->db->trans_rollback();
            $retval = false;
        }
        if(!$this->db->insert(TBL_USERINFORMATION, $userinfo)) {
            $this->db->trans_rollback();
            $retval = false;
        }
        if(!$this->db->insert(TBL_COMPANIES, $companydata)) {
            $this->db->trans_rollback();
            $retval = false;
        }
        $this->db->trans_commit();

        return $retval;
    }

    function delete($datum) {
        $this->db->trans_begin();

        if(!$this->db->delete(TBL_COMPANIES, array(COL_COMPANYID => $datum))) {
            $this->db->trans_rollback();
            return false;
        }
        // Get user
        $user = $this->db->where(COL_COMPANYID, $datum)->get(TBL_USERINFORMATION)->result_array();
        if($user) {
            foreach($user as $u) {
                if(!$this->db->delete(TBL_USERINFORMATION, array(COL_USERNAME => $u[COL_USERNAME]))) {
                    $this->db->trans_rollback();
                    return false;
                }
                if(!$this->db->delete(TBL_USERS, array(COL_USERNAME => $u[COL_USERNAME]))) {
                    $this->db->trans_rollback();
                    return false;
                }
            }
        }

        $this->db->trans_commit();
        return true;
    }
}