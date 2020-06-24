<?php

namespace RENOLIT\ReintFileTimestamp\Signal;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016-2020 Ephraim Härer <ephraim.haerer@renolit.com>, RENOLIT SE
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

use \TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use \TYPO3\CMS\Core\Core\Environment;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Utility\PathUtility;
use \TYPO3\CMS\Core\Resource\File;

/**
 * hooks the public file uri function
 */
class PublicFileUri
{

    /**
     * extension key
     *
     * @var string
     */
    protected $extKey = 'reint_file_timestamp';

    /**
     * settings in extension manager
     *
     * @var array
     */
    protected $emSettings;

    /**
     * signal slot for public url generation of a file
     *
     * @param \TYPO3\CMS\Core\Resource\ResourceStorage $t
     * @param \TYPO3\CMS\Core\Resource\Driver\LocalDriver $driver
     * @param object $resourceObject e.g. \TYPO3\CMS\Core\Resource\File, \TYPO3\CMS\Core\Resource\Folder, \TYPO3\CMS\Core\Resource\ProcessedFile
     * @param boolean $relativeToCurrentScript
     * @param array $urlData
     * @return void
     * @see \TYPO3\CMS\Core\Resource\ResourceStorage and the function getPublicUrl
     */
    public function preGeneratePublicUrl($t, $driver, $resourceObject, $relativeToCurrentScript, $urlData)
    {

        $this->emSettings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get($this->extKey);

        /* check if resource is file */
        if (is_a($resourceObject, File::class)) {

            $fileData = $this->getFileData($resourceObject);
            $newPublicUrl = '';

            $enable = true;

            $storage = $resourceObject->getStorage();
            /* check if storage is public */
            if (!$storage->isPublic()) {
                $enable = false;
            }

            /* check if TYPO3 is in frontend mode */
            if ($enable && TYPO3_MODE === 'FE') {
                if ($this->emSettings['disable_fe']) {
                    $enable = false;
                } else {
                    // check filetypes field
                    if (!empty($this->emSettings['filetypes_fe'])) {
                        $filetypes = explode(',', $this->emSettings['filetypes_fe']);
                        if (!in_array($fileData['extension'], $filetypes, true)) {
                            $enable = false;
                        }
                    }
                    if ($enable) {
                        $newPublicUrl = $driver->getPublicUrl($fileData['identifier']);
                    }
                }
            }

            /* check if TYPO3 is in backend mode and make the path relative to the current script
            in order to make it possible to use the relative file */
            if ($enable && TYPO3_MODE === 'BE' && $relativeToCurrentScript) {
                if ($this->emSettings['disable_be']) {
                    $enable = false;
                } else {
                    /* check filetypes field */
                    if (!empty($this->emSettings['filetypes_be'])) {
                        $filetypes = explode(',', $this->emSettings['filetypes_be']);
                        if (!in_array($fileData['extension'], $filetypes, true)) {
                            $enable = false;
                        }
                    }
                    if ($enable) {
                        $publicUrl = $driver->getPublicUrl($fileData['identifier']);
                        $absolutePathToContainingFolder = PathUtility::dirname(Environment::getPublicPath() . '/' . $publicUrl);
                        $pathPart = PathUtility::getRelativePathTo($absolutePathToContainingFolder);
                        $filePart = substr(Environment::getPublicPath() . '/' . $publicUrl, strlen($absolutePathToContainingFolder) + 1);
                        $newPublicUrl = $pathPart . $filePart;
                    }
                }
            }

            if (!empty($newPublicUrl) && !empty($fileData['modDate']) && $enable) {
                $urlData['publicUrl'] = $newPublicUrl . '?v=' . $fileData['modDate'];
            }
        }
    }

    /**
     * get the file data as array
     *
     * @param File $resourceObject
     * @return array
     */
    protected function getFileData($resourceObject)
    {

        $fileData = array(
            'identifier' => $resourceObject->getIdentifier(),
            'modDate' => $resourceObject->_getPropertyRaw('modification_date'),
            'extension' => $resourceObject->getExtension(),
        );

        return $fileData;
    }
}
