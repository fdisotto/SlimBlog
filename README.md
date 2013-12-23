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
* Edit slimblog.sql file (in SQL directory), in settings table change base_url from http://localhost/slimblog/public/ to your url installation path
* Run .sql files located in SQL/updates
* Edit index.php file under public folder at 31 line with your database login data
* Login with username:password
* Enjoy

Features
---
* Create new post with live markdown editor
* Edit/Delete posts and manage users
* Manage settings
* Template system

ToDo List
---
* Error manager
* Different user level (Super admin, writers, other)
* ~~Template system~~
* Installation more user friendly
* I18n support

Author
---
**Fabio Di Sotto**
* [Github](https://github.com/fdisotto)
* [Twitter](https://twitter.com/fdisotto)
* [Facebook](https://facebook.com/fdisotto)

Contributors
---
**Andrew Smith**
* [Github](https://github.com/silentworks)
* [Website](http://silentworks.co.uk/)



[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/fdisotto/slimblog/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
