=== Conditional If/Then/Else Smart Tags for WPForms ===
Version: 1.0.1
Stable tag: 1.0.1
Tested up to: 6.7
Tags: conditional logic, conditional fields, wpforms, smart tags, forms
Plugin URI: https://wordpress.org/plugins/conditional-smart-tags-for-wpforms/
Author: Maximum.Software
Author URI: https://maximum.software
Contributors: maximumsoftware
Donate link: https://github.com/sponsors/maximum-software
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds a custom if-then-else smart tag syntax to conditionally show or hide content based on a field value in WPForms.

== Description ==

Conditional If/Then/Else Smart Tags for WPForms enhances your form by adding conditional logic capabilities through smart tags. This plugin allows you to display different content based on form field values.

= Features =

* Add if/then/else conditions where smart tags can be used
* Compare field values using exact match conditions

= Example Usage =

Use this syntax in your WPForms notifications or confirmations:

`{if field_id="3" value="TestValue"}
This message is shown ONLY if field #3 exactly matches "TestValue".
{else}
This message is shown otherwise.
{/if}`

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/conditional-smart-tags-for-wpforms` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the new if/then/else smart tags in your WPForms notifications and confirmations

== Frequently Asked Questions ==

= How do I find a field's ID? =

The field ID can be found in the WPForms form builder. When editing a field, look for the "Field ID" in the field options panel on the left.

= Can I use multiple conditions? =

Yes, you can use multiple if/then/else blocks. Just make sure to properly close each if block with {/if}.

= Can I nest if/then/else blocks and other smart tags? =

Yes, you can use nested if/then/else blocks and other smart tags.

== Changelog ==

= 1.0.1 =
* Release date: January 24, 2025
* Minor changes

= 1.0.0 =
* Release date: January 21, 2025
* Initial release
