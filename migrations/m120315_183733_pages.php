
<?php

class m120315_183733_pages extends CDbMigration {

	public function up() {
		if (Yii::app()->db->schema instanceof CMysqlSchema)
			$options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
		else
			$options = '';

// Data for table 'p3_page'

		$this->insert("p3_page", array(
			"id" => "1",
			"layout" => null,
			"view" => null,
			"route" => "{route:'/site/index'}",
		));

		$this->insert("p3_page", array(
			"id" => "3",
			"layout" => "//layouts/main",
			"view" => "//p3pages/default",
			"route" => null,
		));

		$this->insert("p3_page", array(
			"id" => "4",
			"layout" => "//layouts/main",
			"view" => "//p3pages/default",
			"route" => null,
		));

		$this->insert("p3_page", array(
			"id" => "5",
			"layout" => null,
			"view" => null,
			"route" => "{route:'/site/contact'}",
		));




// Data for table 'p3_page_meta'

		$this->insert("p3_page_meta", array(
			"id" => "1",
			"status" => "30",
			"type" => null,
			"language" => "_ALL",
			"treeParent_id" => null,
			"treePosition" => null,
			"begin" => null,
			"end" => null,
			"keywords" => null,
			"customData" => null,
			"label" => null,
			"owner" => "1",
			"checkAccessCreate" => null,
			"checkAccessRead" => null,
			"checkAccessUpdate" => "Admin",
			"checkAccessDelete" => "Admin",
			"createdAt" => "2012-03-15 11:20:07",
			"createdBy" => "1",
			"modifiedAt" => "2012-03-15 18:30:15",
			"modifiedBy" => "1",
			"guid" => "F41EEFFA-9F41-42CD-85C2-30DBB1A71239",
			"ancestor_guid" => null,
			"model" => "P3Page",
		));

		$this->insert("p3_page_meta", array(
			"id" => "5",
			"status" => "30",
			"type" => null,
			"language" => "_ALL",
			"treeParent_id" => null,
			"treePosition" => null,
			"begin" => null,
			"end" => null,
			"keywords" => null,
			"customData" => null,
			"label" => null,
			"owner" => "1",
			"checkAccessCreate" => null,
			"checkAccessRead" => null,
			"checkAccessUpdate" => "Editor",
			"checkAccessDelete" => "Editor",
			"createdAt" => "2012-03-16 18:22:48",
			"createdBy" => "1",
			"modifiedAt" => "2012-03-16 18:23:03",
			"modifiedBy" => "1",
			"guid" => "AD2BA004-AE4D-4826-98EC-EA3EAB41A55C",
			"ancestor_guid" => null,
			"model" => "P3Page",
		));

		$this->insert("p3_page_meta", array(
			"id" => "3",
			"status" => "30",
			"type" => null,
			"language" => "_ALL",
			"treeParent_id" => null,
			"treePosition" => null,
			"begin" => null,
			"end" => null,
			"keywords" => null,
			"customData" => null,
			"label" => null,
			"owner" => "1",
			"checkAccessCreate" => null,
			"checkAccessRead" => null,
			"checkAccessUpdate" => "Editor",
			"checkAccessDelete" => "Editor",
			"createdAt" => "2012-03-15 18:31:01",
			"createdBy" => "1",
			"modifiedAt" => "2012-03-16 18:24:04",
			"modifiedBy" => "1",
			"guid" => "648124A0-5809-43FC-B20F-8C55A20AA357",
			"ancestor_guid" => null,
			"model" => "P3Page",
		));

		$this->insert("p3_page_meta", array(
			"id" => "4",
			"status" => "30",
			"type" => null,
			"language" => "_ALL",
			"treeParent_id" => null,
			"treePosition" => null,
			"begin" => null,
			"end" => null,
			"keywords" => null,
			"customData" => null,
			"label" => null,
			"owner" => "1",
			"checkAccessCreate" => null,
			"checkAccessRead" => null,
			"checkAccessUpdate" => "Editor",
			"checkAccessDelete" => "Editor",
			"createdAt" => "2012-03-16 18:27:45",
			"createdBy" => "1",
			"modifiedAt" => "0000-00-00 00:00:00",
			"modifiedBy" => null,
			"guid" => "455A92C8-4598-4E36-8709-73F4C4AEE14F",
			"ancestor_guid" => null,
			"model" => "P3Page",
		));





// Data for table 'p3_page_translation'

		$this->insert("p3_page_translation", array(
			"id" => "1",
			"p3_page_id" => "5",
			"language" => "en",
			"seoUrl" => "contact",
			"pageTitle" => "Contact Us",
			"menuName" => "Contact",
			"keywords" => null,
			"description" => null,
		));

		$this->insert("p3_page_translation", array(
			"id" => "4",
			"p3_page_id" => "1",
			"language" => "en",
			"seoUrl" => "home",
			"pageTitle" => "Home Page",
			"menuName" => "Home",
			"keywords" => null,
			"description" => null,
		));

		$this->insert("p3_page_translation", array(
			"id" => "5",
			"p3_page_id" => "3",
			"language" => "en",
			"seoUrl" => "About",
			"pageTitle" => "About Us",
			"menuName" => "About",
			"keywords" => null,
			"description" => null,
		));
	}

	public function down() {
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
