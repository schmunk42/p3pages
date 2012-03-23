<?php

/**
 * Config file.
 *
 * @author Tobias Munk <schmunk@usrbin.de>
 * @link http://www.phundament.com/
 * @copyright Copyright &copy; 2005-2011 diemeisterei GmbH
 * @license http://www.phundament.com/license/
 */
return array(
	'modules' => array(
		'p3pages' => array(
			'class' => 'ext.p3pages.P3PagesModule',
		)
	),
	'components' => array(
		'urlManager' => array(
			'rules' => array(
				// p3media
				'<lang:[a-z]{2}>/<pageName:[a-zA-Z0-9-._]*>-<pageId:\d+>.p3' => 'p3pages/default/page', // p3media images, TESTING: disable in case of problems
			),
		),
	)
	)
?>
