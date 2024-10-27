### Documentation

```bash
mkdir vendorAuth
cd vendorAuth
composer init
composer require orchestra/testbench
composer require phpunit/phpunit
./vendor/bin/phpunit
```

In Laravel application, need to publish the resources:

```bash
php artisan vendor:publish --provider="Devrabiul\MasterFileManager\MasterFileManagerServiceProvider"
```

```php
{!! renderMasterFileManagerStyle() !!}
```


```php
{!! renderMasterFileManagerView() !!}
```


```php
{!! renderMasterFileManagerJavaScript() !!}
```