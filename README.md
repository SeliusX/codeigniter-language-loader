# codeigniter-language-loader

This project is a combination of different articles related to the language-settings in codeigniter 3.

The Hook does the following things:
- detecting the user language
- storing the user language in the session (to be able to switch)
- loading all language-files for the detected language

Depenencies:
- Make sure to erase language selection in config.php
- This Hook uses the international standard

TODO:
- check available languages
- caching
