<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_product_subtitle extends CI_Migration {
    
    public function up()
	{
        $field = array(
            'sub_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 127,
                'null' => TRUE,
                'default' => NULL,
                'after' => 'price'
            ),
        );

        $this->dbforge->add_column('products', $field);
    }

    public function down()
	{
        $this->dbforge->drop_column('products', 'sub_title');
	}
}