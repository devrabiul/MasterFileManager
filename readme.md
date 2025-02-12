### Documentation

In Laravel application, need to publish the resources:

```bash
composer require devrabiul/master-file-manager
php artisan vendor:publish --provider="Devrabiul\MasterFileManager\MasterFileManagerServiceProvider"
```

```php
@include('master-file-manager::style')
```


```php
@include('master-file-manager::file-manager')
```


```php
@include('master-file-manager::script')
```