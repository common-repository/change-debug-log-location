=== Change Debug Log Location ===
Contributors: giuse
Tags: It changes the title and the location of the file debug.log.
Requires at least: 4.6
Tested up to: 6.4
Stable tag: 0.0.2
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Your website will not send any email in case of fatal errors.



== Description ==

Normally, if the debug is active, the file debug.log is included in the folder wp-content, and everybody can read it at https://your-domain.com/wp-content/debug.log/.

Activating Change Debug Log Location you will find the debug.log file in the main directory, but it will have a name that looks like debug-6583fb9c.log.

So only those who know the name will be able to find it.

Deactivating the plugin it will not delete the debug file, because we don't want you lose any information, of course you can delete it manually via FTP.

Moreover, after deactivating the plugin the debug will be disabled. If you need it, you should enable it again in wp-config.php.

Of course, if the debug is disabled because you don't need it (the default of WordPress), you also don't need this plugin. This plugin is only for those who need to read the debug.log file, but they don't want everybody can read it.


== Installation ==

1. Upload the entire `change-debug-log-location` folder to the `/wp-content/plugins/` directory or install it using the usual installation button in the Plugins administration page.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. After successful activation the debug log file will be in the main directory with a new title and the debug will be active.
4. All done. Good job!




== Changelog ==

= 0.0.2 =
* Checked WordPress 6.4

= 0.0.1 =
* First release
