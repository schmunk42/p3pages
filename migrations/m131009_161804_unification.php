<?php

class m131009_161804_unification extends EDbMigration
{
    public function up()
    {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
            $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
            $options = '';
        }

        if ($this->dbConnection->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        }

        // new statuses: 'draft', 'published', 'archived'
        $statusMap = array(
            0  => 'archived',
            10 => 'draft',
            20 => 'draft',
            30 => 'published',
            40 => 'published',
            50 => 'archived',
            60 => 'archived'
        );

        $this->createTable(
             "_p3_page_v0_17",
                 array(
                      "id"                  => "pk",
                      // mikehaertl/translatable (defaults)
                      "default_menu_name"   => "varchar(128) NOT NULL",
                      // yiiext/status-behavior
                      "status"              => "varchar(32) NOT NULL",
                      //
                      "name_id"             => "VARCHAR(64)",
                      // schmunk42/adjacency-list-behavior
                      "tree_parent_id"      => "int(11)",
                      "tree_position"       => "int(11)",
                      // mikehaertl/translatable (defaults)
                      "default_page_title"  => "varchar(255)",
                      // p3page
                      "layout"              => "varchar(128)",
                      "view"                => "varchar(128)",
                      "url_json"            => "text",
                      //
                      "default_url_param"   => "varchar(255)",
                      "default_keywords"    => "text",
                      "default_description" => "text",
                      // p3page
                      "custom_data_json"    => "text",
                      // schmunk42/yii-access
                      "access_owner"        => "varchar(64) NOT NULL",
                      "access_domain"       => "varchar(8) NOT NULL",
                      "access_read"         => "varchar(256)",
                      "access_update"       => "varchar(256)",
                      "access_delete"       => "varchar(256)",
                      "access_append"       => "varchar(256)",
                      // copy behavior
                      "copied_from_id"      => "int(11)",
                      // time
                      "created_at"          => "datetime NULL DEFAULT NULL",
                      "updated_at"          => "datetime NULL DEFAULT NULL",
                      "FOREIGN KEY(tree_parent_id) REFERENCES _p3_page_v0_17(id) ON DELETE RESTRICT ON UPDATE CASCADE",
                 ),
                 $options
        );

        // Schema for table 'p3_page_translation'
        $this->createTable(
             "_p3_page_translation_v0_17",
                 array(
                      "id"             => "pk",
                      "p3_page_id"     => "int(11) NOT NULL",
                      "language"       => "varchar(8) NOT NULL",
                      "menu_name"      => "varchar(128) NOT NULL",
                      // yiiext/status-behavior
                      "status"         => "varchar(32) NOT NULL",
                      // mikehaertl/translatable (defaults)
                      "page_title"     => "varchar(255)",
                      "url_param"      => "varchar(255)",
                      "keywords"       => "text",
                      "description"    => "text",
                      // schmunk42/yii-access
                      "access_owner"   => "varchar(64) NOT NULL",
                      #"access_domain"       => "varchar(8)", // * DOMAIN ????
                      "access_read"    => "varchar(256)",
                      "access_update"  => "varchar(256)",
                      "access_delete"  => "varchar(256)",
                      #"access_append"       => "varchar(256)",
                      // copy behavior
                      "copied_from_id" => "int(11)",
                      // time
                      "created_at"     => "datetime NULL DEFAULT NULL",
                      "updated_at"     => "datetime NULL DEFAULT NULL",
                      "FOREIGN KEY(p3_page_id) REFERENCES _p3_page_v0_17(id) ON DELETE CASCADE ON UPDATE CASCADE"
                 ),
                 $options
        );

        $this->createIndex('p3_page_name_id_unique', '_p3_page_v0_17', 'name_id', true);
        $this->createIndex(
             'p3_page_translation_id_language_unique',
                 '_p3_page_translation_v0_17',
                 'p3_page_id, language',
                 true
        );

