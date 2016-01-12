<?php

/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
$signalSlotDispatcher->connect(
		'TYPO3\CMS\Core\Resource\ResourceStorage', TYPO3\CMS\Core\Resource\ResourceStorage::SIGNAL_PreGeneratePublicUrl, 'RENOLIT\ReintFileTimestamp\Signal\PublicFileUri', 'preGeneratePublicUrl'
);