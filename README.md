## Mitto Core Module for Magento 2 
### 1. Requirements

+ **Magento 2.2.0 or greater**
+ **Composer PHP Dependency Manager**

### 2. Module installation

+ Open command prompt, go to `<MAGENTO_ROOT>` folder and run the following
commands:

```
$ composer require mitto/magento2-core
$ php bin/magento setup:upgrade
$ php bin/magento setup:di:compile
$ php bin/magento setup:static-content:deploy
$ php bin/magento cache:clean
$ php bin/magento cache:flush
```

### 3. Module configuration

Login to the store admin panel.
Navigate to `Stores` > `Configuration` > `Mitto` > `Core`.
The essential settings are described below.

+ **API Key**
used for calling Mitto API from your back-end server

+ **Sender**
displayed to SMS recipients as sender

+ **Administrator numbers**
comma separated list of administrator numbers

### 4. Test configuration

At the bottom of the configuration is a section for testing. Enter a phone number, and clicking the `Test Now` button 
should send a test SMS message to entered number.

### 5. Usage

This module adds following functionalities (used by other Mitto modules):

+ **SMS Templates**

+ **SMS Sending** via Mitto API

+ **SMS Log** with delivery status