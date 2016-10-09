<?php
class MVacancy extends CI_Model {
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
}