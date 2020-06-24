reint_file_timestamp
======================

A TYPO3 extension which adds a timestamp parameter to public file urls - in frontend and backend - of TYPO3.

Example: https://mydomain.tld/myfile.pdf will be changed to https://mydomain.tld/myfile.pdf?v=timestampoffile

It is useful for content publisher in TYPO3 because some browsers cache the files extremely and after updating the file in TYPO3 the changes can't bee seen.

Useful for editors e.g. in Intranet systems or Corporate websites.

Because most of the time it's not useful to change the public url of all files, the default configuration will only change public url of docx, doc, pdf, xls, xlsx, odt, ods, ppt and pptx documents in frontend.

The changed public url is done in backend for all files in the filelist module.

Installation and Usage
======================

More information on [introduction](Documentation/Introduction/Index.rst) and [usage](Documentation/Administrator/Index.rst) 
can be found in the documentation folder.

Issues and Feedback
======================

Please use [Github](https://github.com/Kephson/reint_file_timestamp/issues) to send me [issues or feature requests](https://github.com/Kephson/reint_file_timestamp/issues), [feedback](https://github.com/Kephson) or in best case [pull requests](https://github.com/Kephson/reint_file_timestamp/pulls). Thanks.
