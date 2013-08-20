<?php

class m130820_161101_add_translation_timestamps extends EDbMigration
{
    public function up()
    {
        $this->addColumn('p3_page_translation','createdAt','DATETIME NOT NULL');
        $this->addColumn('p3_page_translation','modifiedAt','DATETIME NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('p3_page_translation','createdAt');
        $this->dropColumn('p3_page_translation','modifiedAt');
    }
}
