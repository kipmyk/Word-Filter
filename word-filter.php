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
     * @since {version}
     */
    function __construct(){
        // defining actions and filters
        add_action( 'admin_menu', array($this, 'OurMenu'));
    }
    /**
     * Register admin menu
     */
    function OurMenu(){
        add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
        add_submenu_page( 'ourwordfilter', 'Words to Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'));
        add_submenu_page( 'ourwordfilter', 'Word Filer Options', 'options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
    }
    /**
     * Word Filter page HTML
     * @since {version}
     */
    function wordFilterPage(){?>
        Word Filter page HTML
    <?php }
    /**
     * Word Filter options submenu
     * @since {version}
     */
    function optionsSubPage(){?>
        optionsSubPage
    <?php }
 }
 $ourWordFilterPlugin = new OurWordFilterPlugin();