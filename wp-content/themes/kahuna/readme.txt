===Kahuna===

Contributors: Cryout Creations
Requires at least: 4.5
Tested up to: 6.3
Stable tag: 1.7.0
Requires PHP: 5.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://www.cryoutcreations.eu/donate/

Copyright 2017-2023 Cryout Creations
https://www.cryoutcreations.eu/

== Description ==

Kahuna is the big kahuna among WordPress themes. It proved itself with an exotic design, effective and easy to use customizer settings and a responsive, fully editable layout. Many personal and business sites have embraced it for a wide spectrum of uses, ranging from portfolio and photography sites to blogs and online shops. The features are too many to list but here are some of the main attractions: translatable, search engine optimized (both microformats and micordata), supports RTL (right-to-left) languages, supports eCommerce (WooCommerce), has both wide and boxed layouts, masonry bricks, socials, Google fonts, typography options, and a great customizable landing page.

== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Kahuna WordPress Theme bundles the following third-party resources:

HTML5Shiv, Copyright Alexander Farkas (aFarkas)
Dual licensed under the terms of the GPL v2 and MIT licenses
Source: https://github.com/aFarkas/html5shiv/

FitVids, Copyright Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
Licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

== Bundled Fonts ==

Source Sans Pro, Copyright Adobe Systems Incorporated
Licensed under the terms of SIL Open Font License, Version 1.1.
Source: https://github.com/adobe-fonts/source-sans-pro/

Poppins, Copyright Indian Type Foundry
Licensed under the terms of SIL Open Font License, Version 1.1.
Source: https://github.com/google/fonts/tree/master/ofl/poppins

Icomoon icons, Copyright Keyamoon.com
Licensed under the terms of the GPL license
Source: https://icomoon.io/#icons-icomoon

Zocial CSS social buttons, Copyright Sam Collins
Licensed under the terms of the MIT license
Source: https://github.com/smcllns/css-social-buttons

Entypo+ icons, Copyright Daniel Bruce
Licensed under the terms of the CC BY-SA 4.0 license
Source: http://www.entypo.com/faq.php

== Bundled Images ==

The following bundled images are released into the public domain under Creative Commons CC0:
https://www.pexels.com/photo/adult-agreement-beard-beverage-541522/
https://www.pexels.com/photo/light-desk-pencil-picture-73526/
https://www.pexels.com/photo/people-notes-meeting-team-7095/
https://pixabay.com/en/aerial-view-green-grass-trees-2563791/

The rest of the bundled images are created by Cryout Creations and released with the theme under GPLv3


== Changelog ==

= 1.7.0 =
*Release Date - 2023.09.19*

* Added interactive hint to WordPress' Homepage Settings panel while using the landing page with a static homepage
* Improved support for bare homepage content by removing the minimum height
* Improved accessibility and main menu keyboard navigation
* Renamed 'striped' tables option and CSS classname
* Fixed comments markup displaying erroneous 'itemprop'
* Updated to Cryout Framework 0.8.6.4

= 1.6.3 =
*Release Date - 2022.10.30*

* Added 'kahuna_box_readmore' filter for landing page featured boxes read more texts
* Added support for using the associated featured images as header images on the static home and blog pages
* Added gracefull fallback for 'menu-over-header' when no header image is present
* Improved JS compatibility with ShiftNav plugin
* Improved single posts fixed next/previous navigation by moving it to hookable kahuna_fixed_nav_links() function and limiting links to same taxonomy
* Improved compatibility with script name collision in deferring check by increasing specificity
* Improved compatibility with sub-optimal SSI configurations
* Fixed isinViewport() is undefined error since 1.6.2
* Fixed portfolio type lists displaying slugs instead of properly formatted names
* Fixed featured images using the incorrect width in 3 post columns / left sidebar only configuration
* Fixed a typo in the font weight selectors
* Updated to Cryout Framework 0.8.6.3:
	* Improved Safari mobile browser detection for iPhones and iPads (for better handling of rendering quirks in social apps)
	* Fixed fatal error on Customize screen due to inconsistent handling of empty categories since WordPress 6.0
	* Fixed 'Disable' and 'All Categories' options not available in category selector options on sites with no categories defined
	* Added static blog page detection function (for featured images in header)
	* Added Polylang support for featured boxes category filtering (thanks to espasso)
	* Improved PHP 8 compatibility

