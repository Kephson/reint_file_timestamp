.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _introduction:

Introduction
============


.. _what-it-does:

What does it do?
----------------

This extension adds a timestamp parameter to all file downloads and direct links in backend and frontend of TYPO3.

This extension was created to prevent browsers from caching files which have been updated by the editor but opened before.

It could be helpful for Intranet systems or systems with many changes in file downloads.

Example of a usecase with problems: 
- Editor opens pdf-file in frontend in Internet Explorer -> browser is caching this file
- Editor replaces the file in TYPO3 backend with a new file with the replace function in filelist module
- Editor reopens the pdf-file in frontend in Internet Explorer -> browser is loading the cached file and not the new file

If there are problems with this extension or better solutions for this problem, don't hesitate to contact me via email 
ephraim.haerer@renolit.com, via `Twitter <https://twitter.com/MeisterE>`_, via `Github <https://github.com/Kephson>`_ or in the 
`Slack channel of TYPO3 <https://typo3.slack.com/messages/typo3-cms/team/kephson/>`_.

For problems my preferred contact channel is to create an issue on `Github <https://github.com/Kephson/reint_file_timestamp/issues>`_.