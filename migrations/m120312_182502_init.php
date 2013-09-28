<?php

class m120312_182502_init extends CDbMigration
{

    public function up()
    {
        if ($this->dbConnection->schema instanceof CMysqlSchema)
            $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        else {
            $options = '';
        }


        // Schema for table 'p3_page'

        $this->createTable(
            "p3_page",
            array(
                 "id"     => "pk",
                 "layout" => "varchar(128)",
                 "view"   => "varchar(128)",
                 "route"  => "varchar(255)",

            ),
            $options
        );


        // Foreign Keys for table 'p3_page'

        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):

        endif;


        // Schema for table 'p3_page_meta'

        $this->createTable(
            "p3_page_meta",
            array(
                 "id"                => "int(11) NOT NULL",
                 "status"            => "int(11)",
                 "type"              => "varchar(64)",
                 "language"          => "varchar(8)",
                 "treeParent_id"     => "int(11)",
                 "treePosition"      => "int(11)",
                 "begin"             => "datetime",
                 "end"               => "datetime",
                 "keywords"          => "text",
                 "customData"        => "text",
                 "label"             => "int(11)",
                 "owner"             => "varchar(64)",
                 "checkAccessCreate" => "varchar(256)",
                 "checkAccessRead"   => "varchar(256)",
                 "checkAccessUpdate" => "varchar(256)",
                 "checkAccessDelete" => "varchar(256)",
                 "createdAt"         => "timestamp NOT NULL",
                 "createdBy"         => "varchar(64)",
                 "modifiedAt"        => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
                 "modifiedBy"        => "varchar(64)",
                 "guid"              => "varchar(64)",
                 "ancestor_guid"     => "varchar(64)",
                 "model"             => "varchar(128)",
                 "PRIMARY KEY (id)"
            ),
            $options
        );


        // Foreign Keys for table 'p3_page_meta'

        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):

            $this->addForeignKey(
                'fk_p3_page_id',
                'p3_page_meta',
                'id',
                'p3_page',
                'id',
                null,
                null
            ); // update 'null' for ON DELTE and ON UPDATE

        endif;


        // Data for table 'p3_page_meta'


        // Schema for table 'p3_page_translation'

        $this->createTable(
            "p3_page_translation",
            array(
                 "id"          => "pk",
                 "p3_page_id"  => "int(11) NOT NULL",
                 "language"    => "varchar(8)",
                 "seoUrl"      => "varchar(255)",
                 "pageTitle"   => "varchar(255)",
                 "menuName"    => "varchar(128) NOT NULL",
                 "keywords"    => "text",
                 "description" => "text",

            ),
            $options
        );


        // Foreign Keys for table 'p3_page_translation'

        if (($this->dbConnection->schema instanceof CSqliteSchema) == false):

            $this->addForeignKey(
                'fk_p3_page_p3_page_id',
                'p3_page_translation',
                'p3_page_id',
                'p3_page',
                'id',
                null,
                null
            ); // update 'null' for ON DELTE and ON UPDATE

        endif;


        // Data for table 'p3_page_translation'


    }

    public function down()
    {
        echo 'Migration down not supported.';
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

?>
