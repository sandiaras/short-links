CONTENTS OF THIS FILE
---------------------
 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Developers
 * Maintainers

INTRODUCTION
------------
This module provides a framework to manage a long URL, becoming it to a short link.

REQUIREMENTS
------------
No other modules are required.

INSTALLATION
------------
Install as you would normally install a contributed Drupal module. For further
information, see:
   https://www.drupal.org/docs/8/extending-drupal-8/installing-modules

CONFIGURATION
-------------

Once installed, you can define the initial form as the home page of the site, going to:
  admin/config/system/site-information

and define the link "/create/short_link" as front page.

DEVELOPERS
----------

The schema of the table where the short links is stored, is defined in the custom_short_links.install.

TO DO
------

- Give the possibility to define a vanity URL.
- To define a REST API service to consume the data stored by the module.
- To define automated unit/functional tests.
- Integrate a plugin in the module to generate the QR code.


