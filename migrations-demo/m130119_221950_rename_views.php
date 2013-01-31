<?php

class m130119_221950_rename_views extends EDbMigration
{
	public function up()
	{
		$this->update(
		    "p3_page", 
		    array(
			    "view" => "//p3pages/column2",
    		),
    		"view = '//p3pages/default'" 		
    	);
	}

	public function down()
	{
		$this->update(
		    "p3_page", 
		    array(
			    "view" => "//p3pages/default",
    		),
    		"view = '//p3pages/column2'"
    	);
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}