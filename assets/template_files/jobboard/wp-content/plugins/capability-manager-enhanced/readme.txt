=== Capability Manager Enhanced===
Contributors: txanny, kevinB
Help link: http://wordpress.org/tags/capsman-enhanced
Tags: roles, capabilities, manager, editor, rights, role, capability, types, taxonomies
Requires at least: 3.1
Tested up to: 3.5.1
Stable tag: 1.4.9

A simple way to manage WordPress roles and capabilities. With this plugin you will be able to easily create and manage roles and capabilities.

== Description ==

Capability Manager plugin provides a simple way to manage WordPress role definitions (Subscriber, Editor, etc.)  View or change the capabilities of any role, add new roles, copy existing roles into new ones, and add new capabilities to existing roles.
You can also delegate capabilities management to other users. In this case, some restrictions apply to this users, as they can only set/unset the capabilities they have.
With the Backup/Restore tool, you can save your Roles and Capabilities before making changes and revert them if something goes wrong. You'll find it on the Tools menu. 

  * Capability manager has been tested to support only one WordPress role per user.
  * Only users with 'manage_capabilities' can manage them. This capability is created at install time and assigned only to administrators.
  * Administrator role cannot be deleted.
  * Non-administrators can only manage roles or users with same or lower capabilities.

Enhanced and supported by <a href="http://agapetry.net">Kevin Behrens</a> since July 2012. The original Capability Manager author, Jordi Canals, has not updated the plugin since early 2010. Since he was unreachable by web or email, I decided to take on the project myself.

The main change from the original plugin is an improved UI which organizes capabilities:

  * by post type
  * by operation (read/edit/delete)
  * by origin (WP core or plugin)

Capability Manager Enhanced also adds <a href="http://presspermit.com">Press Permit plugin</a> integration:

  * easily specify which post types require type-specific capability definitions
  * show capabilities which Press Permit adds to the role by supplemental type-specific role assignment
  
= Features: =

* Manage role capabilities.
* Create new roles or delete existing ones.
* Add new capabilities to any existing role.
* Backup and restore Roles and Capabilities to revert your last changes.
* Revert Roles and Capabilities to WordPress defaults. 
 
= Languages included: =

* English
* Catalan
* Spanish
* Belorussian *by <a href="http://antsar.info/" rel="nofollow">Ilyuha</a>*
* German *by <a href="http://great-solution.de/" rel="nofollow">Carsten Tauber</a>*
* Italian *by <a href="http://gidibao.net" rel="nofollow">Gianni Diurno</a>*
* Russian *by <a href="http://www.fatcow.com" rel="nofollow">Marcis Gasuns</a>*
* Swedish *by <a href="http://jenswedin.com/" rel="nofollow">Jens Wedin</a>
* POT file for easy translation to other languages included.

== Installation ==

= System Requirements =

* **Requires PHP 5.2**. Older versions of PHP are obsolete and expose your site to security risks.
* Verify the plugin is compatible with your WordPress Version. If not, plugin will not load.

= Installing the plugin =

1. Unzip the plugin archive.
1. Upload the plugin's folder to the WordPress plugins directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Manage the capabilities on the 'Capabilities' page on Users menu.
1. Enjoy your plugin!

== Screenshots ==

1. Users Menu.
2. View or Modify capabilities for a role.
3. Actions on roles.
4. Permissions Menu (Press Permit integration).
5. View or Modify capabilities for a role (Press Permit integration).
6. Actions on roles (Press Permit integration).
7. Backup/Restore tool.

== Frequently Asked Questions ==

= How can I grant capabilities for a custom post type =
The custom post type must be defined to impose type-specific capability requirements.  This is normally done by setting the "capability type" property equal to the post type name.

= I have configured a role to edit a custom post type. Why do the users still see "You are not allowed the edit this post?" when they try to save/submit a new post? =

Probably because your custom post type definition not having map_meta_cap set true. If you are calling register_post_type manually, just add this property to the options array. Unfortunately, none of the free CPT plugins deal with this important detail. 

= Where can I find more information about this plugin, usage and support ? =

* If you need help, <a href="http://wordpress.org/tags/capsman-enhanced">ask in the Support forum</a>.

== License ==

Copyright 2009, 2010 Jordi Canals
Copyright 2013, Kevin Behrens

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License version 2 as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.

