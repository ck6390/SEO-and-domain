<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_meta_tag($domain=null){       
       $str_domain = str_replace("www.","",$domain);
       $str_domain1 = str_replace("/","",$str_domain);
       // $str_domain = str_replace("http://www.","",$str_domain);
        $this->db->select('*');
        $this->db->from('f_tag'); 
        if(!empty($domain)){
            $this->db->like('domain',$str_domain1);
        }        
        $this->db->where('status','1');              
       return $this->db->get()->row();
    }

}