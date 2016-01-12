<?php

namespace RENOLIT\ReintFileTimestamp\Signal;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Ephraim Härer <ephraim.haerer@renolit.com>, RENOLIT SE
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

use TYPO3\CMS\Core\Resource\Exception\InvalidTargetFolderException;
use TYPO3\CMS\Core\Resource\Index\FileIndexRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * hooks the public file uri function
 * 
 * @param $t
 * 
 */
class PublicFileUri {

	/**
	 * signal slot for public url generation of a file
	 * @see \TYPO3\CMS\Core\Resource\ResourceStorage and the function getPublicUrl
	 * 
	 * @param \TYPO3\CMS\Core\Resource\ResourceStorage $t
	 * @param \TYPO3\CMS\Core\Resource\Driver\LocalDriver $driver
	 * @param object $resourceObject e.g. \TYPO3\CMS\Core\Resource\File, \TYPO3\CMS\Core\Resource\Folder, \TYPO3\CMS\Core\Resource\ProcessedFile
	 * @param boolean $relativeToCurrentScript
	 * @param array $urlData
	 * 
	 * @return void
	 */
	public function preGeneratePublicUrl($t, $driver, $resourceObject, $relativeToCurrentScript, $urlData) {

		// check if resource is file
		if (is_a($resourceObject, 'TYPO3\CMS\Core\Resource\File')) {

			$fileData = $this->getFileData($resourceObject);
			$newPublicUrl = '';

			// check if TYPO3 is in frontend mode
			if (TYPO3_MODE === 'FE') {
				$newPublicUrl = rawurldecode($driver->getPublicUrl($fileData['identifier'] . '?v=' . $fileData['modDate']));
			}

			// check if TYPO3 is in backend mode and make the path relative to the current script 
			// in order to make it possible to use the relative file
			if (TYPO3_MODE === 'BE' && $relativeToCurrentScript) {
				$publicUrl = rawurldecode($driver->getPublicUrl($fileData['identifier']));
				$absolutePathToContainingFolder = PathUtility::dirname(PATH_site . $publicUrl);
				$pathPart = PathUtility::getRelativePathTo($absolutePathToContainingFolder);
				$filePart = substr(PATH_site . $publicUrl, strlen($absolutePathToContainingFolder) + 1);
				$newPublicUrl = $pathPart . $filePart . '?v=' . $fileData['modDate'];
			}
			
			if(!empty($newPublicUrl)){
				$urlData['publicUrl'] = $newPublicUrl;
			}
		}
	}

	/**
	 * get the file data as array
	 * 
	 * @param \TYPO3\CMS\Core\Resource\File $resourceObject
	 * 
	 * @return array
	 */
	protected function getFileData($resourceObject) {

		$fileData = array(
			'identifier' => $resourceObject->getIdentifier(),
			'modDate' => $resourceObject->_getPropertyRaw('modification_date'),
		);

		return $fileData;
	}

}
