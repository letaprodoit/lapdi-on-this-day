=== LAPDI On This Day ===
Contributors: letaprodoit,sharrondenice
Donate link: https://letaprodoit.com/apps/plugins/wordpress/on-this-day-for-wordpress
Tags: on this day display gallery slider jquery moving boxes the software people
Requires at least: 3.5.1
Tested up to: 5.6.1
Stable tag: 1.0.8
License: Apache v2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

On This Day allows you to view blog posts with the same month and day in history on your blog (similar to Facebook's "On This Day" app).

== Description ==

On This Day allows you to view blog posts with the same month and day in history on your blog's website (similar to Facebook's new "On This Day" App) via widget or on pages and posts using shortcodes. On This Day has five (5) layouts and can include thumbnails, post gallery and quotes.

= Shortcodes =

Add `On This Day` to posts and pages by using a shortcode inside your text or evaluated from within your theme. You may override page/post `On This Day` options with shortcode attributes defined on the plugin's settings page.

* `[tsp-on-this-day]` - Will display posts with the default options defined in the plugin's settings page.
* `[tsp-on-this-day title="Title of Posts" keep_formatting="N" style="color: red;" max_words=10 show_quotes="N" show_thumb="Y" show_event_data="N" show_author="Y" show_date"N" display_type="0" show_private="N" show_text_posts="N" number_posts="5" excerpt_max=100 excerpt_min=60 post_class="" fpost_type="post" slider_width="865" slider_height="365 layout="0" order_by="DESC" thumb_width="80" thumb_height="80" read_more_text="more..." no_posts_msg="No Posts Found" before_title="" after_title=""]` - Will override all attributes defined on the plugin's settings page.

== Installation ==

BEFORE YOU BEGIN: Requires the installation and activation of [LAPDI Easy Dev Latest Version](http://wordpress.org/plugins/tsp-easy-dev)

1. Upload `tsp-on-this-day` to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. After installation, refer to the `LAPDI On This Day` settings page for more detailed instructions on setting up your shortcodes.
4. `On This Day` widgets can be added to the sidemenu bar by visiting `Appearance > Widgets` and dragging the `LAPDI On This Day` widget to your sidebar menu.
5. Add some widgets to the sidemenu bar, Add shortcodes to pages and posts (see Instructions)
6. View your site
7. Adjust your CSS for your theme by visiting `Appearance > Edit CSS`
8. Adjust the `Sliding Gallery` settings, if necessary, by visiting `Plugins > Editor`, Select `LAPDI On This Day` and edit the `tsp-on-this-day.css` and `js/slider-scripts.js` files
9. Manipulating the CSS for `#postSlider` and `#tspotd_article` entries changes the gallery and article styles respectfully

== Frequently asked questions ==

= I've installed the plugin but my posts are not displaying? =

1. Make sure the folder `/wp-content/uploads/` has recursive, 777 permissions

== Screenshots ==

1. On This Day displayed on the front-end.

== Changelog ==
= 1.0.8 =
* Bug fix. Fixed bug with posts not showing

= 1.0.7 =
* Bug fix. Null exception fix
* Maintenance

= 1.0.6 =
* Enhancement. Requires v2.0.0 of LAPDI Easy Dev

= 1.0.5 =
* Enhancement: Improved settings UI

= 1.0.4 =
* Enhancement: Using only TSP Easy Dev (Pro version no longer available.)

= 1.0.3 =
* Bug fix. Set PHP timezone to wordpress timezone.

= 1.0.2 =
* Bug fix. Fixed bug that stopped blog posts from loading

= 1.0.1 =
* Added in functionality to show posts for the current day or for the day of the current post

= 1.0.0 =
* Launch

== Upgrade notice ==
= 1.0.8 =
* Bug fix. Fixed bug with posts not showing

= 1.0.7 =
* Bug fix. Null exception fix
* Maintenance

= 1.0.6 =
Enhancement. Requires v2.0.0 of LAPDI Easy Dev

= 1.0.5 =
Enhancement: Improved settings UI

= 1.0.4 =
Enhancement: Using only TSP Easy Dev (Pro version no longer available.)

= 1.0.3 =
Bug fix. Set PHP timezone to wordpress timezone.

= 1.0.2 =
Bug fix. Fixed bug that stopped blog posts from loading

= 1.0.1 =
Added in functionality to show posts for the current day or for the day of the current post
