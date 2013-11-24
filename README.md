SlimBlog
=====

Dependencies
---
* [Slim Framework](http://slimframework.com)
* [Eloquent](http://laravel.com/docs/eloquent)
* [Twig](http://twig.sensiolabs.org)
* [Bootstrap](http://getbootstrap.com)

Install
---
* Run 'php composer.phar install' in root directory
* Edit slimblog.sql file (in root directory), in settings table change base_url from http://localhost/slimblog/public/ to your url installation path
* Edit index.php file under public folder at 31 line with your database login data
* Login with username:password
* Enjoy

Features
---
* Create new post with live markdown editor
* Edit/Delete posts and manage users
* Manage settings

ToDo List
---
* Error manager
* Different user level (Super admin, writers, other)
* Template system
* Installation more user friendly
* I18n support
