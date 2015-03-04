<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Project_management extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null'=>FALSE
            ),
			'invoice_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			),
			'invoice_statuses_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			),
			 'comment'=>array(
			 	'type' => 'VARCHAR',
				'null' => TRUE,
				'default'=>'no comment attached',
				'constraint' => 256
			 ),// varchar(30) NOT NULL,
			 'time_stamp TIMESTAMP default CURRENT_TIMESTAMP', //timestamp NOT NULL default CURRENT_TIMESTAMP,
					));
        $this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblinvoice_status',TRUE);
		// Dumping data for table 'users_groups'

		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'null'=>FALSE
			),
			'company_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			),
			 'name'=>array(
			 	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			 ),// varchar(30) NOT NULL,
			 'is_system'=>array(
			 	'type' => 'TINYINT',
				'null' => FALSE,
				'default' => 0,
				'constraint' => 1
			 ),// tinyint(1) NOT NULL,
			 'is_enable'=>array(
			 	'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			 ),// tinyint(1) NOT NULL
			  'is_default'=>array(
			 	'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			 ),// tinyint(1) NOT NULL,

					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblinvoice_statuses',TRUE);
		// Dumping data for table 'users_groups'
		$data = array(
            array(
    		'id' =>1,
			'company_id' => 1,
			'name' => 'Paid',
			'is_default' => '0',
			'is_enable' => '1',
			'is_system' => '1'
		    ),
            array(
            'id' =>2,
            'company_id' => 1,
            'name' => 'Partially Paid',
            'is_default' => '0',
            'is_enable' => '1',
            'is_system' => '1'
            ),
            array(
            'id' =>3,
            'company_id' => 1,
            'name' => 'Pending',
            'is_default' => '1',
            'is_enable' => '1',
            'is_system' => '1'
            )
        );
		$this->db->insert_batch('tblinvoice_statuses', $data);
		//Table Structure for table 'Currency'
	}
	public function down()
	{
		$this->dbforge->drop_table('tblinvoice_status');
		$this->dbforge->drop_table('tblinvoice_statuses');
	}
}