= 1.6.2 =
*Release Date - 2021.03.08*

* Fixed absolute next/previous post nav not working
* Fixed header/main menu missing background color in over-image mode on smaller screen sizes
* Fixed "Inherit General Font" option not working as expected
* Fixed menu in over-image mode overlapping content when header image is not available or hidden
* Fixed block editor galleries layout
* Fixed block editor font sizes using the incorrect 'regular' slug
* Fixed team members photos having a weird aspect ratio after Team Members plugin update
* Fixed text indent option adding indentation to icons (including shortcodes)
* Fixed search form overlapping mobile menu elements with small general font sizes
* Fixed header titles vertical misalignment on landing page with specific configurations
* Fixed left sidebar navigation not being displayed when there are no widgets assigned
* Improved main navigation fallback markup
* Renamed landing page 'static image' element to 'banner image' for clarity
* Removed all padding/margins from before/after content and top/bottom inner widget areas
* Improved support for menu customizations plugins
* Added click-navigation to target panels in header content and site identity hints
* Added configuration hint for header image when the theme's slider / banner image is active on the homepage
* Cleaned up and optimized frontend scripts, including for WordPress 5.5/5.6 jQuery updates
* Updated to Cryout Framework 0.8.5.7:
	* Expanded hint control styling to apply in the Site Identity panel
	* Fixed multi-font choices failing to apply correctly
	* Added echo parameters to cryout_schema_microdata() and cryout_font_select() functions
	* Improved breadcrumbs compatibility with plugins that filter section titles and add HTML markup
	* Improved JS code to remove jQuery deprecation notices since WordPress 5.6
	* Changed custom post type label in breadcrumbs from singular_name to name
	* Better cleaning of weights in font enqueues
	* Added the ability to inherit the general font on all other font control options
	* Fixed color selector malfunction since WordPress 5.3
	* Fixed Select2 selectors no longer working with WordPress 5.6 on Firefox
	* Removed PHP and WP versions checks as these are now handled by WordPress
	* Additional sanitization and even more sanitization changes to comply with current wp.org requirements

= 1.6.1.1 =
*Release Date - 2020.07.16*

* Fixed too much accessibility on the search icon

= 1.6.1 =
*Release Date - 2020.07.13*

* Added 'Tested up' to and 'Requires PHP' header fields in style.css
* Added accessibility for mobile menu
* Enabled header socials menu location by default when a social menu exists
* Fixed plural forms in comments count for more complex languages - https://codex.wordpress.org/I18n_for_WordPress_Developers#Plurals
* Fixed non-prefixed global variable in content.php
* Fixed logo using incorrect height after assignment in the customize preview
* Renamed content/author-bio.php file to content/user-bio.php to avoid name colision with WordPress' templating system
* Code cleanup and sanitization improvements according to the theme sniffer rules
	* Fixed empty else statements in core.php, landing-page.php, styles.php
* Removed extended compatibility support for Polylang/WPML and Loco Translate due to WordPress.org no longer accepting XML files in themes
* Updated to Cryout Framework 0.8.5(.1):
	* Fixed color selector malfunction since WordPress 5.3
	* Additional sanitization

= 1.6.0.1 =
*Release Date - 2020.03.10*

* Fixed a possible warning due to malformed number format in custom-styles.php
* Fixed some missing styles shared with the Plus edition

= 1.6.0 =
*Release Date - 2020.03.05*

* Added 'wp_body_open' action hook support for WordPress 5
* Added 'kahuna_header_image' and 'kahuna_header_image_url' filters to allow custom control over featured images in header functionality
* Added option to disable default pages navigation and improved mobile menu functionality to hide toggler when main navigation is empty
* Added visibility on scroll functionality on the fixed menu on mobile devices
* Added support for future child themes
* Improved main navigation usability on tables by adding the option to force the mobile menu activation
* Improved landing page icon blocks responsiveness
* Improved dark color schemes support for HTML select elements
* Improved list bullets styling in landing page text areas
* Improved mobile menu dark color schemes support by using non-link texts to use the configured menu text color
* Updated fixed menu styling to account for WordPress admin bar responsiveness breakpoints changes
* Fixed animated featured boxes displaying an extra bottom margin when the 'read more' button is not used
* Fixed static slider images larger than the screen being distorted instead of cropped to fit the screen
* Fixed breadcrumbs missing link on home icon on WooCommerce pages
* Fixed Gutenberg lists displaying bullets outside of content on landing page sections
* Fixed header video not being horizontally centered
* Fixed back-to-top button sometimes failing to display on short pages
* Improved keyboard navigation accessibility:
	* Added 'skip to content' link
	* Added focus support for post featured images, landing page featured boxes, landing page portfolio, main navigation search form
	* Converted menu close element to button
