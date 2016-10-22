<?php
class Mvacancy extends CI_Model {
    private $table = TBL_VACANCIES;

    function rules($newdata=true) {
        $rules = array(
            array(
                'field' => COL_COMPANYID,
                'label' => 'Company',
                'rules' => 'required'
            ),
            array(
                'field' => COL_VACANCYTYPEID,
                'label' => 'Type',
                'rules' => 'required'
            ),
            array(
                'field' => COL_POSITIONID,
                'label' => 'Position',
                'rules' => 'required'
            ),
            array(
                'field' => COL_VACANCYTITLE,
                'label' => 'Title',
                'rules' => 'required'
            ),
            array(
                'field' => COL_ENDDATE,
                'label' => 'End Date',
                'rules' => 'required'
            ),
            array(
                'field' => COL_VACANCYEMAIL,
                'label' => 'Email',
                'rules' => 'required'
            ),
            array(
                'field' => "EducationTypeID[]",
                'label' => 'Pendidikan',
                'rules' => 'required'
            )
        );

        return $rules;
    }

    function getall($id, $role) {
        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_VACANCIES.".".COL_COMPANYID,"inner");
        $this->db->join(TBL_VACANCYTYPES,TBL_VACANCYTYPES.'.'.COL_VACANCYTYPEID." = ".TBL_VACANCIES.".".COL_VACANCYTYPEID,"inner");
        $this->db->join(TBL_POSITIONS,TBL_POSITIONS.'.'.COL_POSITIONID." = ".TBL_VACANCIES.".".COL_POSITIONID,"inner");
        $this->db->order_by(TBL_VACANCIES.".".COL_CREATEDBY, 'desc');
        if($role != ROLEADMIN) {
            $this->db->where(TBL_COMPANIES.".".COL_COMPANYID, $id);
        }
        return $this->db->get($this->table)->result_array();
    }

    function delete($datum) {
        $this->db->trans_begin();

        if(!$this->db->delete(TBL_VACANCIES, array(COL_VACANCYID => $datum))) {
            $this->db->trans_rollback();
            return false;
        }
        if(!$this->db->delete(TBL_VACANCYLOCATIONS, array(COL_VACANCYID => $datum))) {
            $this->db->trans_rollback();
            return false;
        }
        if(!$this->db->delete(TBL_VACANCYEDUCATIONS, array(COL_VACANCYID => $datum))) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }

    function search($limit=0,$keyword="", $position=array(), $industry=array(), $location=array(), $type=array(), $educationtype=array()) {
        $select = "*";
        $select .= ", ".TBL_VACANCIES.".".COL_VACANCYID." as ".COL_VACANCYID;
        $select .= ", GROUP_CONCAT(DISTINCT ".TBL_LOCATIONS.".".COL_LOCATIONNAME." SEPARATOR ', ') as Locations";
        $select .= ", GROUP_CONCAT(DISTINCT ".TBL_EDUCATIONTYPES.".".COL_EDUCATIONTYPENAME." SEPARATOR ', ') as Educations";
        $this->db->select($select);

        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_VACANCIES.".".COL_COMPANYID,"inner");
        $this->db->join(TBL_POSITIONS,TBL_POSITIONS.'.'.COL_POSITIONID." = ".TBL_VACANCIES.".".COL_POSITIONID,"inner");
        $this->db->join(TBL_VACANCYTYPES,TBL_VACANCYTYPES.'.'.COL_VACANCYTYPEID." = ".TBL_VACANCIES.".".COL_VACANCYTYPEID,"inner");
        $this->db->join(TBL_VACANCYLOCATIONS,TBL_VACANCYLOCATIONS.'.'.COL_VACANCYID." = ".TBL_VACANCIES.".".COL_VACANCYID,"left");
        $this->db->join(TBL_LOCATIONS,TBL_LOCATIONS.'.'.COL_LOCATIONID." = ".TBL_VACANCYLOCATIONS.".".COL_LOCATIONID,"left");
        $this->db->join(TBL_VACANCYEDUCATIONS,TBL_VACANCYEDUCATIONS.'.'.COL_VACANCYID." = ".TBL_VACANCIES.".".COL_VACANCYID,"left");
        $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_VACANCYEDUCATIONS.".".COL_EDUCATIONTYPEID,"left");

        if(!empty($keyword)) {
            $where = "(".TBL_COMPANIES.".".COL_COMPANYNAME." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_VACANCIES.".".COL_VACANCYTITLE." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_POSITIONS.".".COL_POSITIONNAME." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_VACANCYTYPES.".".COL_VACANCYTYPENAME." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_LOCATIONS.".".COL_LOCATIONNAME." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_EDUCATIONTYPES.".".COL_EDUCATIONTYPENAME." LIKE '%".$keyword."%'";
            $where .= ")";

            $this->db->where($where);
        }
        if(!empty($position) && count($position) > 0) $this->db->where_in(TBL_VACANCIES.".".COL_POSITIONID, $position);
        if(!empty($industry) && count($industry) > 0) $this->db->where_in(TBL_COMPANIES.".".COL_INDUSTRYTYPEID, $industry);
        if(!empty($location) && count($location) > 0) $this->db->where_in(TBL_VACANCYLOCATIONS.".".COL_LOCATIONID, $location);
        if(!empty($type) && count($type) > 0) $this->db->where_in(TBL_VACANCIES.".".COL_VACANCYTYPEID, $type);
        if(!empty($educationtype) && count($educationtype) > 0) $this->db->where_in(TBL_VACANCYEDUCATIONS.".".COL_EDUCATIONTYPEID, $educationtype);
        if($limit > 0) $this->db->limit($limit);

        $this->db->where(TBL_VACANCIES.".".COL_ISSUSPEND, false);
        $this->db->where(TBL_VACANCIES.".".COL_ENDDATE." >= ", date("Y-m-d"));
        $this->db->order_by(TBL_VACANCIES.".".COL_CREATEDON, "desc");
        $this->db->group_by(TBL_VACANCIES.".".COL_VACANCYID);
        $res = $this->db->get($this->table)->result_array();
        return $res;
    }

    function getbycompany($compid, $all=false) {
        $select = "*";
        $select .= ", ".TBL_VACANCIES.".".COL_VACANCYID." as ".COL_VACANCYID;
        $select .= ", GROUP_CONCAT(DISTINCT ".TBL_LOCATIONS.".".COL_LOCATIONNAME." SEPARATOR ', ') as Locations";
        $select .= ", GROUP_CONCAT(DISTINCT ".TBL_EDUCATIONTYPES.".".COL_EDUCATIONTYPENAME." SEPARATOR ', ') as Educations";
        $this->db->select($select);

        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_VACANCIES.".".COL_COMPANYID,"inner");
        $this->db->join(TBL_POSITIONS,TBL_POSITIONS.'.'.COL_POSITIONID." = ".TBL_VACANCIES.".".COL_POSITIONID,"inner");
        $this->db->join(TBL_VACANCYTYPES,TBL_VACANCYTYPES.'.'.COL_VACANCYTYPEID." = ".TBL_VACANCIES.".".COL_VACANCYTYPEID,"inner");
        $this->db->join(TBL_VACANCYLOCATIONS,TBL_VACANCYLOCATIONS.'.'.COL_VACANCYID." = ".TBL_VACANCIES.".".COL_VACANCYID,"left");
        $this->db->join(TBL_LOCATIONS,TBL_LOCATIONS.'.'.COL_LOCATIONID." = ".TBL_VACANCYLOCATIONS.".".COL_LOCATIONID,"left");
        $this->db->join(TBL_VACANCYEDUCATIONS,TBL_VACANCYEDUCATIONS.'.'.COL_VACANCYID." = ".TBL_VACANCIES.".".COL_VACANCYID,"left");
        $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_VACANCYEDUCATIONS.".".COL_EDUCATIONTYPEID,"left");

        if(!$all) {
            $this->db->where(TBL_VACANCIES.".".COL_ISSUSPEND, false);
            $this->db->where(TBL_VACANCIES.".".COL_ENDDATE." >= ", date("Y-m-d"));
        }
        $this->db->where(TBL_VACANCIES.".".COL_COMPANYID, $compid);
        $this->db->order_by(TBL_VACANCIES.".".COL_CREATEDON, "desc");
        $this->db->group_by(TBL_VACANCIES.".".COL_VACANCYID);
        $res = $this->db->get($this->table)->result_array();
        return $res;
    }

    function detail($id, $all=false) {
        $select = "*";
        $select .= ", ".TBL_VACANCIES.".".COL_VACANCYID." as ".COL_VACANCYID;
        $select .= ", GROUP_CONCAT(DISTINCT ".TBL_LOCATIONS.".".COL_LOCATIONNAME." SEPARATOR ', ') as Locations";
        $select .= ", GROUP_CONCAT(DISTINCT ".TBL_EDUCATIONTYPES.".".COL_EDUCATIONTYPENAME." SEPARATOR ', ') as Educations";
        $this->db->select($select);

        $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_VACANCIES.".".COL_COMPANYID,"inner");
        $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"inner");
        $this->db->join(TBL_POSITIONS,TBL_POSITIONS.'.'.COL_POSITIONID." = ".TBL_VACANCIES.".".COL_POSITIONID,"inner");
        $this->db->join(TBL_VACANCYTYPES,TBL_VACANCYTYPES.'.'.COL_VACANCYTYPEID." = ".TBL_VACANCIES.".".COL_VACANCYTYPEID,"inner");
        $this->db->join(TBL_VACANCYLOCATIONS,TBL_VACANCYLOCATIONS.'.'.COL_VACANCYID." = ".TBL_VACANCIES.".".COL_VACANCYID,"left");
        $this->db->join(TBL_LOCATIONS,TBL_LOCATIONS.'.'.COL_LOCATIONID." = ".TBL_VACANCYLOCATIONS.".".COL_LOCATIONID,"left");
        $this->db->join(TBL_VACANCYEDUCATIONS,TBL_VACANCYEDUCATIONS.'.'.COL_VACANCYID." = ".TBL_VACANCIES.".".COL_VACANCYID,"left");
        $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_VACANCYEDUCATIONS.".".COL_EDUCATIONTYPEID,"left");

        if(!$all) {
            $this->db->where(TBL_VACANCIES.".".COL_ISSUSPEND, false);
            $this->db->where(TBL_VACANCIES.".".COL_ENDDATE." >= ", date("Y-m-d"));
        }
        $this->db->where(TBL_VACANCIES.".".COL_VACANCYID, $id);
        $this->db->order_by(TBL_VACANCIES.".".COL_CREATEDON, "desc");
        $this->db->group_by(TBL_VACANCIES.".".COL_VACANCYID);
        $res = $this->db->get($this->table)->row_array();
        return $res;
    }

    function sendnotification($data) {
        // Notifications
        $rcompany = $this->db->where(COL_COMPANYID, $data[COL_COMPANYID])->get(TBL_COMPANIES)->row_array();
        $rtype = $this->db->where(COL_VACANCYTYPEID, $data[COL_VACANCYTYPEID])->get(TBL_VACANCYTYPES)->row_array();
        $rposition = $this->db->where(COL_POSITIONID, $data[COL_POSITIONID])->get(TBL_POSITIONS)->row_array();

        if(IsNotificationActive(NOTIFICATION_LOWONGANBARUADMIN)) {
            $this->load->library('email',GetEmailConfig());
            $this->email->set_newline("\r\n");

            $pref = GetNotification(NOTIFICATION_LOWONGANBARUADMIN);

            $content = $pref[COL_NOTIFICATIONCONTENT];
            $subject = $pref[COL_NOTIFICATIONSUBJECT];

            $subject = str_replace(array("@COMPANYNAME@"), array((!empty($rcompany)?$rcompany[COL_COMPANYNAME]:"Unknown")), $subject);
            $content = str_replace(array("@COMPANYNAME@", "@SITENAME@", "@VACANCYTITLE@", "@VACANCYTYPE@", "@VACANCYPOSITION@", "@URL@", "@STATUS@"),
                array((!empty($rcompany)?$rcompany[COL_COMPANYNAME]:"Unknown"), SITENAME, $data[COL_VACANCYTITLE], (!empty($rtype)?$rtype[COL_VACANCYTYPENAME]:"Unknown"),
                    (!empty($rposition)?$rposition[COL_POSITIONNAME]:"Unknown"), site_url('vacancy/index'), ($data[COL_ISSUSPEND]?"SUSPEND":"AKTIF")),
                $content);

            $this->email->from($pref[COL_NOTIFICATIONSENDEREMAIL], $pref[COL_NOTIFICATIONSENDERNAME]);
            $this->email->to(GetSetting(SETTING_WEBMAIL));
            $this->email->subject($subject);
            $this->email->message($content);
            $this->email->send();
        }
        if(!$data[COL_ISSUSPEND]) {
            if(IsNotificationActive(NOTIFICATION_LOWONGANBARUUSER)) {
                $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
                $this->db->where(COL_ROLEID, ROLEUSER);
                $alluser = $this->db->get(TBL_USERS)->result_array();

                $this->load->library('email',GetEmailConfig());
                $this->email->set_newline("\r\n");

                $pref = GetNotification(NOTIFICATION_LOWONGANBARUUSER);
                $oricontent = $pref[COL_NOTIFICATIONCONTENT];
                $subject = $pref[COL_NOTIFICATIONSUBJECT];

                $subject = str_replace(array("@COMPANYNAME@"), array((!empty($rcompany)?$rcompany[COL_COMPANYNAME]:"Unknown")), $subject);

                foreach($alluser as $u) {
                    if(!empty($u[COL_EMAIL])) {
                        $content = str_replace(array("@COMPANYNAME@", "@SITENAME@", "@VACANCYTITLE@", "@VACANCYTYPE@", "@VACANCYPOSITION@", "@URL@", "@NAME@"),
                            array((!empty($rcompany)?$rcompany[COL_COMPANYNAME]:"Unknown"), SITENAME, $data[COL_VACANCYTITLE], (!empty($rtype)?$rtype[COL_VACANCYTYPENAME]:"Unknown"),
                                (!empty($rposition)?$rposition[COL_POSITIONNAME]:"Unknown"), site_url('vacancy/detail/'.$data[COL_VACANCYID]), $u[COL_NAME]),
                            $oricontent);

                        $this->email->from($pref[COL_NOTIFICATIONSENDEREMAIL], $pref[COL_NOTIFICATIONSENDERNAME]);
                        $this->email->to($u[COL_EMAIL]);
                        $this->email->subject($subject);
                        $this->email->message($content);
                        $this->email->send();
                    }
                }
            }
        }
    }
}