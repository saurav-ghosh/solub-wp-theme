<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (! empty($product_tabs)) : ?>
	<div class="row">
		<div class="col-xl-12">
			<div class="tp-product-details-bottom tp-product-details-bottom-style2 pt-95 pb-85 white-bg">
				<div class="tp-product-details-tab-nav tp-tab">
					<nav>
						<div class="nav nav-tabs p-relative tp-product-tab justify-content-sm-start justify-content-center" id="nav-tab" role="tablist">
							<?php foreach ($product_tabs as $key => $product_tab) : ?>
								<?php
								$is_active = ($key === 'description') ? 'active' : ''; // You can set this dynamically
								?>
								<button
									class="nav-link <?php echo esc_attr($is_active); ?>"
									id="nav-<?php echo esc_attr($key); ?>-tab"
									data-bs-toggle="tab"
									data-bs-target="#nav-<?php echo esc_attr($key); ?>"
									type="button"
									role="tab"
									aria-controls="nav-<?php echo esc_attr($key); ?>"
									aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
									<?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?>
								</button>
							<?php endforeach; ?>
						</div>
					</nav>
					<div class="tab-content pt-30" id="nav-tabContent">
						<?php
						$first_tab = true;
						foreach ($product_tabs as $key => $product_tab) :
							$active_class = $first_tab ? 'show active' : '';
						?>
							<div class="tab-pane fade <?php echo esc_attr($active_class); ?>"
								id="nav-<?php echo esc_attr($key); ?>"
								role="tabpanel"
								aria-labelledby="nav-<?php echo esc_attr($key); ?>-tab"
								tabindex="0">

								<div class="tp-product-details-desc-wrapper">
									<?php
									if (isset($product_tab['callback'])) {
										call_user_func($product_tab['callback'], $key, $product_tab);
									}
									?>
								</div>
							</div>
						<?php
							$first_tab = false;
						endforeach; ?>
					</div>

					<?php do_action('woocommerce_product_after_tabs'); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>