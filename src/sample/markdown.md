**Table of content**

* [Headers](#headers)
* [Emphasis](#emphasis)
* [List](#list)
* [Links](#links)
* [Code and Syntax highlight](#code-and-syntax-highlightT)
* [Tables](#tables)
* [Blockqoutes](#blockqoues)
* [Inline HTML](#inline-html)
* [Line breaks](#line-breaks)
* [Horizontal rule](#horizontal-rule)

# Headers

# H1
## H2
### H3
#### H4
##### H5
###### H6

Alternatively, for H1 and H2, an underline-ish style:

Alt-H1
======

Alt-H2
------

# Emphasis

Emphasis, aka italics, with *asterisks* or _underscores_asd_.

Strong emphasis, aka bold, with **asterisks** or __underscores__.

Combined emphasis with **asterisks and _underscores_**.

Strikethrough uses two tildes. ~~Scratch this~~.

# Links

There are two ways to create links.

[I'm an inline-style link](https://www.google.com)

[I'm an inline-style link with title](https://www.google.com "Google's Homepage")

[I'm a reference-style link][Arbitrary case-insensitive reference text]

[I'm a relative reference to a repository file](../blob/master/LICENSE)

[You can use numbers for reference-style link definitions][1]

Or leave it empty and use the [link text itself]

Some text to show that the reference links can follow later.

As GFM syntax supports native URL, just simple write down URL and it turns into links http://example.com

[arbitrary case-insensitive reference text]: https://www.mozilla.org
[1]: http://slashdot.org
[link text itself]: http://www.reddit.com

# Images

Here's our logo (hover to see the title text):

Inline-style: 
![alt text](https://path/to/image.jpg "Image Title Text 1")

Reference-style: 
![alt text][image]

[image]: https://path/to/image.jpg "Image Title Text 2"

# Code and Syntax Highlighting

Code blocks are part of the Markdown spec, but syntax highlighting isn't.
However, many renderers -- like Github's -- support syntax highlighting.
Which languages are supported and how those language names should be written
will vary from renderer to renderer.

Inline `code` has `back-ticks around` or ``double back-ticks`` it. You can escape
back tick via `` ` ``.

Blocks of code are either fenced by lines with three back-ticks <code>```</code>,
or are indented with four spaces. I recommend only using the fenced code blocks
-- they're easier and only they support syntax highlighting.

```javascript
var s = "JavaScript syntax highlighting";
alert(s);
```

```python
s = "Python syntax highlighting"
print s
```

```
No language indicated, so no syntax highlighting in Markdown Here (varies on Github). 
But let's throw in a <b>tag</b>.
```

    Also work indent with four spaces.
    
    But here is no syntax highlight.


# Lists

1. First ordered list item
2. Another item
  * Unordered sub-list. 
1. Actual numbers don't matter, just that it's a number
  1. Ordered sub-list
4. And another item.

   You can have properly indented paragraphs within list items. Notice the blank line above, and the leading spaces (at least one, but we'll use three here to also align the raw Markdown).

   To have a line break without a paragraph, you will need to use two trailing spaces.  
   Note that this line is separate, but within the same paragraph.  
   (This is contrary to the typical GFM line break behaviour, where trailing spaces are not required.)

* Unordered list can use asterisks
- Or minuses
+ Or pluses

# Tables

First Header  | Second Header
------------- | -------------
Content Cell  | Content Cell
Content Cell  | Content Cell

| First Header  | Second Header |
| ------------- | ------------- |
| Content Cell  | Content Cell  |
| Content Cell  | Content Cell  |

| Name | Description          |
| ------------- | ----------- |
| Help      | Display the help window.|
| Close     | Closes a window     |

| Name | Description          |
| ------------- | ----------- |
| Help      | ~~Display the~~ help window.|
| Close     | _Closes_ a window     |

| Left-Aligned  | Center Aligned  | Right Aligned |
| :------------ |:---------------:| -----:|
| col 3 is      | some wordy text | $1600 |
| col 2 is      | centered        |   $12 |
| zebra stripes | are neat        |    $1 |

# Escape

The following characters can escape by prepending \\ character

* \\
* \`
* \*
* \_
* \{
* \}
* \[
* \]
* \(
* \)
* \#
* \+
* \-
* \.
* \!