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
    'version' => '2.0.2',
    'category' => 'misc',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.17-10.4.99',
            'php' => '7.1.0-7.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'state' => 'stable',
    'uploadfolder' => false,
    'clearCacheOnLoad' => false,
    'author' => 'Ephraim Härer',
    'author_email' => 'ephraim.haerer@renolit.com',
    'author_company' => 'RENOLIT SE',
];