        // JOIN all three existing tables, use the first translation as default values
        $sqlStatement = "SELECT p3_page_meta.*, p3_page.*,
          p3_page_translation.seoUrl, p3_page_translation.pageTitle, p3_page_translation.menuName, p3_page_translation.keywords, p3_page_translation.description
            FROM p3_page
            LEFT JOIN p3_page_meta ON p3_page_meta.id = p3_page.id
            LEFT JOIN p3_page_translation ON p3_page_translation.p3_page_id =
              (SELECT
                MIN(p3_page_translation.p3_page_id)
                FROM p3_page_translation
                WHERE p3_page_translation.p3_page_id = p3_page.id)
            GROUP BY p3_page.id;";
        $command      = $this->dbConnection->createCommand($sqlStatement);
        $command->execute();
        $reader = $command->query();
        $owner  = array();
        foreach ($reader as $row) {
            #var_dump($row);

            $owner[$row['id']]  = ($row['owner']) ? $row['owner'] : 1;
            $status[$row['id']] = ($row['status']) ? $statusMap[$row['status']] : 'draft';

            $this->insert(
                 "_p3_page_v0_17",
                     array(
                          "id"                  => $row['id'],
                          "name_id"             => $row['nameId'],
                          // mikehaertl/translatable (defaults)
                          "default_menu_name"   => ($row['menuName']) ? $row['menuName'] : 'Page',
                          "default_page_title"  => $row['pageTitle'],
                          "default_url_param"   => $row['seoUrl'],
                          // core-data
                          "layout"              => $row['layout'],
                          "view"                => $row['view'],
                          "url_json"            => $row['route'],
                          "custom_data_json"    => $row['customData'],
                          // yiiext/status-behavior
                          "status"              => $status[$row['id']],
                          // mikehaertl/translatable (defaults)
                          "default_keywords"    => $row['keywords'],
                          "default_description" => $row['description'],
                          // schmunk42/adjacency-list-behavior
                          "tree_parent_id"      => $row['treeParent_id'],
                          "tree_position"       => $row['treePosition'],
                          // schmunk42/yii-access
                          "access_owner"        => $owner[$row['id']],
                          "access_domain"       => ($row['language']) ? $row['language'] : '*',
                          "access_read"         => $row['checkAccessRead'],
                          "access_update"       => $row['checkAccessUpdate'],
                          "access_delete"       => $row['checkAccessDelete'],
                          "access_append"       => $row['checkAccessUpdate'],
                          // copy behavior
                          "copied_from_id"      => null,
                          // time
                          "created_at"          => ($row['createdAt'] && $row['createdAt'] != '0000-00-00 00:00:00') ?
                                  $row['createdAt'] : null,
                          "updated_at"          => ($row['modifiedAt'] && $row['modifiedAt'] != '0000-00-00 00:00:00') ?
                                  $row['modifiedAt'] : null,
                     )
            );

        }

        $sqlStatement = "SELECT * FROM p3_page_translation";
        $command      = $this->dbConnection->createCommand($sqlStatement);
        $command->execute();
        $reader = $command->query();
        foreach ($reader as $row) {
            #var_dump($row);
            $this->insert(
                 "_p3_page_translation_v0_17",
                     array(
                          "id"           => $row['id'],
                          "status"       => $status[$row['p3_page_id']],
                          "p3_page_id"   => $row['p3_page_id'],
                          "language"     => $row['language'],
                          "menu_name"    => $row['menuName'],
                          "page_title"   => $row['pageTitle'],
                          "url_param"    => $row['seoUrl'],
                          "keywords"     => $row['keywords'],
                          "description"  => $row['description'],
                          "access_owner" => $owner[$row['p3_page_id']],
                     )
            );
        }

        $this->renameTable('p3_page_translation', '_p3_page_translation_v0_16');
        $this->renameTable('p3_page_meta', '_p3_page_meta_v0_16');
        $this->renameTable('p3_page', '_p3_page_v0_16');

        $this->renameTable('_p3_page_translation_v0_17', 'p3_page_translation');
        $this->renameTable('_p3_page_v0_17', 'p3_page');

        if ($this->dbConnection->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
        }

        echo "\n\n*** IMPORTANT NOTICE ***";
        echo "\nThe existing p3_page... tables were renamed to _p3_page...v0_16.\n\n";
    }

    public function down()
    {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
            $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        }

        $this->dropTable('p3_page_translation');
        $this->dropTable('p3_page');

        $this->renameTable('_p3_page_v0_16', 'p3_page');
        $this->renameTable('_p3_page_meta_v0_16', 'p3_page_meta');
        $this->renameTable('_p3_page_translation_v0_16', 'p3_page_translation');

        if ($this->dbConnection->schema instanceof CMysqlSchema) {
            #$this->execute('SET FOREIGN_KEY_CHECKS = 1;');
        }
    }
}