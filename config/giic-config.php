<?php
// GIIC CONFIG FILE
// ----------------

$appRoot = dirname(__FILE__) . '/../../../..';

// define table list (eg. you don't need MANY_MANY tables)
$tables = array(
    'p3_page'             => 'p3Page',
    'p3_page_translation' => 'p3PageTranslation'
);

// define CRUDs
$cruds = $tables;

// init actions
$actions = array();

// generate slim CRUDs into application
foreach ($cruds AS $crud) {
    $actions[] = array(
        "codeModel" => "FullCrudCode",
        "generator" => 'vendor.phundament.gii-template-collection.fullCrud.FullCrudGenerator',
        "templates" => array(
            'slim' => $appRoot . '/vendor/phundament/gii-template-collection/fullCrud/templates/slim',
        ),
        "model"     => array(
            "model"                  => "vendor.phundament.p3pages.models." . ucfirst($crud),
            "controller"             => 'p3pages/' . $crud,
            'messageCatalog'         => 'P3PagesModule.model',
            'messageCatalogStandard' => 'P3PagesModule.crud',
            'providers'              => array(
                'vendor.schmunk42.giic.examples.PhFieldProvider'
            ),
            "template"               => "slim"
        )
    );
}


return array(
    "actions" => $actions
);