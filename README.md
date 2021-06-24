CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Folder Structure
 * Functionality


INTRODUCTION
------------

The Evolent Contacts project is to add/edit/delete/inactivate and to display the contacts.
Menus are also provided using Features to Add Contacts and to Display Contacts.


REQUIREMENTS
-------------

It is required to enable the provided custom module "evolent_contacts" and to add the block "Evolent Contacts block" in Content region and show for only Add Contacts(/add-contacts) page.
You need to add the given Drupal 8 Parallax Theme 8.x-1.8 and install and set it as default.


Folder Structure
----------------

Modules -> custom folder has a custom module evolent_contacts.
The custom module has .info.yml file, the install file, module file and the routing file.
It has a src folder which further has Controller, Forms and Plugin Block.
The templates folder has a twig file.
The themes folder has drupal8_parallax_theme theme which further has few files in which newly added css and js are included.
Features Export folder has the exported .yml files using Features module.


Functionality
-------------

Install the provided theme Drupal 8 Parallax Theme 8.x-1.8 and set it as default.
Enable the given custom module and add the block "Evolent Contacts block" in Content Region and show it for only Add Contacts(/add-contacts) page.
Import the files provided using Features module or add 2 menus for Add Contacts and for Display Contacts.
To add contacts, visit "/add-contacts" page and enter the details like First Name, Last Name, etc and Save.
Once you save, you will get a message "Successfully Saved" as confirmation and you will be redirected on Display Contacts page.
You can view the contacts from there and further you can delete it or edit it or you can inactivate it on editing it.

