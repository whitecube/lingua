# Lingua - Language Codes Converter

**Disclaimer**: this is still a work in progress. Current state **does not work** yet.

## Usage

The Lingua converter works in two stages: first you'll need to instanciate it by providing the original format, than you can convert this string as many times as you want to one of the available formats.

### Setters

```php
use WhiteCube\Lingua\Service as Lingua;

// Create a converter, without knowing the original format (this will try to guess it for you)
$language = Lingua::create('en_GB');

// Create a converter from a language name
$language = Lingua::createFromName('french');
// or
$language = new Lingua();
$language->fromName('german');

// Create a convert from tha language's native name
$language = Lingua::createFromNative('nederlands');
// or
$language = new Lingua();
$language->fromNative('français');

/*
    ... other ISO, W3C & PHP methods are to come.
*/
```

**Reminder**: this does not work yet since we didn't make the languages repository yet.


### Formatting

```php
use WhiteCube\Lingua\Service as Lingua;

//  Format a language in a human readable string (the language's english name)
Lingua::createFromNative('français')
    ->toName(); // Outputs "french"

//  Format a language in its native form
Lingua::createFromName('german')
    ->toNative(); // Outputs "deutsch"

/*
    ... other ISO, W3C & PHP methods are to come.
*/
```

**Reminder**: this does not work yet since we didn't make the languages repository yet.
