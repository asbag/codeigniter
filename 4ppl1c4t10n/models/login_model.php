<?php
class Login_model extends CI_Model {
	function validate() {
		$this->db->where('nic',$this->input->post('username'));
		$this->db->where('pass',md5($this->input->post('password')));
		//A checkbox to remember me after login
		$check_box = $this->input->post('rember_me');
		$query = $this->db->get('user');
		if ($query->num_rows == 1) {
			
		}
	}
}