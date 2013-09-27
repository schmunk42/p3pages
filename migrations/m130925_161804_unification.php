<?php

class m130925_161804_unification extends EDbMigration
{
    public function up()
    {
        if (Yii::app()->db->schema instanceof CMysqlSchema) {
            $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
            $options = '';
        }

        if (Yii::app()->db->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        }


        $this->createTable(
            "p3_page_v0_17",
            array(
                 "id"                  => "pk",
                 "name_id"             => "VARCHAR(64)",
                 "layout"              => "varchar(128)",
                 "view"                => "varchar(128)",
                 "url_json"            => "varchar(255)",
                 "custom_data_json"    => "text",
                 // mikehaertl/translatable (defaults)
                 "default_page_name"   => "varchar(255)",
                 "default_page_title"  => "varchar(255)",
                 "default_menu_name"   => "varchar(128) NOT NULL",
                 "default_keywords"    => "text",
                 "default_description" => "text",
                 // yiiext/status-behavior
                 "status"              => "int(4) NOT NULL",
                 // schmunk42/adjacency-list-behavior
                 "tree_parent_id"      => "int(11)",
                 "tree_position"       => "int(11)",
                 // schmunk42/yii-access
                 "access_owner"        => "varchar(64)",
                 "access_domain"       => "varchar(8)", // * DOMAIN ????
                 "access_read"         => "varchar(256)",
                 "access_update"       => "varchar(256)",
                 "access_delete"       => "varchar(256)",
                 "access_append"       => "varchar(256)",
                 // time
                 "created_at"          => "timestamp",
                 "modified_at"         => "timestamp",
                 // copy behavior
                 "copied_from_id"      => "int(11)",
                 "FOREIGN KEY(tree_parent_id) REFERENCES p3_page_v0_17(id) ON DELETE RESTRICT ON UPDATE CASCADE",
            ),
            $options
        );

        // Schema for table 'p3_page_translation'
        $this->createTable(
            "p3_page_translation_v0_17",
            array(
                 "id"          => "pk",
                 "p3_page_id"  => "int(11) NOT NULL REFERENCES p3_page_v0_17(id)",
                 "language"    => "varchar(8)",
                 "page_name"   => "varchar(255)",
                 "page_title"  => "varchar(255)",
                 "menu_name"   => "varchar(128) NOT NULL",
                 "keywords"    => "text",
                 "description" => "text",
                 "FOREIGN KEY(p3_page_id) REFERENCES p3_page_v0_17(id) ON DELETE CASCADE ON UPDATE CASCADE"
            ),
            $options
        );

        $this->createIndex('p3_page_name_id_unique', 'p3_page_v0_17', 'name_id', true);

        $sqlStatement = "SELECT p3_page.*, p3_page_meta.*,
          p3_page_translation.seoUrl, p3_page_translation.pageTitle, p3_page_translation.menuName, p3_page_translation.keywords, p3_page_translation.description
            FROM p3_page
            LEFT JOIN p3_page_meta ON p3_page_meta.id = p3_page.id
            LEFT JOIN p3_page_translation ON p3_page_translation.p3_page_id =
              (SELECT
                MIN(p3_page_translation.p3_page_id)
                FROM p3_page_translation
                WHERE p3_page_translation.p3_page_id = p3_page.id)";
        $command      = $this->dbConnection->createCommand($sqlStatement);
        $command->execute();
        $reader = $command->query();
        foreach ($reader as $row) {
            #var_dump($row);
            $this->insert(
                "p3_page_v0_17",
                array(
                     "id"               => $row['id'],
                     "name_id"             => $row['nameId'],
                     "layout"              => $row['layout'],
                     "view"                => $row['view'],
                     "url_json"            => $row['route'],
                     "custom_data_json"    => $row['customData'],
                     // mikehaertl/translatable (defaults)
                     "default_page_name"   => $row['seoUrl'],
                     "default_page_title"  => $row['pageTitle'],
                     "default_menu_name"   => ($row['menuName'])?$row['menuName']:'Page',
                     "default_keywords"    => $row['keywords'],
                     "default_description" => $row['description'],
                     // yiiext/status-behavior
                     "status"              => $row['status'],
                     // schmunk42/adjacency-list-behavior
                     "tree_parent_id"      => $row['treeParent_id'],
                     "tree_position"       => $row['treePosition'],
                     // schmunk42/yii-access
                     "access_owner"        => $row['owner'],
                     "access_domain"       => $row['language'],
                     "access_read"         => $row['checkAccessRead'],
                     "access_update"       => $row['checkAccessUpdate'],
                     "access_delete"       => $row['checkAccessDelete'],
                     "access_append"       => $row['checkAccessUpdate'],
                     // time
                     "created_at"          => $row['createdAt'],
                     "modified_at"         => $row['modifiedAt'],
                     // copy behavior
                     "copied_from_id"      => null,
                )
            );
        }


        $this->renameTable('p3_page_translation', 'p3_page_translation_v0_16');
        $this->renameTable('p3_page_meta', 'p3_page_meta_v0_16');
        $this->renameTable('p3_page', 'p3_page_v0_16');

        $this->renameTable('p3_page_v0_17', 'p3_page');
        $this->renameTable('p3_page_translation_v0_17', 'p3_page_translation');

        if (Yii::app()->db->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
        }

        echo "*** IMPORTANT NOTICE ***";
        echo "The existing p3_page tables were renamed to p3_page...v0_16";
    }

    public function down()
    {
        if (Yii::app()->db->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        }

        $this->dropTable('p3_page_translation');
        $this->dropTable('p3_page');

        $this->renameTable('p3_page_v0_16', 'p3_page');
        $this->renameTable('p3_page_meta_v0_16', 'p3_page_meta');
        $this->renameTable('p3_page_translation_v0_16', 'p3_page_translation');

        if (Yii::app()->db->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
        }
    }
}