* Updated to Cryout Framework 0.8.4.1:
	* Optimized options migration check to reduce calls
	* Fixed 'Too few arguments' warning in breadcrumbs on Polylang multi-lingual sites
	* Removed news feed from theme's about page per TRT requirements - https://themes.trac.wordpress.org/ticket/73150#comment:3

= 1.5.1 =
* Improved Google Fonts functionality to load all weights for the general font
* Improved footer widgets responsiveness when set to center align
* Improved content spacing on single pages/posts when comment form is not displayed
* Fixed normalized tags still having different sizes
* Disabled search form display on the landing page when no posts are available
* Multiple fixes for older IEs
* Updated to Cryout Framework 0.8.2:
	* Activated Select2 functionality on font selector controls
	* Fixed RTL issues with color controls, toggle controls, half/third width selectors, number slider
* Updated to Cryout Framework 0.8.1
	* Added Select2 functionality to icon-select controls

= 1.5.0.1 =
* Fixed cryout_get_layout() function call that caused errors on PHP 5

= 1.5.0 =
* Added option to control featured images in the header size enforcement
* Improved translations support for the framework strings using the second textdomain with Loco Translate
* Improved page/post meta options support for the block editor
* Improved block editor styling for dark color schemes
* Optimized layout detection code and moved to the framework
* Optimized frontend scripts
* Fixed editor style option not applying to the block editor styling
* Fixed deferring functionality applying to some dashboard scripts
* Fixed $content_width not being defined in the dashboard
* Fixed 'continue reading' button being cropped on layoust with a single column
* Renamed top and bottom widget areas for clarity
* Renamed and rearranged some theme options for consistency between themes
* Disabled featured images on post formats
* Updated to Cryout Framework 0.8:
	* Switched enable/disable options to use the new toggle control
	* Switched number options to use the new number slider control

= 1.4.0.2 =
* Fixed notice about malformed number format in setup.php since 1.4.0
* Fixed Gutenberg editor background color missing

= 1.4.0.1 =
* Fixed notice about malformed number format in custom-styles.php since 1.4.0
* Fixed classic editor styling not working since 1.4.0

= 1.4.0 =
* Gutenberg editor tweaks and improvements:
	* Added styles for the new block horizontal separators
	* Added editor styles for the Gutenberg editor
	* Added support for theme colors and font sizes in the Gutenberg editor
	* Added wide image support
	* Improved list appearance in blocks
	* Fixed margins on gallery blocks
	* Fixed caption alignment in blocks
	* Fixed cover block text styling
	* Fixed block embeds responsiveness conflict with Fitvids script

= 1.3.3 =
* Improved Gutenberg galleries content alignment
* Improved standards compliance cleanup sometimes breaking erroneous CSS styling
* Improved mobile menu non-link text to use the configured navigation text color
* Fixed after content posts navigation incorrectly aligned when only one link is displayed
* Fixed back-to-top button being visible on mobile devices when disabled
* Fixed long submenus sometimes causing horizontal scrollbar with non-fixed menus
* Updated to Cryout Framework 0.7.8.5:
	* Improved manual excerpts detection in landing page blocks and boxes to detect <!--more--> and <!--nextpage--> tags

= 1.3.2 =
* Adjusted headings color option to apply to landing page text area inner headings as well
* Added some missing options visibility conditional checks
* Fixed 'comment' not being translatable with PoEdit in the comment form
* Fixed WP Globus translations not working in landing page icon blocks excerpts (should improve support for other plugins as well)
* Fixed manual excerpts being filtered in featured boxes
* Updated Cryout Framework to 0.7.8.4

