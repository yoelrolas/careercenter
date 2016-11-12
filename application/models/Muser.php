<?php

class Muser extends CI_Model {
    private $table = TBL_USERS;

    function rules($newdata=true, $role) {
        $rules = array();
        if($role &&  $role == ROLECOMPANY) {
            $rulecompany = array(
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

            $rules = array_merge($rulecompany, $rules);
        }
        if($role && $role == ROLEUSER) {
            $ruleuser = array(
                array(
                    'field' => COL_NAME,
                    'label' => 'Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => COL_ADDRESS,
                    'label' => 'Address',
                    'rules' => 'required'
                ),
                array(
                    'field' => COL_PHONENUMBER,
                    'label' => 'Phone Number',
                    'rules' => 'required'
                )
            );

            $rules = array_merge($ruleuser, $rules);
        }

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
        if($userdata[COL_ROLEID] && $userdata[COL_ROLEID] == ROLECOMPANY) {
            if(!$this->db->insert(TBL_COMPANIES, $companydata)) {
                $this->db->trans_rollback();
                $retval = false;
            }
        }
        $this->db->trans_commit();

        return $retval;
    }

    function authenticate($username, $password) {
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->where("(".TBL_USERS.".".COL_USERNAME." = '".$username."' OR ".TBL_USERINFORMATION.".".COL_EMAIL." = '".$username."') AND ".TBL_USERS.".".COL_PASSWORD." = '".md5($password)."'");

        $res = $this->db->get($this->table)->row_array();
        //$query = "SELECT * FROM ".TBL_USERS." where (".COL_USERNAME." = '".$username."' OR ".COL_EMAIL." = '".$username."') AND ".COL_PASSWORD." = '".md5($password)."'";
        //$cek = $this->db->query($query)->num_rows();
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function IsSuspend($username){
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->where("(".TBL_USERS.".".COL_USERNAME." = '".$username."' OR ".TBL_USERINFORMATION.".".COL_EMAIL." = '".$username."')");

        $user = $this->db->get($this->table)->row_array();
        if($user && !$user[COL_ISSUSPEND]) return FALSE;
        else return TRUE;
    }
    function getdetails($username){
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_USERINFORMATION.".".COL_COMPANYID,"left");
        $this->db->join(TBL_RELIGIONS,TBL_RELIGIONS.'.'.COL_RELIGIONID." = ".TBL_USERINFORMATION.".".COL_RELIGIONID,"left");
        $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_USERINFORMATION.".".COL_EDUCATIONID,"left");
        //$this->db->join(TBL_EMPLOYEES,TBL_EMPLOYEES.'.'.COL_EMPLOYEEID." = ".TBL_USERINFORMATION.".".COL_EMPLOYEEID,"left");
        $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"left");
        //$this->db->where(TBL_USERS.".".COL_USERNAME,$username);
        $this->db->where("(".TBL_USERS.".".COL_USERNAME." = '".$username."' OR ".TBL_USERINFORMATION.".".COL_EMAIL." = '".$username."')");

        return $this->db->get($this->table)->row_array();
    }

    function delete($datum) {
        $this->load->model('mvacancy');
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->where(TBL_USERS.".".COL_USERNAME, $datum);
        $ruser = $this->db->get(TBL_USERS)->row_array();
        $this->db->trans_begin();
        if($ruser) {
            if($ruser[COL_ROLEID] == ROLEADMIN) {
                $this->db->trans_commit();
                return true;
            }

            if($ruser[COL_ROLEID] == ROLECOMPANY && $ruser[COL_COMPANYID]) {
                // Delete Company
                if(!$this->db->delete(TBL_COMPANIES, array(COL_COMPANYID => $ruser[COL_COMPANYID]))) {
                    $this->db->trans_rollback();
                    return false;
                }

                // Delete vacancies
                $rvacancy = $this->db->where(COL_COMPANYID, $ruser[COL_COMPANYID])->get(TBL_VACANCIES)->result_array();
                foreach($rvacancy as $vac) {
                    if(!$this->mvacancy->delete($vac[COL_VACANCYID])) {
                        $this->db->trans_rollback();
                        return false;
                    }
                }
            }

            if(!$this->db->delete(TBL_USERINFORMATION, array(COL_USERNAME => $datum))) {
                $this->db->trans_rollback();
                return false;
            }
        }

        if(!$this->db->delete(TBL_USERS, array(COL_USERNAME => $datum))) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }

    function IsProfileComplete() {
        $user = GetLoggedUser();
        if($user[COL_ROLEID] == ROLEUSER) {
            if(empty($user[COL_NAME]) || empty($user[COL_IDENTITYNO]) || empty($user[COL_BIRTHDATE]) ||
                empty($user[COL_RELIGIONID]) || empty($user[COL_GENDER]) || empty($user[COL_ADDRESS]) || empty($user[COL_PHONENUMBER]) ||
                empty($user[COL_EDUCATIONID]) || empty($user[COL_UNIVERSITYNAME]) || empty($user[COL_FACULTYNAME]) || empty($user[COL_MAJORNAME]) ||
                empty($user[COL_EXPECTEDSALARY]) || empty($user[COL_CVFILENAME]) || empty($user[COL_IMAGEFILENAME])) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function IsVacancyFitToUser($vacancy) {
        $user = GetLoggedUser();
        $retval = true;
        /*if(!empty($user)) {
            $pref = $this->db->where(COL_USERNAME, $user[COL_USERNAME])->get(TBL_USERPREFERENCES)->result_array();
            foreach($pref as $p) {
                if($pref[COL_PREFERENCETYPEID] == PREFERENCETYPE_INDUSTRYTYPE && $vacancy[COL_INDUSTRYTYPEID] != $pref[COL_PREFERENCEVALUE]) {
                    if($retval == true)
                }
            }
        } else {
            return false;
        }*/

        return $retval;
    }
}