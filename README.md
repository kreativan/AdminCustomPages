# Admin Custom Pages Module for ProcessWire

### Create custom admin pages easily without having to build a Process Module.
 
The new version of this module works only with ProcessWire 2.4 and higher.
Differences are explained bellow.

Since version 1.1.0 the installation process automatically adds a custom Fieldtype to the admin template. This creates a select field where you can choose the template file to render. This functionality was added by [Nico](http://nico.is)

☞ This module makes it easy to create simple admin pages but you can also create them in much more powerfull way without the need of a module. Have a look at this post written by Bernhard Baumrock to know how it's done https://processwire.com/blog/posts/building-custom-admin-pages-with-process-modules/


### To prepare the module:

1. Place the module folder in /site/modules/
2. Install the module in the modules page from the admin

### To create the pages:

1. Create a new page under "Admin" and give it the "admin" template. As "process" you have to choose "ProcessAdminCustomPages".
2. A field called "Template file" will appear. Select the file you want, all files from `/templates/admin/` folder will be listed.
3. Type in page icon name eg: `code`
