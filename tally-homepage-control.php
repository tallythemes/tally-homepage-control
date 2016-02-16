<?php
/**
 * @package Tally Homepage Control
 */
/*
Plugin Name: Tally Homepage Control
Plugin URI: http://tallythemes.com/
Description: Home Page content builder for Tally Themes.
Version: 1.3.1
Author: TallyThemes
Author URI: http://tallythemes.com/tally-homepage-control/
License: GPLv2 or later
Text Domain: tally-builder
Prefix: tallybuilder_
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA..
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

	if(!defined('TALLYBUILDER__PLUGIN_URL'))define( 'TALLYBUILDER__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	if(!defined('TALLYBUILDER__PLUGIN_DIR'))define( 'TALLYBUILDER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	if(!defined('TALLYBUILDER__SECTIONS_DIR'))define( 'TALLYBUILDER__SECTIONS_DIR', TALLYBUILDER__PLUGIN_DIR.'sections/' );
	if(!defined('TALLYBUILDER__DEBUG'))define( 'TALLYBUILDER__DEBUG', false );
	
	require_once('post-type.php');
	

add_action('init', 'tallybuilder_init');
function tallybuilder_init(){
	require_once('functions.php');
	require_once('admin-pages.php');
	require_once('metabox-help.php');
	require_once('metabox.php');
	require_once('script-loader.php');
	require_once('sections.php');
	require_once('frontend.php');
}