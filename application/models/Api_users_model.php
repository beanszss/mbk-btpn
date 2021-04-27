<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_users_model extends CI_Model{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
      $this->load->library('SSP');
			$table = 'users';
			$primaryKey = 'id';
			$columns = array(
				array('db' => '`u`.`id`', 'dt' => 'id', 'field' => 'id', 'as' => 'id' ),
				array('db' => '`u`.`username`', 'dt' => 'username', 'field' => 'username', 'as' => 'username' ),
				array('db' => '`u`.`email`', 'dt' => 'email', 'field' => 'email', 'as' => 'email' ),
				array('db' => '`u`.`first_name`', 'dt' => 'first_name', 'field' => 'first_name', 'as' => 'first_name' ),
				array('db' => '`u`.`last_name`', 'dt' => 'last_name', 'field' => 'last_name', 'as' => 'last_name' ),
				array('db' => '`u`.`created_on`', 'dt' => 'created_on', 'field' => 'created_on', 'as' => 'created_on',
					'formatter' => function ($d, $row)
						{
							return date( 'd M Y', strtotime($d));
						} 
				),
				array('db' => '`u`.`active`', 'dt' => 'active', 'field' => 'active', 'as' => 'active'),
				array('db' => '`u`.`id`', 'dt' => 'actions', 'field' => 'actions', 'as' => 'actions'),
				array('db' => '`g`.`name`', 'dt' => 'access', 'field' => 'access', 'as' => 'access')
		);
		$sql_details = $this->configDB();
		$joinQuery = "FROM `users` AS `u` 
		LEFT JOIN `users_groups` AS `ug` ON (`ug`.`user_id` = `u`.`id`)
		LEFT JOIN `groups` AS `g` ON (`ug`.`group_id` = `g`.`id`)";
		return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery);
	}

	/**
	 * create
	 *
	 * @param  array $data
	 *
	 * @return void
	 */
	public function create()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		if (!empty($this->input->post('id_users'))) {
			if (!empty($this->input->post('password'))) {
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'active' => $this->input->post('status'),
					'password' => $this->input->post('password'),
				);
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'active' => $this->input->post('status'),
				);
			}

			$user_id = $this->input->post('id_users');
			$group_id = $this->input->post('access');
			$this->ion_auth->remove_from_group($group_id, $user_id);
			$this->ion_auth->remove_from_group(false, $user_id);
			$this->ion_auth->add_to_group($group_id, $user_id);

			return $this->ion_auth->update($this->input->post('id_users'), $data);
		} else {

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');

			if (!$this->ion_auth->email_check($email))
			{				
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
				);
				$group = array($this->input->post('access'));
				$this->ion_auth->register($username, $password, $email, $data, $group);
				return true;
			} else {
				return false;
			}
			
		}
	}

	/**
	 * update
	 *
	 * @param  array $data
	 * @param  integer $id
	 *
	 * @return void
	 */
	public function update($data, $id)
	{
		$data = array(
			'full_name' => $this->input->post('full_name'),
			'phone' => $this->input->post('phone'),
			'last_name' => $this->input->post('last_name'),
			'password' => $this->input->post('password')
			 );
		return  $this->ion_auth->update($id, $data);
	}

	/**
	 * getById
	 *
	 * @param  integer $id
	 *
	 * @return void
	 */
	public function getById($id)
	{
		$user['users'] = $this->ion_auth->user($id)->row();
		$group['access'] = $this->ion_auth->get_users_groups($user['users']->id)->row();

		return [$user, $group];
	}

	/**
	 * destroy
	 *
	 * @param  integer $id
	 *
	 * @return void
	 */
	public function destroy($id)
	{
		return $this->ion_auth->delete_user($id);
	}
	
	/**
	 * configDB
	 *
	 * @return array
	 */
	private function configDB()
	{
		$CI =& get_instance();
        $CI->load->database();

        return array(
            'user' => $CI->db->username,
            'pass' => $CI->db->password,
            'db'   => $CI->db->database,
            'host' => $CI->db->hostname
        );
	}
}
