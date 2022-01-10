<?php

namespace RENOLIT\ReintFileTimestamp\EventListener;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2022 Ephraim Härer <ephraim.haerer@renolit.com>, RENOLIT SE
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Resource\Event\GeneratePublicUrlForResourceEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Http\ApplicationType;
use Psr\Http\Message\ServerRequestInterface;

/**
 * hooks into the public file uri generating
 */
class PublicFileUriListener
{

    /**
     * extension key
     *
     * @var string
     */
    protected $extKey = 'reint_file_timestamp';

    /**
     * settings in extension configuration
     *
     * @var array
     */
    protected $emSettings;

    /**
     * @param GeneratePublicUrlForResourceEvent $event
     * @return void
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     * @throws ExtensionConfigurationPathDoesNotExistException
     */
    public function addTimestampToPublicUrl(GeneratePublicUrlForResourceEvent $event): void
    {
        $resourceObject = $event->getResource();
        if (is_a($resourceObject, File::class)) {
            $fileData = $this->getFileData($resourceObject);
            $this->emSettings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get($this->extKey);
            $storage = $event->getStorage();
            /* check if storage is public */
            if (!$storage->isPublic()) {
                return;
            }
            /* check if TYPO3 is in frontend mode and check fileTypes field */
            if (!$this->emSettings['disable_fe'] && !empty($this->emSettings['filetypes_fe']) &&
                ($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface &&
                ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isFrontend()) {
                $fileTypes = explode(',', $this->emSettings['filetypes_fe']);
                if (in_array($fileData['extension'], $fileTypes, true)) {
                    $this->manipulatePublicUri($event, $fileData);
                }
            }
            /* check if TYPO3 is in backend mode and check fileTypes field */
            if (!$this->emSettings['disable_be'] && !empty($this->emSettings['filetypes_be']) &&
                ($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface &&
                ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isBackend()) {
                $fileTypes = explode(',', $this->emSettings['filetypes_be']);
                if (in_array($fileData['extension'], $fileTypes, true)) {
                    $this->manipulatePublicUri($event, $fileData);
                }
            }
        }
    }

    /**
     * @param GeneratePublicUrlForResourceEvent $event
     * @param array $fileData
     * @return void
     */
    protected function manipulatePublicUri($event, $fileData)
    {
        $publicUrl = $event->getPublicUrl();
        if (!empty($publicUrl) && !empty($fileData['modDate'])) {
            if (strpos($publicUrl, '?') === false) {
                $event->setPublicUrl($publicUrl . '?v=' . $fileData['modDate']);
            } else {
                $event->setPublicUrl($publicUrl . '&v=' . $fileData['modDate']);
            }
        }
    }

    /**
     * get the file data as array
     *
     * @param File $resourceObject
     * @return array
     */
    protected function getFileData($resourceObject): array
    {
        return [
            'identifier' => $resourceObject->getIdentifier(),
            'modDate' => $resourceObject->_getPropertyRaw('modification_date'),
            'extension' => $resourceObject->getExtension(),
        ];
    }
}
