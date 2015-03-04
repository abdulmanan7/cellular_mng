<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Payment extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(array(
			 'name'=>array(
			 	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			 ),// varchar(30) NOT NULL,
            'company_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null'=>FALSE
            ),
			 'is_enable'=>array(
			 	'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			 ),// tinyint(1) NOT NULL
					));
		$this->dbforge->create_table('tblpayment_methods',TRUE);
		$data = array(array(
			'name' => 'Cash',
			'company_id' => '1',
			'is_enable' => '1'
		), array(
            'company_id' => '1',
			'name' => 'Bank',
			'is_enable' => '1',
		));
		$this->db->insert_batch('tblpayment_methods', $data);
		$this->dbforge->add_field(array(
			'invoice_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			),
            'company_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null'=>FALSE
            ),
			 'transaction_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			),
					));
		$this->dbforge->create_table('tblpayment_invoice',TRUE);
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
			'customer_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			),
			 'amount'=>array(
			 	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			 ),// varchar(30) NOT NULL,
			 'type'=>array(
			 	'type' => 'TINYINT',
				'signed' => TRUE,
				'null' => FALSE,
				'constraint' => 1
			 ),// tinyint(1) NOT NULL,
			 'account'=>array(
			 	'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			 ),// tinyint(1) NOT NULL
			  'note'=>array(
			 	'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 256
			 ),// tinyint(1) NOT NULL,
			'time_stamp TIMESTAMP default CURRENT_TIMESTAMP', //timestamp NOT NULL default CURRENT_TIMESTAMP,
					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tbltransaction',TRUE);
	}
	public function down()
	{
		$this->dbforge->drop_table('tblpayment_methods');
		$this->dbforge->drop_table('tblpayment_invoice');
		$this->dbforge->drop_table('tbltransaction');
	}
}
