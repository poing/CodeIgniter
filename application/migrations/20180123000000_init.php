<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_init extends CI_Migration {

        public function up()
        {
        
			if ($this->config->item('sess_driver') == 'database') {
		
				$table = $this->config->item('sess_save_path');
        
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '128',
                                'null' => FALSE,
                        ),
                        'ip_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'null' => FALSE,
                        ),
                        'timestamp' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
								'default' => 0,
                                'null' => FALSE,
                        ),
                        'data' => array(
                                'type' => 'blob',
                                'null' => FALSE,
                        ),

                ));
                
                $this->dbforge->add_key('timestamp', FALSE);
                $this->dbforge->create_table($table);
	        }
        }

        public function down()
        {
        	$this->load->dbutil();
			$table = $this->config->item('sess_save_path');
			
			if ($this->db->table_exists($table)) {
				$this->dbforge->drop_table($table);
			}
        }
}
