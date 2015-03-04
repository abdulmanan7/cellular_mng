<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Migration_Add_default extends CI_Migration {  
	public function up()
	{
			//Table Structure for table 'access_control'
				$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'null'=>FALSE
			),
			'group_id' => array(
				'type' => 'INT',
				'constraint' => 100,
				'null'=>FALSE,
				'Default'=>2
			),
			'controller' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			),
			'method' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			),
		));

		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('access_control',TRUE);
		$data = array(
			array(
				'group_id' => '1',
				'controller' => 'auth',
				'method' => '*'
			),
			array(
				'group_id' => '1',
				'controller' => 'company',
				'method' => '*'
			)
		);
		$this->db->insert_batch('access_control', $data);
			// Table structure for table 'groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'company_id' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('groups',TRUE);
		// Dumping data for table 'groups'
		$data = array(
			array(
				'id' => '1',
				'company_id'=>'1',
				'name' => 'admin',
				'description' => 'Administrator'
			),
			array(
				'id' => '2',
				'company_id'=>'1',
				'name' => 'members',
				'description' => 'General User'
			)
		);
		$this->db->insert_batch('groups', $data);

			// Table structure for table 'users'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'company_id' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null'=>FALSE,
				'unsigned' => TRUE,
			),
			'ip_address' => array(
				'type' => 'VARBINARY',
				'constraint' => '16'
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '80',
			),
			'salt' => array(
				'type' => 'VARCHAR',
				'constraint' => '40'
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'activation_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'forgotten_password_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'forgotten_password_time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'remember_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => TRUE
			),
			'created_on' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
			),
			'last_login' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'active' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'unsigned' => TRUE,
				'null' => TRUE
			),
			'first_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			'company' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			),
			'phone' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			)

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users',TRUE);

		// Dumping data for table 'users'
		$data = array(
					array(
					'id' => '1',
					'company_id'=>'1',
					'ip_address' => 0x7f000001,
					'username' => 'administrator',
					'password' => '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4',
					'salt' => '9462e8eee0',
					'email' => 'admin@admin.com',
					'activation_code' => '',
					'forgotten_password_code' => NULL,
					'created_on' => '1268889823',
					'last_login' => '1268889823',
					'active' => '1',
					'first_name' => 'Admin',
					'last_name' => 'istrator',
					'company' => 'ADMIN',
					'phone' => '0',
					),
					array(
						'id' => '2',
						'company_id'=>'1',
						'ip_address' => 0x7f000001,
						'username' => 'admin',
						'password' => '$2y$08$oJS8/132sr1rb7wNjr3dq.Uwcfi.Ca86h4ix57L7VWuoned1ggG.K',
						'salt' => NULL,
						'email' => 'admin',
						'activation_code' => '',
						'forgotten_password_code' => NULL,
						'created_on' => '1268889823',
						'last_login' => '1268889823',
						'active' => '1',
						'first_name' => 'Admin',
						'last_name' => 'istrator',
						'company' => 'ADMIN',
						'phone' => '00',
						)
		);
		$this->db->insert_batch('users', $data);
			// Table structure for table 'users_groups'
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'MEDIUMINT',
					'constraint' => '8',
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'user_id' => array(
					'type' => 'MEDIUMINT',
					'constraint' => '8',
					'unsigned' => TRUE
				),
				'group_id' => array(
					'type' => 'MEDIUMINT',
					'constraint' => '8',
					'unsigned' => TRUE,
				)
			));
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('users_groups',TRUE);

			// Dumping data for table 'users_groups'
			$data = array(
				array(
					'id' => '1',
					'user_id' => '1',
					'group_id' => '1',
				),
				array(
					'id' => '2',
					'user_id' => '1',
					'group_id' => '2',
				)
			);
		$this->db->insert_batch('users_groups', $data);
		// Table structure for table 'login_attempts'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type' => 'VARBINARY',
				'constraint' => '16'
			),
			'login' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null', TRUE
			),
			'time' => array(
				'type' => 'INT',
				'constraint' => '11',
				'unsigned' => TRUE,
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('login_attempts',TRUE);
	}
	public function down()
	{
		$this->dbforge->drop_table('access_control');
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('groups');
		$this->dbforge->drop_table('users_groups');
		$this->dbforge->drop_table('login_attempts');
	}
}
