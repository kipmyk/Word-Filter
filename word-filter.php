<?php 
/**
 * Plugin Name: Word Filer plugin
 * Description: A truly amazing plugin for post word count, and read time approximation.
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
       
    }
 }
 $ourWordFilterPlugin = new OurWordFilterPlugin();