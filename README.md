# 🚫 UNDER DEVELOPMENT

# Laravel-formy

## Class based simple Form builder for any laravel Application

## Installation

You can install the package via composer:

```bash
composer require visanduma/laravel-formy
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-formy-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-formy-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-formy-views"
```

## Usage

```php
$laravelFormy = new Visanduma\LaravelFormy();
echo $laravelFormy->echoPhrase('Hello, Visanduma!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/Visanduma/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [LaHiRu](https://github.com/Visanduma)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
