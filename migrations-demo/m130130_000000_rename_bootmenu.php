<?php

class m130119_000000_rename_bootmenu extends EDbMigration
{
	public function up()
	{
		$this->update(
		    "p3_page", 
		    array(
			    "layout" => "_TbNavbar",
    		),
    		"layout = '_BootMenu'"
    	);
	}

	public function down()
	{
        $this->update(
            "p3_page",
            array(
                 "layout" => "_BootMenu",
            ),
            "layout = '_TbNavbar'"
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