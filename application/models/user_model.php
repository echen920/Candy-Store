<?php
class User_model extends CI_Model{
	function getAll()
	{  
		$query = $this->db->get('customer');
		return $query->result();
	}  

	function getUser($id){
		$query = $this->db->get_where('customer', array('id'=>$id));
		return $query->row(0, 'Customer');
	}

	function getID($username){
		$query = $this->db->get_where('customer', array('login'=>$username));
		return $query->row()->id;
	}

	function createAccount($user) {
		return $this->db->insert("customer", array('login' => $user->username,
			'email' => $user->email, 'first' => $user->first, 'last' => $user->last, 'password' => $user->password));
	}

	function login($username, $password){

		$query = $this->db->get_where('customer', array('login'=>$username));

		if($query->num_rows() > 0){
			if ($query->row(0)->password == $password) {
				return true;
			} else { return false; }
			//return true;
		}else{
			return false;
		}
	}
	
	function delete($id) {
		return $this->db->delete('customer', array('id'=>$id));
	}

}
?>
