# Laravel 5 markdown parser

This is **Laravel 5** package for parsing markdown files or strings. Supports booth [**Traditional Markdown**](http://daringfireball.net/projects/markdown/syntax) and [**Github Flavored Markdown**](https://help.github.com/articles/github-flavored-markdown/) syntaxes.

## Table of content

* [Todo](#todo)
* [Features](#features)
* [Installation](#installation)
* [Configuration](#configuration)
* [Usage](#usage)

---
[Back to top][top]

## Todo

* Fix incoming bugs
* Finish documentation

---
[Back to top][top]

## Features

* Supports **Traditional** and **GFM** markdown syntax
* Easy to add new rules and skins

---
[Back to top][top]

## Installation

Via `composer` run following command in your project root:

```bash
composer require vi-kon/laravel-markdown-parser
```

In your Laravel 5 project add following lines to `app.php`:

```php
// to your providers array
'ViKon\ParserMarkdown\ParserMarkdownServiceProvider',
```

---
[Back to top][top]

## Usage

First need to create classes and set markdown rules:

```php
$parser = new Parser();
$lexer = new Lexer();
$renderer = new Renderer();

// Initialize parser with markdown rules
$ruleSet = new MarkdownRuleSet();
$ruleSet->init($parser, $lexer);
```

After it need to set renderer. There are multiple skins, **bootstrap** and **markdown**.

```php
// Set bootstrap renderer
$bootstrapSkin = new BootstrapSkin();
$bootstrapSkin->init($parser, $renderer);

// Set markdown renderer
$markdownSkin = new MarkdownSkin();
$markdownSkin->init($parser, $renderer);
```

The bootstrap skin outputs HTML content with [Bootstrap](http://getbootstrap.com/) tags and styles.

The markdown skin simply outputs markdown content. So this is mainly for testing purposes.

### Syntax

* [Paragraphs and Line breaks](#paragraphs-and-line-breaks)
* [Headers](#headers)

#### Paragraphs and Line breaks

The paragraph handling is depending which parser role is set (**traditional** or **gfm**).

If parser mode is **traditional** then paragraph is simply one or more consecutive lines of text, separated by one or more blank lines.

If parser mode is **gfm** then above rule is apply, but single newline open separate line in same paragraph. 

```no-highlight
Here's a line for us to start with.

This line is separated from the one above by two newlines, so it will be a **separate paragraph**.

This line is also a separate paragraph, but...
This line is only separated by a single newline, so it's a separate line in the **same paragraph**.
```

Here's a line for us to start with.

This line is separated from the one above by two newlines, so it will be a **separate paragraph**.

This line is also a separate paragraph, but...
This line is only separated by a single newline, so it's a separate line in the **same paragraph**.

---
[Back to top][top]

#### Headers

Markdown support two header types (setext or atx).

```no-highlight
# H1
## H2
### H3
#### H4
##### H5
###### H6
```

# H1
## H2
### H3
#### H4
##### H5
###### H6

Alternatively, for H1 and H2, an underline-ish style:

```no-highlight
Alt-H1
======

Alt-H2
------
```

Alt-H1
======

Alt-H2
------


---
[Back to top][top]

## License

This package is licensed under the MIT License

---
[Back to top][top]

[top]: #laravel-5-markdown-parser
