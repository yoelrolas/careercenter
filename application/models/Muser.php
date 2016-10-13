<?php

class MUser extends CI_Model {
    private $table = TBL_USERS;

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
        $user = $this->db->where(COL_USERNAME, $username)->get($this->table)->row_array();
        if($user && !$user[COL_ISSUSPEND]) return FALSE;
        else return TRUE;
    }
    function getdetails($username){
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_USERINFORMATION.".".COL_COMPANYID,"left");
        $this->db->join(TBL_EMPLOYEES,TBL_EMPLOYEES.'.'.COL_EMPLOYEEID." = ".TBL_USERINFORMATION.".".COL_EMPLOYEEID,"left");
        $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"left");
        $this->db->where(TBL_USERS.".".COL_USERNAME,$username);

        return $this->db->get($this->table)->row_array();
    }
}