# Pyxl Starter Theme
__Version__: 2.1.0

## Best practices

### Don't build functionality into the theme, that's what plugins are for.
    * [Simple Plugin Starter Repo](https://bitbucket.org/pyxlinc/wordpress-plugin-starter)
    * Plugins are for logic
    * Themes are just for presentation
    * If the theme was changes, would our client still have the functionality of their site?
### Keep your code in small chunks and use build process imports
    * Sass: `@import`
    * JS: `import example from 'modules/example';`
    * PHP: Create Single responsibility, namespaced classes and take advantage of small static functions
### Write Secure Code
[Escape your output as late as possible (like when you're using `echo` in a template)](https://danielbachhuber.com/tip/escaping-output/)
#### `esc_html` for most post meta data (you should be using this the most)
```php 
<h2> <?php echo esc_html($subtitle); ?> 
```
#### `esc_attr` for element attributes
```php 
<section class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <form action="">
        <input type="text" name="fname" value="<?php echo esc_attr( $fname ); ?>">
    </form>
</section>
```
#### `esc_url` for any link
```php
<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
```
#### `wp_kses_post` for mixed content (Like output from a WYSIWG)
```php
<?php echo wp_kses_post( get_post_meta( $post_id, 'wysiwg_content', true ) ); ?>
```

### Resources:
* [10up Best Practices](https://10up.github.io/Engineering-Best-Practices/)
* [PHP Standards Recommendations](https://www.php-fig.org/psr/)
* [WordPress VIP](https://vip.wordpress.com/documentation/best-practices/)
## Features
* __Modern PHP__
    * [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
    * Namespacing (via `Pyxl/Theme`)
    * [Simple PSR-4 Autoloader](https://www.php-fig.org/psr/psr-4/)
* [__Bootstrap 4.0__](https://getbootstrap.com/)
* [__Font Awesome 5__](https://fontawesome.com/)
* [__SVG Sprite Symbols__](https://css-tricks.com/svg-symbol-good-choice-icons/)
* [__Modern JS via Babel__](https://babeljs.io/learn-es2015/)
    * Modules / Importing
    * Arrow Functions
    * Let + Const
    * ...and more
## Getting Started

### Install

`cd path/to/themes/`

`git clone https://bitbucket.org/pyxlinc/wordpress-starter-theme/`

`yarn install` || `npm install`

`yarn build` || `npm run build`

### Sass

* Review `@imports` in `/src/scss/vendors/*` (unlikely you need all of them)

* See __Bootstrap__ examples: https://getbootstrap.com/docs/4.0/examples/

### JavaScript

Gulp and Webpack are working in unison here, the `scripts` task is using `webpack-stream`

#### Modules

Don't create a huge 300+ line file, break it up. Think about creating small parts of reusable code.

__Example:__ (Note: Ramda is not required; just an opinionated example.)

`src/scripts/global.js` 
```js
import {pipe} from 'ramda';
import mobileMenu from './navigation/mobileMenu';
import webfont from './imports/webfont';

pipe(
    webfont,
    mobileMenu,
)();
```
We're importing a small function from __Ramda__ (not the whole library) to use a compose-like function to run our modules in order.

[Ramda documentation](http://ramdajs.com/docs)

`src/scripts/navigation/mobileMenu.js` 
```js
export default () => {
    const button = document.getElementById('mobileNavTrigger');
    button.addEventListener('click', e => {
        button.setAttribute('aria-expanded', 'true');
    })
}
``` 

#### jQuery

To utilize jQuery in one of your `.js` files add the following at the top of your file:

```js
import $ from 'jquery';

let button = $('button');
let content = $('.content');
button.click(() => {
    button.addClass('active')
    content.hide();
});
```

[See Webpack Documentation for more information about "externals"](https://webpack.js.org/configuration/externals/)

* __Important:__ Don't bundle `jQuery`. Some plugin you use is probably going to try to call the WordPress core version anyways (meaning you'd end up with the library being pulled in twice).
    * It can be swapped with a CDN version (*coming soon:* look for a __Pyxl WordPress Preferences__ plugin in bitbucket)
* Avoid document ready if not explicitly needed.  We're already loading in the footer and nearly all DOM elements should exist.
* Set DOM selectors to variables like `let` or `const` for reusability and performance


## Can't find something? 

[Here's a snippet of with some of the old files you might used to seeing](https://bitbucket.org/snippets/Mizner/zeaKej)
 