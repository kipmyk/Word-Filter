<?php 
/**
 * Plugin Name: Word Filer plugin
 * Description: A truly amazing plugin for filtering words in WordPress Posts.
 * Version: 1.0.0
 * Author: Mike Kipruto
 * Author URI: https://kipmyk.co.ke/
 * Text Domain: wfpdomain
 */

 if(!defined('ABSPATH')) exit; //exist if access directly

 class OurWordFilterPlugin{
    /**
     * Primary Class Constructor
     * @since 1.0.0
     */
    function __construct(){
        // defining actions and filters
        add_action( 'admin_menu', array($this, 'OurMenu'));
        add_action('admin_init', array($this, 'OurSettings'));
        if (get_option('plugin_words_to_filter')) add_filter('the_content', array($this, 'filterLogic'));
    }
    function OurSettings(){
        add_settings_section( 'replacement-text-section', null, null, 'word-filter-options' );
        register_setting('replacementFields', 'replacementText');
        add_settings_field( 'replacement-text', 'Filter Text', array($this, 'replacementFieldHTML'), 'word-filter-options', 'replacement-text-section');
    }
    function replacementFieldHTML(){?>
        <input type="text" name="replacementText" id="" value="<?php echo esc_attr( get_option('replacementText', '***') )?>">
        <p class="description">Leave blank to simply remove the filtered words.</p>
    <?php }
    /**
     * Register filter logic
     * @since 1.0.0
     */
    function filterLogic($content) {
        $badWords = explode(',', get_option('plugin_words_to_filter'));
        $badWordsTrimmed = array_map('trim', $badWords);
        return str_ireplace($badWordsTrimmed, esc_html(get_option('replacementText', '****')), $content);
    }
    /**
     * Register admin menu
     */
    function OurMenu(){
        $mainPageHook = add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'), 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
        add_submenu_page( 'ourwordfilter', 'Words to Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'wordFilterPage'));
        add_submenu_page( 'ourwordfilter', 'Word Filer Options', 'options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
        add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
    }
    /**
     * Load custom css for the admin page
     * @since 1.0.0
     */
    function mainPageAssets() {
      wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . '/assets/css/styles.css');
    }
    /**
     * Handler form function
     * Fixed some security before saving the word filters
     * @since 1.0.0
     */
    function handleForm() {
        if (wp_verify_nonce($_POST['ourNonce'], 'saveFilterWords') AND current_user_can('manage_options')) {
          update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter'])); ?>
          <div class="updated">
            <p>Your filtered words were saved.</p>
          </div>
        <?php } else { ?>
          <div class="error">
            <p>Sorry, you do not have permission to perform that action.</p>
          </div>
        <?php } 
    }
    /**
     * Word Filter page HTML
     * @since 1.0.0
     */
    function wordFilterPage() { ?>
        <div class="wrap">
          <h1>Word Filter</h1>
          <?php if (isset($_POST['justsubmitted'])) $this->handleForm() ?>
          <form method="POST">
            <input type="hidden" name="justsubmitted" value="true">
            <?php wp_nonce_field('saveFilterWords', 'ourNonce') ?>
            <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content.</p></label>
            <div class="word-filter__flex-container">
              <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')) ?></textarea>
            </div>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
          </form>
        </div>
    <?php }
    /**
     * Word Filter options submenu
     * @since 1.0.0
     */
    function optionsSubPage(){?>
        <div class="wrap">
            <h1>Word Filter Options</h1>
            <form action="options.php" method="post">
                <?php
                    settings_errors();
                    settings_fields( 'replacementFields' );
                    do_settings_sections( 'word-filter-options' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php }
 }
 $ourWordFilterPlugin = new OurWordFilterPlugin();