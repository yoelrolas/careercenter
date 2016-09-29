<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generator extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->load->view('generator/dbform');
    }
    function Generated(){
        $tables = $this->db->list_tables();
        $arrtables = array();
        $arrcols = array();

        foreach ($tables as $table) {
            $arrtables[] = array($table,"TBL_".strtoupper($table));
            $fields = $this->db->list_fields($table);
            foreach ($fields as $field) {
                $newfield = "COL_".strtoupper($field);
                if(!in_array(array($field,$newfield), $arrcols)){
                    $arrcols[] = array($field,$newfield);
                }
            }
        }

        echo "<textarea style='width:100%;height:100%'>";
        foreach ($arrtables as $table) {
            echo "define('".$table[1]."','".$table[0]."');"."\n";
        }
        echo "\n";
        foreach ($arrcols as $col) {
            echo "define('".$col[1]."','".$col[0]."');"."\n";
        }
        echo "</textarea>";
    }
    function GeneratedTruncate(){
        $tables = $this->db->list_tables();
        $arrtables = array();
        $arrcols = array();

        foreach ($tables as $table) {
            $arrtables[] = array($table,"TBL_".strtoupper($table));
            $fields = $this->db->list_fields($table);
            foreach ($fields as $field) {
                $newfield = "COL_".strtoupper($field);
                if(!in_array(array($field,$newfield), $arrcols)){
                    $arrcols[] = array($field,$newfield);
                }
            }
        }

        echo "<textarea style='width:100%;height:100%'>";
        foreach ($arrtables as $table) {
            echo "TRUNCATE `".$table[0]."`;"."\n";
        }
        echo "</textarea>";
    }
    function controllers(){
        $this->load->helper('directory');
        $map = directory_map('./application/controllers/');
        #print_r($map);
        echo "<textarea style='width:100%;height:100%'>";
        foreach ($map as $file) {
            if(is_array($file)){
                continue;
            }
            if(strpos($file,'.php') !== FALSE){
                echo "'".str_replace('.php','',$file)."',\n";
            }
        }
        echo "</textarea>";
    }
}
