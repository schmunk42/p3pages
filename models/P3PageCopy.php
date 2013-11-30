<?php

/**
 * This is the P3PageCopy model".
 *
 * @property string $sourceLanguage
 * @property string $targetLanguage
 * @property integer $sourcePageId
 * @property integer $targetParentPageId
 *
 * @author Christopher Stebe <cstebe@iserv4u.com>
 * @package p3pages.models
 * @version 0.1.0
 *
 */
class P3PageCopy extends CFormModel
{

    // private _name
    private $_name = 'P3 Copy Page';

    /**
     * @var type string
     */
    public $sourceLanguage;
    public $targetLanguage;

    /**
     * @var type integer
     */
    public $sourcePageId;
    public $targetParentPageId;

    /**
     * @var string with status set foreach p3 module on copy
     */
    public $p3pageStatus;
    public $p3pageTranslationStatus;
    public $p3widgetStatus;
    public $p3widgetTranslationStatus;


    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('sourceLanguage', 'required', 'message' => Yii::t('P3PagesModule.crud', 'Required')),
            array('p3pageStatus, p3pageTranslationStatus, p3widgetStatus, p3widgetTranslationStatus', 'default',
                'setOnEmpty' => TRUE,
                'value' => 'draft')
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'sourceLanguage'            => Yii::t('P3PagesModule.crud', 'Source Language'),
            'targetLanguage'            => Yii::t('P3PagesModule.crud', 'Target Language'),
            'sourcePageId'              => Yii::t('P3PagesModule.crud', 'Source Page ID'),
            'targetParentPageId'        => Yii::t('P3PagesModule.crud', 'Target Parent Page ID'),

            'p3pageStatus'              => Yii::t('P3PagesModule.crud', 'Page'),
            'p3pageTranslationStatus'   => Yii::t('P3PagesModule.crud', 'Page Translation'),
            'p3widgetStatus'            => Yii::t('P3PagesModule.crud', 'Widgets'),
            'p3widgetTranslationStatus' => Yii::t('P3PagesModule.crud', 'Widget Translation'),
        );
    }

    /**
     *
     * @return array with availible source languages
     * from Yii::app()->params->languages
     */
    public function getSourceLanguages()
    {
        $allLanguages = array();
        $languages    = Yii::app()->params->languages;
        foreach ($languages as $key => $value) {
            $allLanguages[$key] = '[' . $key . '] ' . $value;
        }
        return $allLanguages;
    }

    /**
     *
     * @param type $lang
     * @param type $status
     * @return array with all P3Pages in source language
     */
    public function getAllP3Pages($lang)
    {
        $allP3Pages = array();
        $conditions = array();

        $criteria                  = new CDbCriteria;
        $criteria->order           = 'default_menu_name';
        $conditions[]              = "tree_parent_id IS NOT NULL";
        $conditions[]              = "access_domain = :lang OR access_domain = '*'";
        $criteria->params[':lang'] = $lang;
        $criteria->condition       = implode(' AND ', $conditions);

        $p3PagesSource = P3Page::model()->findAll($criteria);
        foreach ($p3PagesSource as $value) {
            $allP3Pages[$value->id] = '[ID=' . $value->id . '] ' . $value->default_menu_name;
        }
        return $allP3Pages;
    }

    /**
     *
     * @param type $lang
     * @return array with list of all availible P3Page parent page id's
     */
    public function getAllP3PageParents($lang)
    {
        $allP3PageParents = array();
        $conditions       = array();
        $conditionsRoles  = array();

        $criteria            = new CDbCriteria;
        $criteria->order     = 'default_menu_name';
        $criteria->condition = "(access_domain = :lang OR access_domain = '*')";
        $criteria->params    = array(':lang' => $lang);

        // Check if any assigned roles of this user allows him to append a record
        foreach (array_keys(Yii::app()->getAuthManager()->getAuthAssignments(Yii::app()->user->id)) AS $role) {
            $conditionsRoles[] = "access_append = '{$role}'";
        }
        $conditionsRoles[] = "access_append IS NULL";
        $conditionsRoles[] = "access_append = '*'";
        $criteria->condition .= ' AND (' . implode(' OR ', $conditionsRoles) . ')';

        $p3PagesParent = P3Page::model()->findAll($criteria);
        foreach ($p3PagesParent as $value) {
            $allP3PageParents[$value->id] = '[ID=' . $value->id . '] ' . $value->default_menu_name;
        }
        return $allP3PageParents;
    }

    /**
     * @return array with p3 status list
     */
    public function getP3StatusList()
    {
        return array(
            'draft'      => 'draft',
            'published'  => 'published',
            'overridden' => 'overridden',
            'archived'   => 'archived'
        );
    }

    /**
     * @param array $post
     * @return bool
     * Check if the four need fields are set
     */
    public function getReadyToCopy($post = array())
    {
        if (is_array($post) && $post !== NULL) {
            if (isset($post['sourceLanguage']) &&
                isset($post['sourcePageId']) &&
                isset($post['targetLanguage']) &&
                isset($post['targetParentPageId'])
            ) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
