== Changelog ==

= 1.2 - Sep 13 2013 =
* Correct missing closing quote in Quote post format that caused broken links.
* Update bundled Tonesque and Color libraries; namespace the Color library.
* Update to Genericons 2.09

= 1.1 - Jul 22 2013 =
* Cleaned up content templates and remove redundant title attributes.
* Uses term description rather than taxonomy-specific descriptions.
* Moved away from using deprecated functions and improved compliance with .org theme review guidelines.
* Updated license.
* Make sure the private var $color exists inside the Tonesque instance before attempting to get a maxcontrast value from it. This prevents a fatal error when the processed file is not gif, png, jpg, or jpeg.
* Tweaked the slideshow style to match.
* Reset the default padding for VideoPress.
* Cleaner way to check if social links need be displayed.
* Move the style adjustments for the contact form out from WP.com to Jetpack.
* Lets the Customizer hides/displays the header texts.
* Disabled hover card in the Custom Header admin.
* Removed all @since DocBlocks.
* Uses imagecolorsforindex for creating the colors in rgb values to avoid issues with gif images.

= 1.0 - Apr 11 2013 =
* Initial release.
