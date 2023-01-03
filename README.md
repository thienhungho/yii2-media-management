Yii2 Media Management System
====================
Media Management System for Yii2

Installation
------------

This is just an example, memorible moment. The source code may not work for known reasons. This source code include against loss license feature.

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thienhungho/yii2-media-management "*"
```

or add

```
"thienhungho/yii2-media-management": "*"
```

to the require section of your `composer.json` file.

### Migration

Run the following command in Terminal for database migration:

```
yii migrate/up --migrationPath=@vendor/thienhungho/MediaManagement/migrations
```

Or use the [namespaced migration](http://www.yiiframework.com/doc-2.0/guide-db-migrations.html#namespaced-migrations) (requires at least Yii 2.0.10):

```php
// Add namespace to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'thienhungho\MediaManagement\migrations\namespaced',
        ],
    ],
],
```

Then run:
```
yii migrate/up
```

Config
------------

Add module MediaManage to your `AppConfig` file.

```php
...
'modules'          => [
    ...
    /**
     * Media Manage
     */
     'media-manage' => [
        'class' => 'thienhungho\MediaManagement\modules\MediaManage\MediaManage',
     ],
    ...
],
...
```

Add module MediaConfiguration to your `AppConfig` file.

```php
...
'modules'          => [
    ...
    /**
     * Media Configuration
     */
     'media-configuration' => [
        'class' => 'thienhungho\MediaManagement\modules\MediaConfiguration\MediaConfiguration',
     ],
    ...
],
...
```

Modules
------------

[MediaBase](https://github.com/thienhungho/yii2-media-management/tree/master/src/modules/MediaBase), 
[MediaManage](https://github.com/thienhungho/yii2-media-management/tree/master/src/modules/MediaManage), 
[Uploads](https://github.com/thienhungho/yii2-media-management/tree/master/src/modules/Uploads),
[MediaConfiguration](https://github.com/thienhungho/yii2-media-management/tree/master/src/modules/Uploads)

Functions
------------

[Core](https://github.com/thienhungho/yii2-media-management/tree/master/src/functions/core.php)

Models
------------

[Media](https://github.com/thienhungho/yii2-media-management/tree/master/src/models/Media.php), 
[MediaConfigurationForm](https://github.com/thienhungho/yii2-media-management/tree/master/src/models/MediaConfigurationForm.php)
