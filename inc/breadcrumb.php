<?php

function solub_breadcrumb()
{
  if (is_front_page() && is_home()) {
    $title = __('Blog', 'solub');
  } elseif (is_front_page()) {
    $title = __('Blog', 'solub');
  } elseif (is_home()) {
    if (get_option('page_for_posts')) {
      $title = get_the_title(get_option('page_for_posts'));
    }
  } elseif (is_single() && 'post' == get_post_type()) {
    $title = get_the_title();
  } elseif (is_single() && 'service' == get_post_type()) {
    $title = get_the_title();
  } elseif (is_single() && 'product' == get_post_type()) {
    $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'solub'));
  } elseif (is_search()) {
    $title = esc_html__('Search Results for : ', 'solub') . get_search_query();
  } elseif (is_404()) {
    $title = esc_html__('404 Page not Found', 'solub');
  } elseif (is_archive()) {
    $title = get_the_archive_title();
  } else {
    $title = get_the_title();
  }

  $bg = get_theme_mod('breadcrumb_img');
  $breadcrumb_img_show_hide = true; // default to show if not overridden

  if (function_exists('get_field')) {
    $page_id = null;

    if (is_home() && get_option('page_for_posts')) {
      $page_id = get_option('page_for_posts');
    } elseif (is_singular()) {
      $page_id = get_the_ID();
    } elseif (is_shop()) {
      $page_id = wc_get_page_id('shop'); // WooCommerce Shop page support
    }

    if ($page_id) {
      $breadcrumb_img_custom = get_field('breadcrumb_image', $page_id);
      $breadcrumb_img_show_hide = get_field('breadcrumb_showhide', $page_id);

      if (!empty($breadcrumb_img_custom['url'])) {
        $bg = $breadcrumb_img_custom['url'];
      }
    }
  }

  if (!$breadcrumb_img_show_hide) {
    return;
  }
?>

  <div class="tp-breadcrumb__ptb tp-breadcrumb__bg p-relative z-index-1 fix" data-background="<?php echo esc_url($bg); ?>">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-12">
          <div class="tp-breadcrumb__content p-relative">
            <h3 class="tp-breadcrumb__title white"><?php echo solub_kses($title); ?></h3>

            <div class="tp-breadcrumb__list white">
              <?php if (function_exists('bcn_display')) {
                bcn_display();
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
}
