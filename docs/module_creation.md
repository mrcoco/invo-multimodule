# Creation of Modules #

This file describes how to add modules to the vokuro / invo-multimodule application

### Vokuro / Invo-multimodule ###
The invo-multimodule app was adjusted, because I wanted a complete, nice tutorial
about a simple multimodule application.
Sure, there is invo, but it wasn't multimodule yet.
Sure, there is vokuro, but it didn't have the correct structure (personal opninion)
an app directory (core directory) and the modules in a separate directory and it didn't have real modules.

Enter : invo-multimodule (it already existed, but I forked it, creating my own repo's)

### Adding Module directory and Module.php file ###
* Add the directory of your module to /modules directory. Example : projects
* Make sure, you have a Module.php in that directory
	it will have some configurations for that module specific. Mainly Namespace related.
* This Module class extends an abstract class, which uses a Trait (new since PHP 5.4)
*  The ModulesTrait will register a view Service (very important!) and hooks itself
	into the dispatcher service, to handle non-existent paths (projects/index/dontknowwhere should be handled!)
*  Eventually it will set up specific routes for this module through a routes file
 

### Adding Controllers and Models, Forms and view files ###
* Add your controller directory and your controller: ProjectsController
* Extend \Vokuro\Controllers\BaseController (in the original Vokuro app it's ControllerBase
	but I changed it, just because I needed to make sure all modules point to the correct controllerbase
	and it sounds nicer.
* Add your model(s) and forms
	Make sure you have the foreign keys, belongTo and hasMany (etc.) set up correctly.
	The form will add the fields for editing and adding your items (projects) one by one
	You can then set your validations per field.
* The view files are .volt files with the volt template engine
	Most important is the browse.volt file. It will show all items according to the filter (@todo)
	and it shows you edit- and delete options for your items.

### Flow ###
* in config/modules.php you need to add the module you just created, otherwise the app
	will show you the error that the module was not found
* in config/routes.php you need to add your routes (will be moved to separate file per module)
* access your /modulename and it will show you the browseAction from your controller
	(if you configured it that way)