== Changelog ==

= 1.4.9 =
  * Fixed : Role capabilities were not updated / refreshed properly on multisite installations
  * Feature : If create_posts capabilities are defined, organize checkboxes into a column alongside edit_posts
  * Feature : "Use create_posts capability" checkbox in sidebar auto-defines create_posts capabilities (requires Press Permit)
  * Compat : bbPress + Press Permit - Modified bbPress role capabilities were not redisplayed following save, required reload
  * Compat : bbPress + Press Permit - Adding a capability via the "Add Cap" textbox caused the checkbox to be available but not selected
  * Compat : Press Permit - "supplemental only" option was always enabled for newly created and copied roles, regardless of checkbox setting near Create/Copy button
  
= 1.4.8 =
  * Compat : bbPress + Press Permit - "Add Capability" form failed when used on a bbPress role, caused creation of an invalid role

= 1.4.7 =
  * Compat : Press Permit - flagging of roles as "supplemental assignment only" was not saved

= 1.4.6 =
  * Compat : bbPress 2.2 (supports customization of dynamic forum role capabilities)
  * Compat : Press Permit + bbPress - customized role capabilities were not properly maintained on bbPress activation / deactivation, in some scenarios
  * Fixed : Role update and copy failed if currently stored capability array is corrupted
 
= 1.4.5 =
  * Fixed : Capabilities were needlessly re-saved on role load
  * Fixed : Capability labels in "Other WordPress" section did not toggle checkbox selection
  * Press Permit integration: If capability is granted by the role's Permit Group, highlight it as green with a descriptive caption title, but leave checkbox enabled for display/editing of role defintion setting (previous behavior caused capability to be stripped out of WP role definition under some PP configurations)
  
= 1.4.4 =
  * Fixed : On translated sites, roles could not be edited
  * Fixed : Menu item change to "Role Capabilities" broke existing translations

= 1.4.3 =
  * Fixed : Separate checkbox was displayed for cap->edit_published_posts even if it was defined to the be same as cap->edit_posts
  * Press Permit integration: automatically store a backup copy of each role's last saved capability set so they can be reinstated if necessary (currently for bbPress)

= 1.4.2 =
  * Language: updated .pot file
  * Press Permit integration: roles can be marked for supplemental assignment only (and suppressed from WP role assignment dropdown, requires PP 1.0-beta1.4)

= 1.4.1 =
  * https compatibility: use content_url(), plugins_url()
  * Press Permit integration: if role definitions are reset to WP defaults, also repopulate PP capabilities (pp_manage_settings, etc.)

= 1.4 =
  * Organized capabilities UI by post type and operation
  * Editing UI separates WP core capabilities and 3rd party capabilities
  * Clarified sidebar captions
  * Don't allow a non-Administrator to add or remove a capability they don't have
  * Fixed : PHP Warnings for unchecked capabilities
  * Press Permit integration: externally (dis)enable Post Types, Taxonomies for PP filtering (which forces type-specific capability definitions)
  * Show capabilities which Press Permit adds to the role by supplemental type-specific role assignment
  * Reduce memory usage by loading framework and plugin code only when needed
  
= 1.3.2 = 
  * Added Swedish translation.

= 1.3.1 =
  * Fixed a bug where administrators could not create or manage other administrators.
  
= 1.3 =
  * Cannot edit users with more capabilities than current user.
  * Cannot assign to users a role with more capabilities than current user.
  * Solved an incompatibility with Chameleon theme.
  * Migrated to the new Alkivia Framework.
  * Changed license to GPL version 2.

= 1.2.5 =
  * Tested up to WP 2.9.1.

= 1.2.4 =
  * Added Italian translation.

= 1.2.3 =
  * Added German and Belorussian translations.

= 1.2.2 =
  * Added Russian translation.

= 1.2.1 =
  * Coding Standards.
  * Corrected internal links.
  * Updated Framework.

= 1.2 =
  * Added backup/restore tool.

= 1.1 =
  * Role deletion added.

= 1.0.1 =
  * Some code improvements.
  * Updated Alkivia Framework.

= 1.0 =
  * First public version.

== Upgrade Notice ==

= 1.3.2 = 
Only Swedish translation.

= 1.3.1 =
Bug fixes.
  
= 1.3 =
Improved security esiting users. You can now create real user managers. 
