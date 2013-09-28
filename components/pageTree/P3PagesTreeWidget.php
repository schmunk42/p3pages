<?php
/**
 * P3PagesTreeWidget renders the sitemap tree list
 * @author   Tobias Munk <schmunk@usrbin.de>
 * @package  p3pages.models
 * @category db.ar
 */

class P3PagesTreeWidget extends CWidget
{

    public $rootNode = null;

    function init()
    {
    }

    function run()
    {
        $criteria = new CDbCriteria;
        // SQLite workaround for <=>
        if ($this->rootNode === null) {
            $criteria->condition = "tree_parent_id IS :id";
        } else {
            $criteria->condition = "tree_parent_id = :id";
        }
        $criteria->params = array(':id' => $this->rootNode);
        $criteria->order  = 'tree_position';
        $firstLevelNodes  = P3Page::model()->appendable()->localized()->findAll($criteria);
        #var_dump($firstLevelNodes);exit;
        $this->renderTree($firstLevelNodes, $this->rootNode);
    }

    private function renderTree($models, $model)
    {
        if (empty($models)) return;
        echo "<ul id='page-" . (($model !== null) ? $model->id : '_ROOT') . "' class='collapse in'>";
        foreach ($models AS $model) {
            echo "<li>";
            $this->render('tree', array('model' => $model));
            $this->renderTree($model->updateable()->localized()->getChildren(), $model);
            echo "</li>";
        }
        echo "</ul>";
    }
}

?>
