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

[1]:  https://symfony.com/doc/3.4/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.4/doctrine.html
[8]:  https://symfony.com/doc/3.4/templating.html
[9]:  https://symfony.com/doc/3.4/security.html
[10]: https://symfony.com/doc/3.4/email.html
[11]: https://symfony.com/doc/3.4/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://symfony.com/doc/current/setup/built_in_web_server.html