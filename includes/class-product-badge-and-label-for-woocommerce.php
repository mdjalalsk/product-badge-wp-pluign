<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class Product_Badge_And_Label_For_WooCommerce.
 *
 * @since 1.0.0
 */
class Product_Badge_And_Label_For_WooCommerce {

    /**
     * File.
     *
     * @var string $file File path.
     *
     * @since 1.0.0
     */
    public string $file;

    /**
     * Plugin Version.
     *
     * @var string $version Plugin version.
     *
     * @since 1.0.0
     */
    public string $version;

    /**
     * Constructor.
     *
     * @since 1.0.0
     * @param string $file Plugin file path.
     * @param string $version Plugin version.
     */
    public function __construct( $file, $version = '1.0.0' ) {
        $this->file = $file;
        $this->version = $version;
        $this->define_constants();
        $this->init_hooks();

        // Register the activation and deactivation hooks.
        register_activation_hook($this->file, [$this, 'activation_hook']);
        register_deactivation_hook($this->file, [$this, 'deactivation_hook']);
    }

    /**
     * Define constants.
     *
     * @since 1.0.0
     * @return void
     */
    public function define_constants() {
        define( 'PBALFE_VERSION', $this->version );
        define( 'PBALFE_PLUGIN_DIR', plugin_dir_path( $this->file ) );
        define( 'PBALFE_PLUGIN_URL', plugin_dir_url( $this->file ) );
        define( 'PBALFE_PLUGIN_BASENAME', plugin_basename( $this->file ) );
    }

    /**
     * Create database table on activation.
     *
     * @since 1.0.0
     * @return void
     */
    public function activation_hook() {
        // Update the plugin version option.
        update_option( 'woocp_version', $this->version );

        global $wpdb;
        $table_name = $wpdb->prefix . 'product_badges';
        $charset_collate = $wpdb->get_charset_collate();

        // Define the SQL query to create the table.
        $sql = "CREATE TABLE $table_name (
        ID mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        text tinytext NOT NULL,
        font_size varchar(10) NOT NULL,
        text_color varchar(10) NOT NULL,
        background_color varchar(10) NOT NULL,
        active boolean DEFAULT 0 NOT NULL,
        PRIMARY KEY (ID)
    ) $charset_collate;";

        // Include the upgrade file and execute the query.
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Deactivation hook.
     *
     * @since 1.0.0
     * @return void
     */
    public function deactivation_hook() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'product_badges';
        // Drop the table if it exists.
        $sql = "DROP TABLE IF EXISTS $table_name;";

        // Execute the SQL query.
        $wpdb->query($sql);

        // Optionally, delete any plugin options.
        delete_option('woocp_version');
    }
    /**
     * Initialize hooks.
     *
     * @since 1.0.0
     * @return void
     */
    public function init_hooks() {
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
        add_action( 'admin_notices', [ $this, 'dependencies_notices' ] );
        add_action( 'woocommerce_init', [ $this, 'init' ] );
    }

    /**
     * Load text domain for translations.
     *
     * @since 1.0.0
     * @return void
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'pbalfw', false, dirname( plugin_basename( $this->file ) ) . '/languages' );
    }

    /**
     * Display dependency notice.
     *
     * @since 1.0.0
     * @return void
     */
    public function dependencies_notices() {
        if ( ! class_exists( 'WooCommerce' ) ) {
            printf(
                '<div id="message" class="notice is-dismissible notice-warning"><p>%s</p></div>',
                __( 'WooCommerce is required for the "Product Badge and Label for WooCommerce" plugin to function properly.', 'pbalfw' )
            );
        }
    }

    /**
     * Initialize plugin functionality.
     *
     * @since 1.0.0
     * @return void
     */
    public function init() {
    new Admin();
    }

}
