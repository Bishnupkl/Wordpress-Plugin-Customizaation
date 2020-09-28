<?php

/**
 * Class for displaying addons page
 *
 * @since 3.1.1
 */
class Zoom_Video_Conferencing_Admin_Addons {

	public function __construct() {
	}

	public function render() {
		?>
        <div class="wrap video-conferencing-addons">
            <h3 class="border-padd">Get more features to your site !</h3>
            <div class="video-conferencing-addons-flex">
                <div class="video-conferencing-addons-box">
                    <div class="image">
                        <img width="100" src="<?php echo ZVC_PLUGIN_DIR_URL; ?>assets/images/bookings-icon.png" alt="WooCommerce Booking">
                    </div>
                    <div class="content">
                        <h3>WooCommerce Booking Integration</h3>
                        <p>Integrate your Zoom Meetings directly to WooCommerce booking products. Zoom Integration for WooCommerce Booking allows you
                            to automate your zoom meetings directly from your WordPress dashboard by linking zoom meetings to your WooCommerce Booking
                            products automatically when a Booking Product is created. Users will receive join links in their booking confirmation
                            emails.</p>
                        <a href="https://www.codemanas.com/downloads/zoom-integration-for-woocommerce-booking/" class="button button-primary">From:
                            $30</a>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

}