<?php
class Mpost extends CI_Model {
    private $table = TBL_POSTS;

    function rules() {
        $rules = array(
            array(
                'field' => COL_POSTTITLE,
                'label' => 'Title',
                'rules' => 'required'
            ),
            /*array(
                'field' => COL_POSTSLUG,
                'label' => 'Slug',
                'rules' => 'required'
            ),*/
            array(
                'field' => COL_POSTCONTENT,
                'label' => 'Content',
                'rules' => 'required'
            ),
            array(
                'field' => COL_POSTEXPIREDDATE,
                'label' => 'Expired Date',
                'rules' => 'required'
            )
        );

        return $rules;
    }

    function getall() {
        $this->db->join(TBL_POSTCATEGORIES,TBL_POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL_POSTS.".".COL_POSTCATEGORYID,"inner");
        $this->db->order_by(TBL_POSTS.".".COL_CREATEDON, "desc");
        $res = $this->db->get($this->table)->result_array();
        return $res;
    }

    function search($limit=0,$keyword="",$type=null) {
        $this->db->join(TBL_POSTCATEGORIES,TBL_POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL_POSTS.".".COL_POSTCATEGORYID,"inner");
        $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_POSTS.".".COL_CREATEDBY,"inner");

        if(!empty($keyword)) {
            $where = "(".TBL_POSTS.".".COL_POSTTITLE." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_POSTS.".".COL_POSTSLUG." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL_POSTS.".".COL_POSTCONTENT." LIKE '%".$keyword."%'";
            $where .= ")";

            $this->db->where($where);
        }
        if(!empty($type)) $this->db->where(TBL_POSTS.".".COL_POSTCATEGORYID, $type);
        if($limit > 0) $this->db->limit($limit);

        $this->db->where(TBL_POSTS.".".COL_ISSUSPEND, false);
        $this->db->where(TBL_POSTS.".".COL_POSTEXPIREDDATE." >= ", date("Y-m-d"));
        $this->db->order_by(TBL_POSTS.".".COL_CREATEDON, "desc");
        $res = $this->db->get($this->table)->result_array();
        return $res;
    }
}