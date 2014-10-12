=== Image Zoom ===

Author: SedLex
Contributors: SedLex
Author URI: http://www.sedlex.fr/
Plugin URI: http://wordpress.org/plugins/image-zoom/
Tags: 
Requires at least: 3.0
Tested up to: 3.5
Stable tag: trunk

Allow to dynamically zoom on images in posts/pages/... 

== Description ==

Allow to dynamically zoom on images in posts/pages/... 

When clicked, the image will dynamically scale-up. Please note that you have to insert image normally with the wordpress embedded editor.

You may configure:

* The max width/height of the image; 
* The transition delay; 
* The position of the buttons; 
* The auto-start of the slideshow; 
* the opacity of the background; 
* the pages to be excluded. 

If the image does not scale-up, please verify that the HTML looks like the following : &lt;a href=' '&gt;&lt;img src=' '&gt;&lt;/a&gt;.

This plugin implements the colorbox javascript library. 

This plugin is under GPL licence.

= Multisite - Wordpress MU =

This plugin is compatible with multi-site installation.

= Localization =

* Arabic (Syria) translation provided by aboRoma
* Bulgarian (Bulgaria) translation provided by Vangelov, KalinLynnDimitrov
* Czech (Czech Republic) translation provided by jurajh, LukasProkop
* German (Germany) translation provided by tcp443, B.Klein, Frutte
* English (United States), default language
* Spanish (Spain) translation provided by genteblackberry, Wildsouth
* French (France) translation provided by SedLex, mediacop, FlorianP., LaurentChemla
* Croatian (Croatia) translation provided by Rene
* Hungarian (Hungary) translation provided by Metoyou, DvnyiFerenc
* Lithuanian (Lithuania) translation provided by ydrius
* Dutch (Netherlands) translation provided by PC-Rider, Erik
* Polish (Poland) translation provided by rzuf
* Russian (Russia) translation provided by sever, Sprigin, vyachek
* Vietnamese (Viet Nam) translation provided by Khco

= Features of the framework =

This plugin uses the SL framework. This framework eases the creation of new plugins by providing incredible tools and frames.

For instance, a new created plugin comes with

* A translation interface to simplify the localization of the text of the plugin ; 
* An embedded SVN client (subversion) to easily commit/update the plugin in wordpress.org repository ; 
* A detailled documentation of all available classes and methodes ; 
* etc.

Have fun !

== Installation ==

1. Upload this folder image-zoom to your plugin directory (for instance '/wp-content/plugins/')
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to the 'SL plugins' box
4. All plugins developed with the SL core will be listed in this box
5. Enjoy !

== Screenshots ==

1. The configuration page of the plugin
2. An image zommed

== Changelog ==

= 1.6.6 =
* Modification of the plugin URL

= 1.6.5 =
* Sometime there is some bug with the url of the cursor ... probably due to browsers.

= 1.6.4 =
* Wordpress gallery is now supported
* Click on the image may close the slideshow

= 1.6.3 =
* You can now disable the button if you do not like them

= 1.6.2 =
* Add a new theme with button out of the image

= 1.6.1 =
* Bug when the link points to an post url

= 1.6.0 =
* Detect image when the url is not an url to the media file
* Possibility to add the title or the alt text

= 1.5.0 -&gt;1.5.9 =
* Activation issue
* Issue 500 error with wordpress
* Update of the core
* Issue with the new version of wordpress
* Some pages may be excluded thanks to a plurality of regexps
* Debug and multisite support
* Add a warnig if the header contains a jquery reference
* Three themes added
* Remove the title displayed at the top of the image (will be possible in next release optionally)
* Due to the restriction by Wordpress it is forbidden to include Creative Common code in plugin. So, I was asked to change the javascript code to a GPL code. I am sorry if some features that you used have disapear but the library does not provide exactly the same features ... That's why ! 

= 1.4.0 -&gt; 1.4.1 =
* The regex has been extended to accept more types of images
* Major update of the framework

= 1.3.0 -&gt; 1.3.4 =
* Update of the German translations
* Conflict with the "Google Analytics for WordPress" plugin
* Bulgarian translation (by Vangelov)
* Vietnamese translation (by Khco) 
* Croatian translation (by Rene)
* Major Update of the core
* Improve the look and feel
* Now you may modify the text displayed in the frontend (Features requested by Rene)

= 1.2.0 -&gt; 1.2.2 =
* Hungarian translation (by Metoyou and DvnyiFerenc)
* It is possible to activate the slideshow upon start (auto-start)
* SVN support for committing changes

= 1.1.0 -&gt; 1.1.3 =
* Bug correction (conflict between prototype library and jQuery library)
* Update of the German translation by Frutte
* Czech translation (by jurajh) 
* Update of the core plugin (bug correction on the hash of the plugin/core)
* Update of the core plugin
* Update of the Russian translation by Sprigin
* New translation for Russian made by Sprigin 
* New translation for German made by Frutte
* New translation for Spanish made by genteblackberry 

= 1.0.2 -&gt; 1.0.7 =
* ZipArchive class has been suppressed and pclzip is used instead
* Ensure that folders and files permissions are correct for an adequate behavior
* Enhance the framework (feedback, other plugins, translations)
* Correction of a bug in the load-style.php which change dynamically the url of the image contained in the CSS file
* Enable the translation of the plugin (modification in the framework, thus all your plugin developped with this framework can enable this feature easily)
* Add the email of the author in the header of the file to be able to send email to him
* Enhance the localization of the plugin
* The javascript function to be called for table cell can have now complex parameters (instead of just the id of the line)
* Add the French localization
* Add a form to send feedback to the author
* Major release of the framework (3.0)
* Bug correction (thanks to Chipset): block property of images was cleared and this action could have change their paginations
* First release in the wild web (enjoy)

== Frequently Asked Questions ==

* Where can I read more?

Visit http://www.sedlex.fr/cote_geek/
 
 
InfoVersion:4307132bd4579c5253c4e2b069390c9b