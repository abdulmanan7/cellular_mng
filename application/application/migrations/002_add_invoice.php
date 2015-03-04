<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_invoice extends CI_Migration
{
	public function up()
	{
		//Table Structure for table 'tblcompany'

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'null' => FALSE, //not nulll
                'constraint' => 100
            ),
            'attn_name' => array(
                'type' => 'VARCHAR',
                'null' => TRUE, //nulll
                'constraint' => 60
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 60
            ),
            'address1' => array(
                'type' => 'VARCHAR',
                'null' => FALSE, //not nulll
                'constraint' => 512
            ),
            'address2' => array(
                'type' => 'VARCHAR',
                'default' => null,
                'constraint' => 512
            ), 'city' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 50
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 50
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 50
            ),
            'postcode' => array(
                'type' => 'VARCHAR',
                'null' => FALSE, // not nulll
                'constraint' => 50
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => 15
            ),
            'fax' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => 15
            ),
            'registration_no' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => 60
            ),
            'VAT_no' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => 60
            ),
            'footer_notes' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'logo' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'default' => '_assets/img/logo.png',
                'constraint' => 256
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tblcompany', TRUE);
		//Addding defaults values
		$data = array(
    		'id' =>1,
            'name' => 'Company Name',
            'attn_name' => 'John Doe',
            'email' => 'admin@admin.com',
            'address1' => 'Office 03 Street 31',
            'address2' => '',
            'city' => 'Birmingham',
            'state' => '',
            'country' => 'United Kingdom',
            'postcode' => 'b38 4et',
            'phone' => '+44123123123',
			'fax' => '09100012000',
            'registration_no' => '',
            'VAT_no' => '',
            'footer_notes' => '',
			'logo' => '_assets/images/logo.png'
		);
		$this->db->insert('tblcompany', $data);
		//Table Structure for table 'Currency'
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
				'constraint' => '11',
				'null'=>FALSE,
				'unsigned' => TRUE,
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null'=>FALSE,
			),
			'code' => array(
				'type' => 'VARCHAR',
				'constraint' => 3,
				'null'=>FALSE,
			),
			'symbol_left' => array(
				'type' => 'VARCHAR',
				'constraint' => 12,
				'null'=>TRUE,
			),
			'symbol_right' => array(
				'type' => 'VARCHAR',
				'constraint' => 12,
				'null'=>TRUE,
			),
			'decimal_place' => array(
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null'=>TRUE,
			),
			'value' => array(
				'type' => 'DECIMAL',
				'constraint' => '15,8',
				'null'=>FALSE,
			),
			'status' => array(
				'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			),
			'default' => array(
				'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			),
			'date_modified' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
				'default' =>'0000-00-00 00:00:00',
			),
					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblcurrency',TRUE);
		//Addding defaults values
		$data = array(
			'id'=>'1',
			'title'=>'USD',
			'company_id'=>'1',
			'code'=>'ANY001',
			'symbol_left'=>'$',
			'symbol_right'=>'USD',
			'decimal_place'=>'1.0000000',
			'value'=>'1',
			'status'=>'1',
			'default'=>'1',

			'date_modified'=>'2014-12-19 14:10:54'
		);
		$this->db->insert('tblcurrency', $data);
		//Table Structure for table 'tblcustomer'
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
				'constraint' => '11',
				'null'=>FALSE,
				'unsigned' => TRUE,
			),
			'company_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 512,
				'null'=>TRUE,
				'default'=>null
			),
			'name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			),
			'attn_name' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 60
			),
            'address1' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 512
			),
            'address2' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 512
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 50
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 50
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => 50
            ),
            'postcode' => array(
                'type' => 'VARCHAR',
                'null' => FALSE, // not nulll
                'constraint' => 50
            ),
			'phone' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 15
			),
			'email' => array(
				'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 40
			)
					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblcustomer',TRUE);
		//Addding defaults values
		$data = array(

            'id' => '1',
            'company_name' => 'Ithinq',
            'company_id' => '1',
            'name' => 'Abdul Manan',
            'attn_name' => 'AD3309B',
            'address1' => 'Terah Bagh Medain Pakistan',
            'address2' => 'Peshawar Saddar',
            'city' => 'Bagh',
            'state' => 'KPK',
            'country' => 'Pakistan',
            'postcode' => '2544NA',
            'phone' => '034554210120',
			'email'=>'admin@example.com'
		);
		$this->db->insert('tblcustomer', $data);
		//Table Structure for table 'tblinvoice'
		$this->dbforge->add_field(array(
		  'id'=>array(
			  	'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'null'=>FALSE
		  	),
		  'customer_id'=>array(
			  	'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
				),
		  'currency_id'=>array(
			  	'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
          ),
		  'company_id'=>array(
			  	'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
				),
		  'company_name'=>array(
		  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 100
		  	),
		  'company_attn_name'=>array(
		  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
				),
		  'company_address1'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 512
				), //varchar(512) NOT NULL,
		  'company_address2'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 512
		  	),// varchar(512) default NULL,

            'company_postcode' => array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 10
		  	), //varchar(10) default NULL,
		  'company_email'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
		  	), //varchar(60) NOT NULL,
		  'company_phone'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 15
		  	), //varchar(15) NOT NULL,
		  'company_fax'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 15
		  ), //varchar(15) default NULL,
		  'company_registration_no'=>array(
			    'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 60
				), //varchar(60) NOT NULL,
		  'company_VAT_no'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 60
		  ), //varchar(60) NOT NULL,
		  'customer_company_name'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 512
		  ), //varchar(512) default NULL,
		  'customer_name'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
		  ), //varchar(60) NOT NULL,
		  'customer_attn_name'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
		  ), //varchar(60) NOT NULL,
		  'customer_address'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 512
		  ), //varchar(512) NOT NULL,
		  'customer_phone'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 15
		  ), //varchar(15) NOT NULL,
		  'customer_email'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 40
		  ), //varchar(40) NOT NULL,
		  'currency_name'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 30
		  ), //varchar(30) NOT NULL,
		  'currency_symbol_left'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 12
		  ), //varchar(12) NOT NULL,
		  'currency_symbol_right'=>array(
		  		'type' => 'VARCHAR',
				'null' => TRUE,
				'constraint' => 12
		  ), //varchar(12) NOT NULL,
		  'total'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
		  ), //varchar(60) NOT NULL,
		  'subtotal'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
		  ), //varchar(60) NOT NULL,
		  'totaltax'=>array(
		  		'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
		  ), //varchar(60) NOT NULL,
		  'current_time_stamp TIMESTAMP default CURRENT_TIMESTAMP', //timestamp NOT NULL default CURRENT_TIMESTAMP,
		  'last_modified_ts'=>array(
		  		'type' => 'DATETIME',
				'null' => FALSE,
				'default' =>'0000-00-00 00:00:00',
		  ),// datetime NOT NULL default '0000-00-00 00:00:00'
					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblinvoice',TRUE);

		//Table Structure for table 'tblinvoice_details'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'null'=>FALSE
			),
			  'invoice_id'=>array(
			  	'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			  ),// int(11) NOT NULL,
			  'product_id'=>array(
		  		'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			  ),// int(11) NOT NULL,
			  'product_name'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			  ),// varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
			  'price'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 20
			  ),// varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
			  'quantity'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 20
			  ),// varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
			  'tax_type_id'=>array(
			  	'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'null'=>FALSE
			  ),// int(11) NOT NULL,
			  'tax_type_name'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			  ),// varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
			  'tax_type_percentage'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 20
			  ),// varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
			  'product_description'=>array(
			  	'type' => 'TEXT',
				'null' => TRUE,
			  ),// varchar(512) COLLATE utf8mb4_unicode_ci default NULL,
			  'product_total'=>array(
			  	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			  ),// varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL

        ));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblinvoice_details',TRUE);
		//Table Structure for table 'tblproducts'
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
				'constraint' => '11',
				'null'=>FALSE,
				'unsigned' => TRUE,
			),
			 'name'=>array(
			 	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			 ),// varchar(30) NOT NULL,
			 'type'=>array(
			 	'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
			 ),// tinyint(2) NOT NULL,
			 'price'=>array(
			 	'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
			 ),// varchar(10) NOT NULL
			 'notes'=>array(
		 		'type' => 'TEXT',
				'null' => TRUE,
			 ),// varchar(256) NOT NULL default 'No Notes Added Yet.',

        ));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblproducts',TRUE);
		// Dumping data for table 'users_groups'
			$data = array(
				array(
					'id' => '1',
					'company_id'=>'1',
					'name' => 'Banana',
					'type' => '2',
					'price' => '140',
					'notes' => 'Good friut of all seasons.',
				),
				array(
					'id' => '2',
					'company_id'=>'1',
					'name' => 'Dell Laptop',
					'type' => '2',
					'price' => '56000',
					'notes' => 'Core i5 ,4GB of Ram ,1TB hard Drive ,1 Year Local Warrenty',
				),
				array(
					'id' => '3',
					'company_id'=>'1',
					'name' => 'Rent A car Management System',
					'type' => '1',
					'price' => '5000',
					'notes' => 'User Friendly Easy to use with 3 months Support.',
				)
			);
		$this->db->insert_batch('tblproducts', $data);
		//Table Structure for table 'tbltaxtype'
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
				'constraint' => '11',
				'null'=>FALSE,
				'unsigned' => TRUE,
			),
			'name' => array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 50
			),
			'percentage' => array(
				'type' => 'DECIMAL',
				'null' => FALSE,
				'constraint' => '10,2'
			),
					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tbltaxtype',TRUE);
		//Addding defaults values
		$data = array(
			array(
				'id' => '1',
				'company_id'=>'1',
				'name' => 'VAT-15%',
				'percentage' => '15.00'
			),
			array(
				'id' => '2',
				'company_id'=>'1',
				'name' => 'Sale Tax 20%',
				'percentage' => '20.00'
			)
		);
		$this->db->insert_batch('tbltaxtype', $data);

        //Table Structure for table 'tblaccount'
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
				'constraint' => '11',
				'null'=>FALSE,
				'unsigned' => TRUE,
			),
			'name'=>array(
				'type' => 'VARCHAR',
				'null' => FALSE,
				'constraint' => 60
				), //varchar(60) NOT NULL,
			'status'=>array(
					'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
				), //tinyint(1) NOT NULL,
			'system_acc'=>array(
					'type' => 'TINYINT',
				'null' => FALSE,
				'constraint' => 1
				), //tinyint(1) NOT NULL
					));
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('tblaccount',TRUE);
		//Addding defaults values
		$data = array(
			array(
			'id'=>'1',
			'company_id'=>'1',
			'name'=>'Investment',
			'status'=>'1' ,
			'system_acc'=>'1'
			),
			array(
			'id'=>'2',
			'company_id'=>'1',
			'name'=>'Invoice',
			'status'=>'1' ,
			'system_acc'=>'1'
			),
			array(
			'id'=>'3',
			'company_id'=>'1',
			'name'=>'Payment',
			'status'=>'1' ,
			'system_acc'=>'1'
			),
			array(
			'id'=>'4',
			'company_id'=>'1',
			'name'=>'Expense',
			'status'=>'1' ,
			'system_acc'=>'0'
			)
		);
		$this->db->insert_batch('tblaccount', $data);

    }
	public function down()
	{
		$this->dbforge->drop_table('tblcompany');
		$this->dbforge->drop_table('tblcurrency');
		$this->dbforge->drop_table('tblcustomer');
		$this->dbforge->drop_table('tblinvoice');
		$this->dbforge->drop_table('tblinvoice_details');
		$this->dbforge->drop_table('tblproducts');
		$this->dbforge->drop_table('tbltaxtype');
		$this->dbforge->drop_table('tblaccount');
	}
}
