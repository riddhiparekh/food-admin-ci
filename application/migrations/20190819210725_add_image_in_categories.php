<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_image_in_categories extends CI_Migration {
    
    public function up()
	{
        $field = array(
            'image' => array(
                'type' => 'CHAR',
                'constraint' => 63,
                'null' => TRUE,
                'default' => NULL,
                'after' => 'description'
            ),
        );

        $this->dbforge->add_column('categories', $field);
    }

    public function down()
	{
        $this->dbforge->drop_column('categories', 'image');
	}
}