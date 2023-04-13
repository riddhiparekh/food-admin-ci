<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_categories extends CI_Migration {
    
    public function up()
	{
        $field = array(
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
                'default' => NULL,
                'after' => 'parent_id'
            ),
        );

        $this->dbforge->add_column('categories', $field);
    }

    public function down()
	{
        $this->dbforge->drop_column('categories', 'description');
	}
}