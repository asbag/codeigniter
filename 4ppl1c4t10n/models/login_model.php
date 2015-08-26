<?php
class Login_model extends CI_Model {
	function validate() {
		$this->db->where('nic',$this->input->post('username'));
		$this->db->where('pass',md5($this->input->post('password')));
		//A checkbox to remember me after login
		$check_box = $this->input->post('rember_me');
		$query = $this->db->get('user');
		if ($query->num_rows == 1) {
			//Setup session
			foreach ($query->result() as $row) {
				//$user_level = $row->user_level;
				$username = $row->nic;
				$password = $row->pass;
				$id = $row->id;
				$first_name = $row->first;
				$last_name = $row->last;
				
				$data = array(
							'username' => $username,
							'id' => $id,
							'name' => $name,
							'user_level' => 1,
							'is_logged_in' => true
						);
				$this->session->set_userdata($data);
			}
			//if statement for remember me
			if ($check_box == "accept") {
				$value = array(
					'id' => $id,
					'username' => $username
				);
				$value = serialize($value);
				$cookie = array(
						'name' => 'loginuser',
						'value' => $value,
						'expire' => '2410000',
						'domain' => 'mysocialnetwork.es',
						'path'   => '/',
						'prefix' => '',
						'secure' => false
				);
				set_cookie($cookie);
			}
			return true;
		} else {
			return false;
		}
	}
}