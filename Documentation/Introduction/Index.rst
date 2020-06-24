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

A TYPO3 extension which adds a timestamp parameter to public file urls - in frontend and backend - of TYPO3.

This extension was created to prevent browsers from caching files which have been updated by the editor but opened before.

Example: https://mydomain.tld/myfile.pdf will be changed to https://mydomain.tld/myfile.pdf?v=timestampoffile

It is useful for content publisher in TYPO3 because some browsers cache the files extremely and after updating the file in TYPO3 the changes can't bee seen.

Useful for editors e.g. in Intranet systems or Corporate websites.

Because most of the time it's not useful to change the public url of all files, the default configuration will only change public url of docx, doc, pdf, xls, xlsx, odt, ods, ppt and pptx documents in frontend.

The changed public url is done in backend for all files in the filelist module.

Example of a usecase with problems:
  - Editor opens pdf-file in frontend in Internet Explorer -> browser is caching this file
  - Editor replaces the file in TYPO3 backend with a new file with the replace function in filelist module
  - Editor reopens the pdf-file in frontend in Internet Explorer -> browser is loading the cached file and not the new file

\
\

**Examples of converted URLs:**

-----------------------

::

		<img src="/fileadmin/myfolder/images/mylogo.png" width="224" height="224" alt="" />


will be converted to

::

		<img src="/fileadmin/myfolder/images/mylogo.png?v=1385557716" width="224" height="224" alt="" />


-----------------------

::

		<a href="/fileadmin/myfolder/documents/document.pdf" target="_blank">Download document</a>


will be converted to

::

		<a href="/fileadmin/myfolder/documents/document.pdf?v=1385557716" target="_blank">Download document</a>


-----------------------

\
\
\

If there are problems with this extension or better solutions for this problem, don't hesitate to contact me via email
ephraim.haerer@renolit.com, via `Twitter <https://twitter.com/MeisterE>`_, via `my profile on Github <https://github.com/Kephson>`_ or in the
`Slack channel of TYPO3 <https://typo3.slack.com/messages/typo3-cms/team/kephson/>`_.

For problems my preferred contact channel is to create an issue on `Github <https://github.com/Kephson/reint_file_timestamp/issues>`_.


**It will NOT:**
  - modify the file itself, it only modifies the public URL of the file when the URL will be created in TYPO3 frontend or backend
  - modify the public URL if a file is processed through the image processor via TYPO3. A timestamp for processed URLs isn't needed because if the file was changed, a new processed file will be created
