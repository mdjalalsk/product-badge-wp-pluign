<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class Admin.
 *
 * @since 1.0.0
 */
class Admin
{
    /**
     * Constructor.
     *
     * @since 1.0.0
     */

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_menu', array($this, 'admin_submenu'));
    }

    /**
     * Admin menu.
     *
     * @since 1.0.0.
     */

    public function admin_menu()
    {
        add_menu_page(
            'Product Badge',
            'Product Badge',
            'manage_options',
            'product-badges',
            array($this, 'admin_page'),
            'dashicons-awards',
            '56',
        );
    }
    public function admin_page()
    {
        echo '<div class="wrap">';
        echo '<h2> Badge list </h2>';
        echo '</div>';
    }
    public function admin_submenu(){
        add_submenu_page(
            'product-badges',
            'Add New Badge',
            'Add New Badge',
            'manage_options',
            'add-new-badge',
            array($this, 'add_new_badge_form'),
        );
    }
    public function add_new_badge_form()
    {
        echo '<div class="wrap">';
        echo '<h2>Add New Badge</h2>';
        echo '</div>';
    }


}