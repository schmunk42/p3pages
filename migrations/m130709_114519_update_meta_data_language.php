<?php

class m130709_114519_update_meta_data_language extends EDbMigration
{
    public function safeUp()
    {
        $this->update('p3_page_meta', array('language' => '*'), 'language = "_ALL"');
    }

    public function safeDown()
    {
        $this->update('p3_page_meta', array('language' => '_ALL'), 'language = "*"');
    }
}