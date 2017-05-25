# Lingua - Language Codes Converter

This package will convert languages _from and to_ some common formats (ISO codes, W3C standards, PHP localization strings), including human-readable strings.

We are working on a _format guesser_, which will try to automatically understand the format it receives. This could be pretty useful when trying to parse user content.

**Disclaimer**: this is still a work in progress.

## Usage

The Lingua converter works in two stages: first you'll need to instanciate it by providing the original format, than you can convert this string as many times as you want to one of the available formats.

### Setters

```php
use WhiteCube\Lingua\Service as Lingua;

// Create a converter, without knowing the original format (this will try to guess it for you)
$language = Lingua::create('en_GB');

// Create a converter from a language name
$language = Lingua::createFromName('french');
$language = (new Lingua())->fromName('german');

// Create a convert from tha language's native name
$language = Lingua::createFromNative('nederlands');
$language = (new Lingua())->fromNative('magyar');

/*
    ... other ISO, W3C & PHP methods are to come.
*/
```

### Formatting

```php
use WhiteCube\Lingua\Service as Lingua;

$language = Lingua::createFromNative('français');

//  Format a language in a human readable string (the language's english name)
echo $language->toName(); // "french"

//  Format a language in its native form
echo $language->toNative(); // "français"

/*
    ... other ISO, W3C & PHP methods are to come.
*/
```

#### Default formatting

Lingua instances can be automatically transformed to strings without calling any formatting method. 

The **default format** is set to `name`, this means you can use Lingua instances as strings and the `toName()` method will be called out of the box.

Available formats are: `name`, `native`. Other formats are coming soon.

```php
use WhiteCube\Lingua\Service as Lingua;

$language = Lingua::createFromName('italian');
echo $language; // "italian"
```

You can change this default behavior by calling the static `setFormat` method. 

```php
use WhiteCube\Lingua\Service as Lingua;

$language = Lingua::createFromName('italian');
echo $language; // "italian"

Lingua::setFormat('native');
echo $language; // "italiano"
```

Additionally it is also possible to specify a desired format during the instanciation of Lingua. This **will always ignore the default formatting**, even if you just called the static `setFormat` method.

```php
use WhiteCube\Lingua\Service as Lingua;

$language = new Lingua('native');
$language->fromName('kashmiri');
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
