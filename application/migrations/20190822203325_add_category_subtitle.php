<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_category_subtitle extends CI_Migration {
    
    public function up()
	{
        $field = array(
            'sub_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 127,
                'null' => TRUE,
                'default' => NULL,
                'after' => 'parent_id'
            ),
        );

        $this->dbforge->add_column('categories', $field);
    }

    public function down()
	{
        $this->dbforge->drop_column('categories', 'subtitle');
	}
}