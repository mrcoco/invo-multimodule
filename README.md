INVO Application with Modules directory
================================================

This is my attempt to make INVO a multi-module application
with directory 'modules'
and per module a file 'module.php' and 'router.php'
and in /app/config a file with all the modules


NOTE
----
Required version: >= 2

Get Started
-----------

#### Requirements

To run this application on your machine, you need at least:

* >= PHP 5.4
* Apache Web Server with mod rewrite enabled, and AllowOverride Options (or All) in your httpd.conf
* Latest Phalcon Framework extension installed/enabled

Then you'll need to create the database and initialize schema:

    echo 'CREATE DATABASE invo-multimodule' | mysql -u root
    cat schemas/invo-multimodule.sql | mysql -u root invo-multimodule


Foreign Keys
------------------------------------
Read more about foreign keys in the documentation in /docs

During the development of this repository I will add foreign keys
to the mysql tables. That means they will depend on the contents of the other table
(the foreign key).
Example is an invoice. It goes to a company.
There is a relation between the invoices table and the companies table.

All those foreign keys will be added through Migrations.

For the rest : See the /docs please





Installing Dependencies via Composer
------------------------------------
Invo's dependencies must be installed using Composer. Install composer in a common location or in your project:

```bash
curl -s http://getcomposer.org/installer | php
```

Run the composer installer:

```bash
cd invo-multimodule
php composer.phar install
```

Improving this Sample
---------------------
Phalcon is an open source project and a volunteer effort.
Vökuró does not have human resources fully dedicated to the maintenance of this software.
If you want something to be improved or you want a new feature please submit a Pull Request.

License
-------
Vökuró is open-sourced software licensed under the New BSD License.
