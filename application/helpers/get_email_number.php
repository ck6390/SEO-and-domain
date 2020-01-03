<?php 

 if (!function_exists('get_email_number')) {
	function get_email_number()
        {
            $ci = & get_instance();
            $ci->db->select('S.*');
            $ci->db->from('message_setting AS S');
            return $ci->db->get()->row();
        }
 }
