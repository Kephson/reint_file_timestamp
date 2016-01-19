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

This extension was created to prevent browsers from caching files which have been updated by the editor but opened before.

It adds a timestamp parameter to all file downloads and direct links in backend and frontend of TYPO3.

It could be helpful for Intranet systems or systems with many changes in file downloads.

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
  - modify the file as itself, it only modifies the public URL of the file when the URL is asked for.
  - modify the public URL if a file is processed through the image processor via TYPO3. A timestamp for processed URLs isn't needed.
