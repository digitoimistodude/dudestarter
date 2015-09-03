## dudestarter -- A WordPress starter theme

This is a WordPress theme for starting new projects used by [Digitoimisto Dude Oy](https://www.dude.fi). It's heavily based on Automattic's [Underscores](https://github.com/Automattic/_s). The goal is to get feature rich theme for developers, but not bloated in any way.

![](https://pbs.twimg.com/media/CMTIcEOXAAEEvf_.png:large "Screenshot")

## Table of contents

1. [Please note before using](#please-note-before-using)
2. [License](#license)
3. [Features](#features)
    1. [Layout base & grid](#layout-base-grid)
    2. [Typography](#typography)
    3. [Development](#development)
    4. [Navigations included](#navigations-included)
    5. [Forms](#forms)
    6. [Effects](#effects)
    7. [WordPress & functions](#wordpress--functions)
    8. [Integrations](#integrations)
4. [What's left out from Underscores](#whats-left-out-from-underscores)
5. [Requirements](#requirements)
6. [Usage](#usage)
6. [Contributing](#contributing)

### Please note before using

Dudestarter is a **development theme**, so it has updates almost daily. By using this starter theme, you agree that the fonts can change, layout can change, everything can change, and they will, without a warning. Version 1 looked quite different than version 3. It was like a different theme. After all, this is a development theme for Dude's personal preferences and principles.

Dudestarter is not meant to be "a theme for everyone", so it doesn't have customizers (wp-admin options), easy functions, separated theme parts (except template-parts) or any specifically easy to use stuff. This is now open-sourced, but includes a lot of custom stuff that **will not** work out of the box.

If you for some crazy reason happen to use this theme as base, please note the theme won't necessarily be that much fun or won't necessarily look any good. This is just a plain skeleton and nothing else. I recommend using [Underscores](https://github.com/Automattic/_s) or [Sage](https://roots.io/sage/) if you need something more complete.

### License

Dudestarter is licensed with [The MIT License (MIT)](http://choosealicense.com/licenses/mit/) which means you can freely use this theme commercially or privately, modify it, or distribute it, but you are forbidden to hold Dude liable for anything, or claim that what you do with this is made by us.

### Features

#### Layout base & grid

* All good things from the latest [Underscores](https://github.com/Automattic/_s)
* Tiny bits and pieces, (the good) parts from [Bootstrap 3.1.1](https://github.com/twbs/bootstrap)
* [SASS](http://sass-lang.com/)-support (SCSS-syntax)
* CSS reset with a combination with Nicolas Gallagher's [normalize*css](https://github.com/necolas/normalize.css/) and Jonathan Neal's [sanitize.css](https://github.com/jonathantneal/sanitize.css)
* [Jeet](https://github.com/mojotech/jeet) Grid for SASS `@include col(1/100)`
* Parts from [Outline](https://github.com/matt-harris/outline)
* Miscellaneous custom dudemixins

#### Typography

* Scalable and responsive typography: Modified [Sassline 2.1](https://github.com/designbyjake/sassline)with a spice of [knife](https://github.com/Pushplaybang/knife), vertical rhythm / modular scale with `@include type-scale('size')` mixin
* Bunch of the most common modern webfonts preloaded locally by default (Lato, Open Sans, Source Sans Pro, Roboto, Montserrat) with [Sass Boilerplate's fontFace-mixin](https://github.com/magnetikonline/sassboilerplate/blob/master/fontface.scss)
* REM units with a combination of [drublic's px to rem mixin](https://github.com/drublic/Sass-Mixins/blob/master/partials/_rem.scss) `@include rem('padding', '10px)` and [knife](https://github.com/Pushplaybang/knife)  `@include krem('padding', '10px)`.
* [Font-Awesome](https://github.com/FortAwesome/Font-Awesome) Glyph icons

#### Development

* [BrowserSync](http://www.browsersync.io/) for keeping multiple browsers and devices synchronized while testing, along with injecting updated CSS and JS into your browser while you're developing
* [gulp](http://gulpjs.com/) build script that compiles both Less and Sass, checks for JavaScript errors, optimizes images, and concatenates and minifies files (see Dude's [devpackages](https://github.com/digitoimistodude/devpackages))
* [Bower](http://bower.io/) for front*end package management (see Dude's [devpackages](https://github.com/digitoimistodude/devpackages))

#### Navigations included

- [Flexnav-rolle](https://github.com/ronilaukkarinen/flexnav-rolle) - A jQuery plugin for responsive menus
- [Trunk.js](http://www.roblukedesign.com/trunk/trunk.html) - A responsive web design to hide top navigation into a navigation drawer on Tablets and Mobile Phones

#### Forms

* [Buttons](https://github.com/alexwolfe/Buttons) - A CSS button library built using Sass and Compass

#### Effects

* [saffron](https://github.com/colindresj/saffron) - A simple Sass mixin library for animations and transitions
- [Animate.css](http://daneden.github.io/animate.css/) - A cross-browser library of CSS animations. As easy to use as an easy thing.

#### WordPress & functions

* [Tommcfarlin's separated comments and pingbacks](https://gist.github.com/tommcfarlin/083f9a1212b872015e38)
* Don't count pingbacks or trackbacks when determining the number of comments on a post
* [Multilingual ready](https://roots.io/wpml/)
* All times and local units in Finnish
* More accurate time in WP Last Login
* Uploads folder: www.yoursite.com/media instead of www.yoursite.com/content/uploads
* Custom uploads folder instead of default content/uploads
* Default pages automatically selected for Front Page and blog home
* Hiding things customers won't usually need
* Automatic Feed Links in head
* Enable support for Post Thumbnails on posts and pages
* Editable navigation menus, custom dude navigation walker
* Disabled WordPress Admin Bar

#### Integrations 

* Dude's custom Facebook SDK for Facebook feeds
* Google Maps (Javascript API) for contact page

### What's left out from Underscores

Mostly not needed, because customizing so much stuff per project. (*Don't Repeat Yourself* mentality, noticed no need in projects and always have to remove anyway)

* Custom Header feature
* Template tags (except archives and post navigation, of course)
* Customizer additions
* Widgets
* No comments template on pages by default
* Right to left (RTL)

### Requirements

* Mac OS X (development only - not tested on other systems, but feel free to try on and report back)
* [Devpackages](https://github.com/digitoimistodude/devpackages) - Npm, Gulp and Bower
* [Dudestack](https://github.com/digitoimistodude/dudestack) - A toolkit for creating a new professional WordPress project with deployments. Heavily based on Bedrock by Roots.

### Usage

Go through [Dudestack Instructions](https://github.com/digitoimistodude/dudestack-instructions) to install vagrant development environment and dudestack. Then:

1. Clone this repository and unpack it to your project folder (or under test directory, for example for us it's `~/Projects/dudetest/content/themes/dudestarter`)
2. Edit `STARTERTHEMEPATH` to point out to dudestarter in `newtheme.sh`
3. Run `newtheme.sh` (requires [Dudestack](https://github.com/digitoimistodude/dudestack)'s `createproject` command to be run before)
4. `npm install`
5. Run `gulp watch` in project-folder
6. Start with `sass/base/themeoptions.scss` and continue editing from there. The main CSS file will always be `sass/layout.scss`.

### Contributing

If you have ideas about the theme or spot an issue, please let us know. Before contributing ideas or reporting an issue about "missing" features or things regarding to the nature of that matter, please read [Please note](#please-note-before-using) section. Thank you very much.