= 1.3.1.1 =
* Fixed an animation glitch affect submenu items
* Updated Cryout Framework to v0.7.8.2:
	* Fixed landing page sometimes ending unexpectedly while WPML is used

= 1.3.1 =
* Added landing page featured icon blocks overall disable option
* Added support for shortcodes in custom footer text field
* Fixed landing page icon blocks, featured boxes and text areas WPML support
* Fixed some animation hiccups on main navigation
* Fixed landing page content generation after first activation failing to retrieve all available static pages in some cases
* Rearranged landing page 'featured content' options to dedicated options section
* Cleaned up unused JS code applied to the landing page featured boxes
* Updated Cryout Framework to v0.7.8.1
	* Sorted icon block icons list alphabetically
	* Added required PHP version check
	* Improved required WordPress version check

= 1.3.0.1 =
* Fixed single post overlay navigation links overlapping content when hidden
* Fixed landing page text areas responsive behaviour for 960 to 1240px screen sizes
* Fixed landing page posts list responsive behaviour when layout set to 3 columns
* Fixed header image not visible when active on the landing page
* Fixed extra space between mobile menu placholder and header socials in some cases
* Actually fixed long site titles overlapping the mobile menu placeholder
* Updated Cryout Framework to 0.7.6.1

= 1.3.0 =
* Added support for custom embedded fonts
* Added main navigation keyboard accessibility support
* Added mobile menu close on click/tap functionality
* Added extra padding to main navigation submenus
* Added top margin to attachment pages
* Added hints in the customizer interface for Site Identity / Header options
* Improved Serious Slider's 'theme' style compatibility
* Improved landing page 'more posts' button loading animation
* Improved label hiding option to only apply to default comment form fields
* Improved mobile menu multi-line menu items behaviour
* Increased mobile menu width on smaller devices
* Changed post titles hover overline to underline
* Changed landing page text areas title/description order to be applied with CSS
* Changed landing page boxes, text areas and icon blocks top/bottom margins to be smaller
* Changed posts 'read more' text to uppercase
* Changed landing page featured boxes widths/margins
* Fixed first content title top spacing rule being too broad
* Fixed landing page boxes blur animation on Chrome
* Fixed two instances of H1 titles on static pages with header titles enabled
* Fixed missing landing page icon blocks titles and descriptions (since 1.2.0)
* Fixed landing page icon blocks container remaining visible when all icon blocks are disabled (since 1.2.0)
* Fixed unclosed span markup in landing page icon blocks output function
* Fixed GDPR-related checkbox missing on comment form
* Fixed Serious Slider 'theme' style caption title/text size responsiveness
* Fixed static slider positioning on <720px with RTL
* Fixed site tagline positioning with RTL
* Fixed long site titles overlapping the mobile menu placeholder
* Bumped required PHP version to 5.3

= 1.2.0 =
* Added support for WooCommerce breadcrumbs
* Added landing page icon blocks read more links
* Added query resets to landing page custom queries
* Added featured box titles link functionality
* Added compatibility styling for Jetpack Portfolio titles sizes in widgets
* Improved on-page SEO
* Improved tables styling
* Improved landing page customizer sections dependency checks
* Improved accessibility for landing page block icons, boxes links and titles, edit button, read more links and back-to-top button
* Improved scroll-to-anchor functionality
* Improved first content title above spacing
* Improved header title to use H2 instead of H1 tag on the homepage
* Fixed landing page featured page section using H1 tag for title
* Fixed HTML markup validation warning due to empty 'media' attribute
* Fixed CSS validation warnings due to empty color fields and invalid 'default' values
* Fixed header breadcrumbs alignment on boxed layout
* Fixed language flag images being improperly aligned in menus
* Fixed sidebars margins/padding applied improperly on boxed layouts
* Fixed landing page icon blocks design when clickable
* Fixed site title border visible and taking up space when site title is hidden
* Fixed cover+fixed background images zoomed incorrectly on Safari
* Fixed cover+fixed background images shaky on IEs and Edge
* Removed posts navigation on smaller mobile devices (<640px width)
* Updated to Cryout Framework v0.7.5

= 1.1.2 =
* Fixed landing page featured boxes not being disable-able due to incorrect check
* Fixed incorrect menu items alignment on RTL languages

