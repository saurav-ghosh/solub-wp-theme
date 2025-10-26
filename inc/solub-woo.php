<?php

// archive-product.php
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


//content-product.php
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

//content-single-product.php
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


// WPC wishlist
add_filter('woosw_button_position_archive', '__return_false');
add_filter('woosw_button_position_single', '__return_false');

// WPC Quick View
add_filter('woosq_button_position', '__return_false');

// WPC Compare
add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosc_button_position_single', '__return_false');

function solub_product_custom_template()
{

    global $product;

    $product_cat = get_the_terms($product->get_id(), 'product_cat');
?>
    <div class="tp-product-item mb-50">
        <div class="tp-product-thumb mb-15 fix p-relative z-index-1">
            <a href="<?php echo esc_url($product->get_permalink()); ?>">
                <img class="w-100" src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="">
            </a>

            <div class="tp-product-badge">
                <?php woocommerce_show_product_loop_sale_flash(); ?>
            </div>

            <!-- product action -->
            <div class="tp-product-action tp-product-action-blackStyle">
                <div class="tp-product-action-item d-flex flex-column">
                    <div class="tp-product-action-btn tp-product-add-cart-btn text-center">
                        <?php echo do_shortcode('[woosc]'); ?>
                        <span class="tp-product-tooltip">Add To Compare</span>
                    </div>
                    <div class="tp-product-action-btn tp-product-quick-view-btn text-center" data-bs-toggle="modal" data-bs-target="#producQuickViewModal">
                        <?php echo do_shortcode('[woosq]'); ?>
                        <span class="tp-product-tooltip">Quick View</span>
                    </div>
                    <div class="tp-product-action-btn tp-product-add-to-wishlist-btn text-center">
                        <?php echo do_shortcode('[woosw]'); ?>
                        <span class="tp-product-tooltip">Add To Wishlist</span>
                    </div>
                </div>
            </div>

            <div class="tp-product-add-cart-btn-large-wrapper text-center">
                <?php solub_wooc_add_to_cart(); ?>
            </div>
        </div>
        <div class="tp-product-content">
            <div class="tp-product-tag">
                <span>
                    <?php if ($product_cat && !is_wp_error($product_cat)) : ?>
                        <?php
                        $cat_names = wp_list_pluck($product_cat, 'name');
                        $limited = array_slice($cat_names, 0, 2);
                        echo esc_html(implode(', ', $limited));
                        ?>
                    <?php endif; ?>
                </span>
            </div>
            <h3 class="tp-product-title">
                <a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a>
            </h3>
            <div class="tp-product-price-wrapper">
                <?php woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>

<?php
}
add_action('woocommerce_before_shop_loop_item', 'solub_product_custom_template');


// product add to cart button
function solub_wooc_add_to_cart($args = array())
{
    global $product;

    if ($product) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    array(
                        'tp-product-add-cart-btn-large',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }


    // check product type 
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'solub');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'solub');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'solub');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'solub');
    } else {
        $btntext = esc_html__("Add to Cart", 'solub');
    }

    echo sprintf(
        '<a title="%s" href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        $btntext,
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'tp-product-add-cart-btn-large'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        $btntext
    );
}

//single product image/gallery
function single_product_thumbnail()
{
    global $product;

    if (!$product) return;

    $main_image_id = $product->get_image_id();
    $gallery_ids = $product->get_gallery_image_ids();

    //Include main image as first
    $image_ids = $main_image_id ? array_merge([$main_image_id], $gallery_ids) : $gallery_ids;

    if (empty($image_ids)) return; // no images found
?>
    <div class="tp-product-details-thumb-wrapper tp-tab pb-50">
        <div class="tab-content m-img" id="productDetailsNavContent">
            <?php foreach ($image_ids as $index => $image_id) :
                $img_url = wp_get_attachment_image_url($image_id, 'full');
                $tab_id = 'nav-' . ($index + 1);
                $is_active = $index === 0 ? 'show active' : '';
            ?>
                <div class="tab-pane fade <?php echo esc_attr($is_active) ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id) ?>-tab" tabindex="0">
                    <div class="tp-product-details-nav-main-thumb">
                        <img src="<?php echo esc_url($img_url); ?>" alt="">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($image_ids) > 1) : ?>
            <nav>
                <div class="nav nav-tabs justify-content-center" id="productDetailsNavThumb" role="tablist">
                    <?php foreach ($image_ids as $index => $image_id) :
                        $thumb_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                        $tab_id = 'nav-' . ($index + 1);
                        $is_active = $index === 0 ? 'active' : '';
                    ?>
                        <button class="nav-link <?php echo esc_attr($is_active); ?>" id="<?php echo esc_attr($tab_id); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($tab_id); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="">
                        </button>
                    <?php endforeach; ?>
                </div>
            </nav>
        <?php endif; ?>
    </div>
<?php
}
add_action('woocommerce_before_single_product_summary', 'single_product_thumbnail');

// Single product summary 
function single_product_summary()
{

    global $product;
    $product_cat = get_the_terms($product->get_id(), 'product_cat');
?>
    <div class="tp-product-details-wrapper pb-50">
        <div class="tp-product-details-category">
            <span>
                <?php if ($product_cat && !is_wp_error($product_cat)) : ?>
                    <?php
                    $cat_names = wp_list_pluck($product_cat, 'name');
                    echo esc_html(implode(', ', $cat_names));
                    ?>
                <?php endif; ?>
            </span>
        </div>
        <h3 class="tp-product-details-title mb-20">
            <?php the_title(); ?>
        </h3>

        <!-- inventory details -->
        <div class="tp-product-details-inventory mb-25 d-flex align-items-center justify-content-between">
            <!-- price -->
            <div class="tp-product-details-price-wrapper">
                <?php woocommerce_template_single_price(); ?>
                <div class="tp-product-details-rating-wrapper d-flex align-items-center">
                    <?php woocommerce_template_single_rating(); ?>
                </div>
            </div>
        </div>
        <p><?php woocommerce_template_single_excerpt(); ?></p>


        <!-- actions -->
        <div class="tp-product-details-action-wrapper mb-10">
            <h3 class="tp-product-details-action-title">Quantity</h3>
            <div class="tp-product-details-action-item-wrapper d-flex flex-wrap align-items-center">
                <div class="tp-product-details-quantity">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>
        </div>

        <?php woocommerce_template_single_meta(); ?>
    </div>

<?php
}
add_action('woocommerce_single_product_summary', 'single_product_summary');
