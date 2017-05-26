# Lingua - Language Codes Converter

This package will convert languages _from and to_ some common formats (ISO codes, W3C standards, PHP localization strings), including human-readable strings.

**Disclaimer**: this is still a work in progress.

## Content

The package currently supports **over 220 languages**. Most living languages are included, with country codes, names and possible alphabet sets (Latin, Cyrillic, Arabic, ...).

Available **input and output formats** are:

1. `name`: The (probably) english name of the language.
2. `native`: The autonym of the language.
3. `ISO-639-1`: The official [two-letter code](https://www.loc.gov/standards/iso639-2/php/code_list.php) for the language. **Some languages do not have this code**.
4. `ISO-639-2t`: An official three-letters code for terminology applications (ISO 639-2/T) for the language.
5. `ISO-639-2b`: An official three-letters code for bibliographic applications (ISO 639-2/B) for the language.
6. `ISO-639-3`: The official three-letters code. This is also the most common terminology and therefore the most complete language representation. In most cases, this is the same format as `ISO-639-2t`, except for macrolanguages. 

**Note on macrolanguages**: The `ISO-639-3` output will also indicate the amount of sub-languages represented with the same ISO code.

## Usage

The Lingua converter works in two stages: first you'll need to instanciate it by providing the original format, than you can convert this string as many times as you want to one of the available formats.

### Setters

```php
use WhiteCube\Lingua\Service as Lingua;

// Create a converter, without knowing the original format (this will try to guess it for you)
$language = Lingua::create('en_GB'); // Not yet working.

// Create a converter from a language name
$language = Lingua::createFromName('french');
$language = (new Lingua())->fromName('german');

// Create a converter from a language's native name
$language = Lingua::createFromNative('nederlands');
$language = (new Lingua())->fromNative('magyar');

// Create a converter from a ISO 639-1 code
// Note: this will not throw an error if the iso-code is not defined in the language repository
$language = Lingua::createFromISO_639_1('mk');
$language = (new Lingua())->fromISO_639_1('ko');

// Create a converter from a ISO 639-2t code
// Note: this will not throw an error if the iso-code is not defined in the language repository
$language = Lingua::createFromISO_639_2t('heb');
$language = (new Lingua())->fromISO_639_2t('gle');

// Create a converter from a ISO 639-2b code
// Note: this will not throw an error if the iso-code is not defined in the language repository
$language = Lingua::createFromISO_639_2b('her');
$language = (new Lingua())->fromISO_639_2b('iku');

// Create a converter from a ISO 639-3 code
// Note: this will not throw an error if the iso-code is not defined in the language repository
$language = Lingua::createFromISO_639_3('aze + 2');
$language = (new Lingua())->fromISO_639_3('asm');

/*
    ... other W3C & PHP methods are to come.
*/
```

### Formatting

```php
use WhiteCube\Lingua\Service as Lingua;

$language = Lingua::createFromNative('français');

// Format a language in a human readable string (the language's english name)
// Note: this will trigger an exception if $language has no equivalency in the languages repository
echo $language->toName(); // "french"

// Format a language in its native form
// Note: this will trigger an exception if $language has no equivalency in the languages repository
echo $language->toNative(); // "français"

// Format a language in a ISO 639-1 string
echo $language->toISO_639_1(); // "fr"

// Format a language in a ISO 639-2t string
echo $language->toISO_639_2t(); // "fra"

// Format a language in a ISO 639-2b string
echo $language->toISO_639_2b(); // "fre"

// Format a language in a ISO 639-3 string
echo $language->toISO_639_3(); // "fra"

/*
    ... other W3C & PHP methods are to come.
*/
```

#### Default formatting

Lingua instances can be automatically transformed to strings without calling any formatting method. 

The **default format** is set to `name`, this means you can use Lingua instances as strings and the `toName()` method will be called out of the box.

```php
use WhiteCube\Lingua\Service as Lingua;

echo Lingua::createFromISO_639_3('ita'); // "italian"
```

You can change this default behavior by calling the static `setFormat` method. Available formats are: `name`, `native`, `iso-639-1`, `iso-639-2t`, `iso-639-2b`, `iso-639-3`. Other formats are coming soon.

```php
use WhiteCube\Lingua\Service as Lingua;

Lingua::setFormat('native');
$language = Lingua::createFromISO_639_3('ita');
echo $language; // "italiano"

Lingua::setFormat('iso-639-1');
echo $language; // "it"
```

Additionally it is also possible to specify a desired format during the instanciation of Lingua. This **will always ignore the default formatting**, even if you just called the static `setFormat` method.

```php
use WhiteCube\Lingua\Service as Lingua;

$language = new Lingua('native');
$language->fromISO_639_1('ks');
echo $language; // "कश्मीरी, كشميري‎"

// Trying to change the default formatting
Lingua::setFormat('name');

echo $language; // still "कश्मीरी, كشميري‎"
echo $language->toName(); // "kashmiri"
```

This behavior is also possible with the static `create` methods. You can specify the desired formatting as second parameter.

```php
use WhiteCube\Lingua\Service as Lingua;

echo Lingua::createFromName('maltese', 'native'); // "malti"
```

## Contributing

Your help can be precious in order to make this package more accurate! You can contribute on two levels.

### Working on core features

In order to add new features, only well-documented and tested pull-requests will be accepted.

Please open or comment existing issues on this repository in order to report bugs. If you're sure about what you're doing, you can send a pull-request.

### Maintaining the languages repository

There are currently some languages marked with a `// TODO` comment in the `./languages.php` file. This means we probably didn't find enough information about these languages. You know how to fill the gaps? Please let us know! You can open an issue, make a pull-request or contact us on any available platform.

And of course you can also add new languages to the repository, but only if you're sure about the terminology.

Thank you!
