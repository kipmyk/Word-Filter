<?php 
/**
 * Plugin Name: Word Filer plugin
 * Description: A truly amazing plugin for filtering words in WordPress Post(s), and Page(s)
 * Version: 1.0.0
 * Author: Mike Kipruto
 * Author URI: https://kipmyk.co.ke/
 * Text Domain: wfpdomain
 * Domain Path: /languages
 */

 if(!defined('ABSPATH')) exit; //exist if access directly

 class OurWordFilterPlugin{
    /**
     * Primary Class Constructor
     *
     */
    function __construct(){
        // defining actions and filters
        add_action( 'admin_menu', array($this, 'OurMenu'));
    }
    /**
     * Register admin menu
     *
     *
     */
    function OurMenu(){
        add_menu_page( 'Word to Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), 'dashicons-smiley', 100 );
        add_submenu_page( 'ourwordfilter', 'Words to Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'));
        add_submenu_page( 'ourwordfilter', 'Word Filer Options', 'options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
    }
    /**
     * Word Filter page HTML
     */
    function wordFilterPage(){?>
        Word Filter page HTML
    <?php }
    /**
     * Word Filter options submenu
     */
    function optionsSubPage(){?>
        optionsSubPage
    <?php }
 }
 $ourWordFilterPlugin = new OurWordFilterPlugin();