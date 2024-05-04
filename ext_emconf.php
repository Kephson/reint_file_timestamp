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
    'version' => '4.0.0',
    'category' => 'misc',
    'state' => 'stable',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'extensionmanager' => '12.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'author' => 'Ephraim Härer',
    'author_email' => 'ephraim.haerer@renolit.com',
    'author_company' => 'RENOLIT SE',
];

