<?php

class m130512_183711_add_nameId_column extends EDbMigration
{
    public function up()
    {
        $this->addColumn('p3_page', 'nameId', 'VARCHAR(64)');
        $this->createIndex('p3_page_nameId_unique', 'p3_page', 'nameId', true);
    }

    public function down()
    {
        $this->dropColumn('p3_page', 'nameId');
    }
}