<?php

class m121011_160518_fk_delete_cascade extends EDbMigration
{
    public function up()
    {
        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):

            $this->dropForeignKey('fk_p3_page_id', 'p3_page_meta');
            $this->addForeignKey('fk_p3_page_id', 'p3_page_meta', 'id', 'p3_page', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey(
                'fk_p3_page_meta_treeParent_id',
                'p3_page_meta',
                'treeParent_id',
                'p3_page_meta',
                'id',
                'RESTRICT',
                'RESTRICT'
            );
            $this->dropForeignKey('fk_p3_page_p3_page_id', 'p3_page_translation');
            $this->addForeignKey(
                'fk_p3_page_p3_page_id',
                'p3_page_translation',
                'p3_page_id',
                'p3_page',
                'id',
                'CASCADE',
                'CASCADE'
            );

        endif;
    }

    public function down()
    {
        echo "m121011_160518_fk_delete_cascade does not support migration down.\n";
        return false;
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