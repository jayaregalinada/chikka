# Chikka

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-packagist]

Laravel 5 and Chikka VOLT IN!!!

This package is using [Guzzle 6](http://docs.guzzlephp.org/en/latest/index.html).

__NOTE__: Please make sure you have a balance to your chikka account.

## Cost per Outgoing SMS
|TELCO|COST|
|---|---|
|Globe|P0.50|
|Smart|P0.40|
|Sun|P0.40|

## Install

### Via Composer

``` bash
$ composer require jag/chikka
```

## Post Installation

#### Add to Configuration
Add the Service Provider to your `config/app.php`

``` php
Jag\Chikka\ServiceProvider::class,
```

Add the Optional Facade.

``` php
'Chikka' => Jag\Chikka\ChikkaFacade::class,
```

#### Add to Environment 
Add the environment configuration to your `.env` file

```
CHIKKA_SHORTCODE=YOUR_CHIKKA_SHORTCODE
CHIKKA_KEY=YOUR_CHIKKA_CLIENT_ID
CHIKKA_SECRET=YOUR_CHIKKA_SECRET_KEY
```

You may also define other environment configuration such as:
```
CHIKKA_URI=https://post.chikka.com/smsapi/request
CHIKKA_TIMEOUT=180
```

## Usage

#### Send
To send check the example below:

``` php
use Jag\Chikka\ChikkaFacade as Chikka;

...

Chikka::send('639XXXXXXX', 'I LOVE YOU!');

...
```

## Change log

Please check [CHANGELOG](CHANGELOG.md) for more information on what has recently changed.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## Security

If you discover any security related issues, please email jayaregalinada@gmail.com instead of using the issue tracker.


## Credits

- [Jay Are Galinada][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jag/chikka.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jag/chikka/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/jag/chikka.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/jag/chikka.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jag/chikka.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jag/chikka
[link-travis]: https://travis-ci.org/jag/chikka
[link-scrutinizer]: https://scrutinizer-ci.com/g/jag/chikka/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/jag/chikka
[link-author]: https://github.com/jayaregalinada
[link-contributors]: ../../contributors
