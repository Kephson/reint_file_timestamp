<?php
/** @noinspection PhpUndefinedVariableInspection */

/* * *************************************************************
 * Extension Manager/Repository config file for ext "reint_file_timestamp".
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 * ************************************************************* */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Timestamp parameter in public file uri',
    'description' => 'Adds a parameter with the timestamp of last change to all public file uri to prevent browser from caching the file after update.',
    'version' => '3.0.0',
    'category' => 'misc',
    'state' => 'stable',
    'uploadfolder' => false,
    'clearCacheOnLoad' => false,
    'author' => 'Ephraim Härer',
    'author_email' => 'ephraim.haerer@renolit.com',
    'author_company' => 'RENOLIT SE',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'extensionmanager' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

