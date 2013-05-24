<?php

/**
 * Config file.
 * @author    Tobias Munk <schmunk@usrbin.de>
 * @link      http://www.phundament.com/
 * @copyright Copyright &copy; 2005-2011 diemeisterei GmbH
 * @license   http://www.phundament.com/license/
 */
return array(
    'import'     => array(
        'ext.phundament.p3pages.models.*'
    ),
    'modules'    => array(
        'p3pages' => array(
            'class' => 'ext.phundament.p3pages.P3PagesModule',
        )
    ),
    'components' => array(
        'urlManager' => array(
            'rules' => array(
                // p3media
                '<lang:[a-z]{2}>/<pageName:[a-zA-Z0-9-._]*>-<pageId:\d+>.html' => 'p3pages/default/page',
            ),
        ),
    )
)
?>
