# UniqueCodeGenerator

> Generates a number of non-clashing codes, based on md5 of timestamp and filename

## Code Example

``` bash
php generate.php <number> <length> <filename> <format>
```

``` yaml
Defaults:
  number: 100
  length: 6
  filename: "output/output-{current_timestamp}"
  format: 'xls'
```

## Motivation

I need to generate codes.

## Installation

``` bash
git clone https://github.com/adamkiss/UniqueCodeGenerator/ && composer install
```

## License

MIT