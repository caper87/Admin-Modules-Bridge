# Admin-Modules-Bridge
Bridge to use the SleepingOwl Admin Package together with the Modules Package from Pingpong Labs

#Installation

add 

```
"pseudoagentur/admin-bridge": "dev-master"
```

to your composer.json and run then

```
composer update
```


Now update the `config/app.php` and add the new Service Provider to the `providers` array.
Be sure that the Service Provider will be added before the SleepingOwl Service Provider.

```
		'Pseudoagentur\AdminBridge\Providers\AdminBridgeServiceProvider',
		'SleepingOwl\Admin\AdminServiceProvider',
```

#Usage

Inside your module you have to create a new file called `admin.php`.
This file includes the Model Configuration.
For detailed information, take a look into the documentation: http://sleeping-owl.github.io/v3/en/Getting_Started/Model_Configuration.html

Btw. I create always also a menu.php which includes the menu configuration.
The menu.php will be included inside the module.json

#Requirements

* https://github.com/sleeping-owl/admin - Version 3
* https://github.com/pingpong-labs/modules - Version 2.*
* Laravel 5.*

#Credits
* Special Thanks goes to gravitano
* Special Thanks goes to sleeping-owl