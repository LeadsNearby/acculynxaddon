<?php

/*
Plugin Name: Gravity Forms Acculynx Add-On
Plugin URI: http://www.leadsnearby.com
Description: Acculyx integration with gravity forms.
Version: 1.0.0
Author: LeadsNearby
Author URI: http://www.leadsnearby.com

 */

add_action('gform_loaded', array('GF_Acculynx_AddOn_Bootstrap', 'load'), 5);
add_action('admin_init', array('GF_Acculynx_AddOn_Bootstrap', 'initialize_updater'));
class GF_Acculynx_AddOn_Bootstrap {
    public static function load() {
        if (!method_exists('GFForms', 'include_feed_addon_framework')) {
            return;
        }
        require_once 'class-acculynxaddon.php';
        GFAddOn::register('GFAcculynxAddOn');
    }
    public static function initialize_updater() {
        if (class_exists('\lnb\core\GitHubPluginUpdater')) {
            new \lnb\core\GitHubPluginUpdater(__FILE__, 'acculynxaddon');
        }
    }
}
function gf_acculynx_addon() {
    return GFAcculynxAddOn::get_instance();
}
