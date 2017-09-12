<?php
/* * *************************************************************
 * Extension Manager/Repository config file for ext "reint_file_timestamp".
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 * ************************************************************* */

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Timestamp parameter in public file uri',
	'description' => 'Adds a parameter with the timestamp of last change to all public file uri to prevent browser from caching the file after update.',
	'category' => 'misc',
	'author' => 'Ephraim Härer',
	'author_email' => 'ephraim.haerer@renolit.com',
	'author_company' => 'RENOLIT SE',
	'state' => 'stable',
	'uploadfolder' => false,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '1.1.2',
	'constraints' =>
	array(
		'depends' =>
		array(
			'typo3' => '6.2.4-7.99.99',
			'php' => '5.5.0-7.1.99',
		),
		'conflicts' =>
		array(
		),
		'suggests' =>
		array(
		),
	),
	'clearcacheonload' => false,
);

