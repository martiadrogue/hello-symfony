Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev env) - Adds code generation
    capabilities

  * [**WebServerBundle**][14] (in dev env) - Adds commands for running applications
    using the PHP built-in web server

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

## Setup Environment

Instructions to setup development environment. Development needs to use
`web/app_dev.php` as frontend controller. This file has a ip restriction, to
breaks this limitation just change ip 127.0.0.1 for your remote address from
`$_SERVER` variable. Do the same with file `ẁeb/config.php`.

After call file /config.php from browser, the file suggest to install php's
extension intl.

Firsts request to `http://www.project.tld/app_dev.php` returns fail. Show an
error:

```
The stream or file "/var/www/project/var/logs/dev.log" could not be opened: failed to open stream: Permission denied
```

To fix it we call

```shell
php bin/console cache:clear --no-warmup --env=dev
```

And then two errors more apear:

```
Warning: file_put_contents(/var/www/project/var/cache/dev/appDevDebugProjectContainerDeprecations.log): failed to open stream: No such file or directory
Unable to create the cache directory (/var/www/project/var/cache/dev)
```

Looks like some permission issue. So, let's change permissions

```shell
ll /var/www/project/var/cache
sudo chmod 777 -R /var/www/project/var/cache
```

After change permissions the issue continue. So, let's make dev folder

```shell
mkdir /var/www/project/var/cache/dev
```

Issue persists. Next plan is to change permissions of whole shared unit from
vagrant config file_put_contents:

```
config.vm.synced_folder "www/", "/var/www/", mount_options: ["dmode=777,fmode=777"]
```

Finally, If issue persist redirect session path to `/var/lib/php/sessions` in
file `app/config/config.yml`

```yml
save_path: '/var/lib/php/sessions'
```

## Page Crafting

Controllers are on `src/AppBundle/Controllers`, Create a new controller
`TodoController.php` there. This time routes writed as anotations and Actions
just send a Response.

[src/AppBundle/Controller/TodoController.php]

## Bootstrap Integration

First open **Starter template** from Bootstrap web site [14], show HTML and copy
all and paste it on the app/Resources/views/base.html.twig.

Now it's time for add twig blogs of the original base temple on new bootstrap
code. Also add a title and a menu. And put content block inside two divs, .row
and .col-md-12.

This example isn't assets oriented. So, swap relative path for theirs CDN. Js
and Css bootstrap are showed in website Bootstrapcdn [15], other resources for
IE10 viewport hack are in github project [16]. To end with resources management
remove debug purpose lines.

## Templating todos

In bootstrap documentation there is an example of table with Striped rows [17]

## Data

MySQL config is stored in `app/config/parameters.yml`.

Then create database `todolist`.


```shell
php bin/console doctrine:generate:entity


  Welcome to the Doctrine2 entity generator



This command helps you generate Doctrine2 entities.

First, you need to give the entity name you want to generate.
You must use the shortcut notation like AcmeBlogBundle:Post.

The Entity shortcut name: AppBunde:Todo
Bundle "AppBunde" does not exist.
The Entity shortcut name: AppBundle:Todo

Determine the format to use for the mapping information.

Configuration format (yml, xml, php, or annotation) [annotation]:

Instead of starting with a blank entity, you can add some fields now.
Note that the primary key will be added automatically (named id).

Available types: array, simple_array, json_array, object,
boolean, integer, smallint, bigint, string, text, datetime, datetimetz,
date, time, decimal, float, binary, blob, guid.

New field name (press <return> to stop adding fields): name
Field type [string]:
Field length [255]:
Is nullable [false]:
Unique [false]:

New field name (press <return> to stop adding fields): category
Field type [string]:
Field length [255]:
Is nullable [false]:
Unique [false]:

New field name (press <return> to stop adding fields): description
Field type [string]:
Field length [255]:
Is nullable [false]:
Unique [false]:

New field name (press <return> to stop adding fields): priority
Field type [string]:
Field length [255]:
Is nullable [false]:
Unique [false]:

New field name (press <return> to stop adding fields): due_date
Field type [string]: datetime
Is nullable [false]:
Unique [false]:

New field name (press <return> to stop adding fields): create_date
Field type [string]: datetime
Is nullable [false]:
Unique [false]:

New field name (press <return> to stop adding fields):


  Entity generation


  created ./src/AppBundle/Entity/
  created ./src/AppBundle/Entity/Todo.php
> Generating entity class src/AppBundle/Entity/Todo.php: OK!
> Generating repository class src/AppBundle/Repository/TodoRepository.php: OK!


  Everything is OK! Now get to work :).

```

And then persists changes into database

```shell
 php bin/console doctrine:schema:update --force
 ```


[1]:  https://symfony.com/doc/3.4/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.4/doctrine.html
[8]:  https://symfony.com/doc/3.4/templating.html
[9]:  https://symfony.com/doc/3.4/security.html
[10]: https://symfony.com/doc/3.4/email.html
[11]: https://symfony.com/doc/3.4/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[src/AppBundle/Controller/TodoController.php]: src/AppBundle/Controller/TodoController.php
[14]: https://getbootstrap.com/docs/3.3/getting-started/#examples-framework
[15]: https://www.bootstrapcdn.com/
[16]: https://github.com/jdrda/ie10-viewport-bug-workaround/
[17]: https://getbootstrap.com/docs/3.3/css/#tables-striped
