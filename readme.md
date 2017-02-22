# Kirby Siteoption

![GitHub release](https://img.shields.io/github/release/bnomei/kirby-random.svg?maxAge=1800) ![License](https://img.shields.io/github/license/mashape/apistatus.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-2.3%2B-red.svg)

Kirby CMS Tag to generate various random values.

## Requirements

- [**Kirby**](https://getkirby.com/) 2.3+

## Installation

### [Kirby CLI](https://github.com/getkirby/cli)

```
kirby plugin:install bnomei/kirby-random
```

### Git Submodule

```
$ git submodule add https://github.com/bnomei/kirby-random.git site/plugins/kirby-random
```

### Copy and Paste

1. [Download](https://github.com/bnomei/kirby-random/archive/master.zip) the contents of this repository as ZIP-file.
2. Rename the extracted folder to `kirby-random` and copy it into the `site/plugins/` directory in your Kirby project.

## Usage

Random string using [Kirby Toolkit](https://getkirby.com/docs/toolkit/api/str/random) `str::random()` forwarding the type if any.

```
(random: 5) or (random: 5 type:alpha)
```

Random positiv non-zero number with max value inclusive using PHP `random_int()`.

```
(random: number length: 128)
```

Any one value of a comma seperated list.

```
(random: apple, banana, coconut)
```

Any random pool of values picked from a comma seperated list with optional length.

```
(random: red, green, blue, black, white, yellow type: pool)
or
(random: red, green, blue, black, white, yellow type: pool length: 3)
```

A number between a min and max value inclusive using PHP `random_int()`.
```
(random: 41, 53 type: between)
```

`Lorem Ipsum` text using a [generator](https://github.com/joshtronic/php-loremipsum).

```
(random: lorem length: 5) or (random: lorem length: 4 type: words)
(random: lorem length: 3 type: sentences)
(random: lorem length: 2 type: paragraphs)
```

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bnomei/kirby-random/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
