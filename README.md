DigitalState Platform
=====================

The DigitalState Platform offers developers...

## Installation

This section describes how to install the DigitalState Platform.

### Requirements

This guide assumes you have a web server ready with PHP and MySQL installed. A full list of requirements can be found on [the ORO website](https://www.orocrm.com/documentation/index/current/system-requirements). You will also need a blank database with a user that has read/write privileges on the database.

For the purpose of this guide, let's assume the following:
 
* the base directory of the installation: `/srv/ds-platform/`
* the database name: `ds_platform`
* the database user: `user1`
* the database password: `password1`

### Step 1

Download [the source code](https://github.com/DigitalState/Platform/archive/master.zip) and extract it in the base directory `/srv/ds-platform/`. The `web/` folder found in the source code should align with your web root, e.g. `/srv/ds-platform/web/`.

### Step 2

Download [the composer phar file](https://getcomposer.org/composer.phar) and place it in the base directory, e.g. `/srv/ds-platform/composer.phar`

### Step 3

Open a console and navigate to the base directory.
 
`cd /srv/ds-platform/`

Install all vendor dependencies by running the composer install command.

`./composer.phar install --prefer-dist`

At the end of the install process, you will be prompted to enter configuration parameters. The default values in parentheses will be used, if none provided. At a minimum, you will need to provide a `database_name`, `database_user` and `database_password`.

```
Some parameters are missing. Please provide them.
database_driver (pdo_mysql): 
database_host (127.0.0.1): 
database_port (null): 
database_name (bap_standard): ds_platform
database_user (root): user1
database_password (null): password1
mailer_transport (mail): 
mailer_host (127.0.0.1): 
mailer_port (null): 
mailer_encryption (null): 
mailer_user (null): 
mailer_password (null): 
websocket_bind_address (0.0.0.0): 
websocket_bind_port (8080): 
websocket_frontend_host ('*'): 
websocket_frontend_port (8080): 
websocket_backend_host ('*'): 
websocket_backend_port (8080): 
session_handler (session.handler.native_file): 
locale (en): 
secret (ThisTokenIsNotSoSecretChangeIt): 
installed (null): 
assets_version (null): 
assets_version_strategy (time_hash):
```

* `database_*` Database-related configurations.
* `mailer_*` Mailer-related configurations.
* `websocket_*` Websocket-related configurations.
* `session_handler` Session configuration.
* `locale` Locale configuration.
* `secret` Secret key configuration.
* `installed` Whether the platform has been installed or not.
* `assets_*` Assets-related configurations.

### Step 4

Install the platform by running the ORO install command.

`php app/console oro:install`

### Step 5 (optional)

Install camunda by running the BPM install commands.

`sudo php app/console bpm:camunda:install`

`sudo php app/console bpm:camunda:start`

### Done!

Open a browser and access your fresh installation in dev mode at `http://localhost/app_dev.php/`.

## Documentation

The documentation for the DigitalState Platform can be found here.
