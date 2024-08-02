<?php
/*
 * Plugin Name:       Product Badge and Label for WooCommerce
 * Plugin URI:        https://woocopilot.com/plugins/woo-custom-price/
 * Description:       The "Product Badge and Label for WooCommerce" plugin allows store owners to easily add custom badges and labels to their WooCommerce products, helping to highlight special offers, new arrivals, bestsellers, and more. This enhances product visibility and encourages customer engagement.
 * Version:           1.0.1
 * Requires at least: 6.5
 * Requires PHP:      7.2
 * Author:            WooCopilot
 * Author URI:        https://woocopilot.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pbalfw
 * Domain Path:       /languages
 */

/*
Product Badge and Label for WooCommerce is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Product Badge and Label for WooCommerce is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Product Badge and Label for WooCommerce. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

// Including classes.
require_once __DIR__ . '/includes/class-product-badge-and-label-for-woocommerce.php';
require_once __DIR__ . '/includes/class-admin.php';


/**
 * Initializing plugin.
 *
 * @since 1.0.0
 * @return object Plugin object.
 */
function product_badge_and_label_for_woocommerce() {
    return new Product_Badge_And_Label_For_WooCommerce(__FILE__, '1.0.0');
}
product_badge_and_label_for_woocommerce();