= 1.1.1 =
* Adjusted font size for masonry article titles (made them smaller)
* Fixed content breadcrumbs missing background color
* Fixed header widget area overlapping header titles
* Removed 'defer' loading of comments script

= 1.1.0 =
* Improved featured image srcset functionality to support more browsers and usage scenarios
* Improved edit button text color styling for dark backgrounds
* Improved compatibility of dark color schemes with Crayon Syntax Highlighter plugin's editor styling
* Improved 'comments moderated' text positioning
* Improved demo content check to use theme slug
* Improved sublists appearance in sidebar widgets
* Added all weight values for the typography options
* Added icon to comments reply button
* Added icon to excerpt read more button
* Changed featured image icon to arrow
* Relocated Header Titles options panel under General
* Fixed non working translation in article publish date
* Fixed page layout option overlapping category/search/archive layout when last item uses custom layout
* Fixed and disabled header titles functionality on WooCommerce sections
* Fixed header titles not following the separate option on home static page
* Fixed header titles to use the correct page title on the 'blog' section
* Fixed comments block being visible on landing page featured page
* Fixed missing saturation animation for cropped featured images
* Fixed site title and tagline animation
* Removed header image blur effect as it was malfunctioning on Chrome
* Removed leftover right margin from post tiles in lists
* Improved headings titles handing of custom post types and content
* Updated to Cryout Framework 0.7.3:
	* Framework: fixed invalid count() call in prototypes.php triggering warnings on PHP 7+
	* Framework: added cryout_get_picture(), cryout_get_picture_src(), cryout_is_landingpage(), cryout_on_landingpage() functions

= 1.0.1 =
* Fixed landing page static image responsiveness and improved compatibility with Serious Slider
* Fixed widgets losing padding on screens smaller than 1024px for sidebars with a background color set
* Post metas are now always visible over the featured images on screens smaller than 800px
* Fixed breadcrumbs under the header having too much padding on mobile
* Added alt attribute to landing page text area images
* Fixed notice in custom styling

= 1.0.0 =
* Fixed image background color on landing page featured boxes
* Adjusted breadcrumbs background
* Fixed theme overriding some Serious Slider buttons styling
* Fixed site tagline misaligned on homepage header when landing page is not used
* Removed 'comment-list' and 'search-form' from add_theme_support('html5') per review request

= 0.9.3 =
* Fixed landing page featured boxes category selector not working since 0.9.2
* Fixed missing text areas numbers in theme options
* Fixed non-translatable strings in theme options
* Added auto-match for mailto: URL in social icons
* Improved masonry initiation to check if function is available
* Increased content headers line-height to 1.2
* Fixed extra space under menu when main menu is set to fixed and on top of header image with boxed layout when no header image is set
* Added workaround for horizontal scrollbar on mobile devices when large menus are used

= 0.9.2 =
* Added integrated styling for our Serious Slider plugin
* Added preliminary support for Polylang (and theoretically WPML) multi-language content for all landing page elements
* Adjusted responsiveness of static slider image to better fit screen
* Fixed admin bar overlapping mobile menu
* Renamed $kahuna variables to be more generic
* Fixed editor styling option not controlling style.css enqueue
* Fixed featured boxes not deactivating by setting the category to 'disabled'
* Fixed dropdown menu width issue in Chrome with very short menu items
* Fixed missing edit button on single posts
* Fixed author pages displaying empty biography area
* Adjusted static slider CTA buttons styling to be more generic
* Fixed static slider caption container being displayed when no static slider caption fields are used

= 0.9.1 =
* Changed article markup to improve search engine readability (separated actual article content from article extra information)
* Changed comment headers to ‘footer’ elements
* Changed author bio div to ‘section’ element
* Changed default landing page appearance and images
* Changed default screenshot.png
* Fixed hardcoded colors for the submenu, colophon, static boxes and icon blocks
* Added color option for landing page posts/ static page
* Added links to landing page boxes titles and images
* Adjusted the 'leave a comment' meta line-height
* Fixed footer responsiveness
* Added zoom in / zoom out animations for articles
* Fixed site title overlapping menu icon on mobile

= 0.9 =
* Initial release
