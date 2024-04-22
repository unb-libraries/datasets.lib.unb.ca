# Project Documentation: datasets.lib.unb.ca

## Local Development Procedures
A simple ```dockworker start-over``` is enough to spin up a local development instance.

Some quick notes:
* The project shorthand slug (e.g. for JIRA) is DSETS.
* The configured theme is ```dsets_lib_unb_ca```, and all changes should be made to it. Its location in the repository is ```/themes/custom```.
* The theme ```dsets_lib_unb_ca``` inherits from ```unb_lib_theme```.
* There is also a minor-customization admin theme named ```dsets_admin_theme```.
* The teme ```dsets_admin_theme``` inherits from ```claro```.
* Once deployed locally, any changes to the _themes_ or _assets_ can then be updated with the usual: ```dockworker theme:build-all```

## Data Overview
DSETS uses Drupal content structures exclusively. No custom entities are defined. Content structures include:
* Anniversary Event	(node) — This is one of the main data structures for DSETS. Each record represents a notable UNB anniversary event. Bulding
construction, chancellor and dean elections, etc.
* Bibliography (node) — This structure is used to store bibliographies of notable characters connected to UNB.
* Basic Page (node) — For static content pages.
* Article (node) — Default Drupal content type.
* DSETS Anniversary Subjects (taxonomy) — Controlled vocabulary to manage anniversary event types: Degrees, departments, buildings, etc.
* Tags (taxonomy) — Drupal default vocabulary. To manage reference tags assigned to articles.

## Module Overview
* dsets_admin: Encompasses all customization pertaining to administrative site tasks.
* dsets_anniversaries: Encompasses all custom functionality related to the dsets_anniversary_event data structure.  
* dsets_core: Core custom functionality module. Encompasses all custom functionality, including specific data structure CRUD.
* dsets_nav: Includes all functionality related to menus and general navigation. 
* dsets_anniversaries_migration: Migration module for anniversary events. Imports content from legacy source.
* dsets_biographies_migration: Migration module for anniversary events. Imports content from legacy source.
