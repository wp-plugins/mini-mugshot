=== Mini Mugshot ===
Contributors: JeremyVisser
Tags: mugshot, flash, widget
Requires at least: 2.2
Tested up to: 2.7
Stable tag: 1.0

Add your Mini Mugshot to your sidebar as a widget, or insert it into any post or page.

== Description ==

Mini Mugshot is a widget that displays the latest items from your [Mugshot](http://mugshot.org/) feed on your WordPress blog. The Mini Mugshot widget can be displayed as a sidebar widget, or in a post or page.

== Installation ==

Installing Mini Mugshot is easy. If you want to add your Mini Mugshot to your blog's sidebar, all you have to do is:

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the Plugins menu in WordPress
1. Add the Mini Mugshot sidebar widget from the Appearance → Widgets menu in WordPress
1. You're done!

If you want to add your Mini Mugshot to a post or page, please see the Usage section for instructions.

== Usage ==

= Sidebar widget =

After activating the Mini Mugshot plugin, you will find a new widget (by the name of Mini Mugshot) to add to your blog's sidebar. You have three sizes to choose from:

* Mini (does not show activity)
* 3-line
* 5-line
* Now Playing (only shows music played)

To have your personalised Mini Mugshot shown, you will first need to enter in your Mugshot profile URL. To do this:

1. Visit [mugshot.org](http://mugshot.org/) (if you are not logged in, please log in).
1. The URL in your browser's address bar will change to look something like this: `http://mugshot.org/person?who=G3yH5GwMpAN1DW`.
1. Copy the URL in your browser's address bar, and paste it in the appropriate place in the widget configuration.

= Inline post or page =

You can display your Mini Mugshot plugin in a post or page, but only after you have installed the [fauxML](http://wordpress.org/extend/plugins/fauxml/) plugin. Once you have installed fauxML, you can type in the following text inside a post or page to have your Mini Mugshot displayed:

* [mugshot url]

You will need to find your Mugshot profile URL and put it in place of the word "url" in the above syntax. You can also use these variations to get different sizes:

* [mugshot-mini url]
* [mugshot-3 url]
* [mugshot-5 url]
* [mugshot-nowplaying url]

== Frequently Asked Questions ==

= Where can I add Mini Mugshot? =

You can add Mini Mugshot to a post or page, or to your sidebar as a widget.

= How do I add my Mini Mugshot to a post or page? =

Please see the Usage section for instructions on how to do this. If it doesn't work, check that the [fauxML](http://wordpress.org/extend/plugins/fauxml/) plugin is installed and activated.

= My theme doesn't use widgets! How can I add the Mini Mugshot to the sidebar? =

Use the following code in `sidebar.php`:

`<?php echo mini_mugshot::output('http://mugshot.org/person?who=G3yH5GwMpAN1DW', 'mini') ?>`

You'll need to edit the above example to include your own Mugshot profile URL, and choose between the "mini", "3", "5", and "nowplaying" styles.

