<?php

// menu 
function solub_main_menu(){
  wp_nav_menu(array(
      'theme_location' => 'main-menu',
      'container'     => '',
      'menu_class'    => '',
      'fallback_cb'   => 'Solub_Walker_Nav_Menu::fallback',
      'walker'        => new Solub_Walker_Nav_Menu,
  ));
}

function solub_header_logo() {
  $logo = get_theme_mod('header_logo_black', get_template_directory_uri() . '/assets/img/logo/logo-black.png');

  ?>
    <a href="<?php home_url( ); ?>">
      <img data-width="130" src="<?php echo esc_url($logo); ?>" alt="">
    </a>
  <?php
}

function solub_header_social(){

  $facebook = get_theme_mod('header_social_facebook', __('#', 'solub'));
  $twitter = get_theme_mod('header_social_twitter', __('#', 'solub'));
  $instagram = get_theme_mod('header_social_instagram', __('#', 'solub'));  
  $pinterest = get_theme_mod('header_social_pinterest', __('#', 'solub'));

  ?>

  <?php if($facebook): ?>
    <a href="<?php echo esc_url( $facebook ); ?>"><i class="fa-brands fa-facebook"></i></a>
  <?php endif; ?>  

  <?php if($twitter): ?>
  <a href="<?php echo esc_url( $twitter );?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg></a>
  <?php endif; ?>

  <?php if($instagram): ?>
  <a href="<?php echo esc_url( $instagram ); ?>"><i class="fa-brands fa-instagram"></i></a>
  <?php endif; ?>

  <?php if($pinterest): ?>
  <a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa-brands fa-pinterest"></i></a>
  
  <?php endif;
}


// footer copyright template
function solub_footer_copyright() {
  $copyright = get_theme_mod('footer_copyright', __('Copyright © 2024 Solub. All Rights Reserved.', 'solub'));
  ?>
    <p> <?php echo solub_kses( $copyright ); ?> </p>
  <?php
}

// footer social template
function solub_footer_social(){

  $facebook = get_theme_mod('footer_social_facebook', __('#', 'solub'));
  $twitter = get_theme_mod('footer_social_twitter', __('#', 'solub'));
  $instagram = get_theme_mod('footer_social_instagram', __('#', 'solub'));  
  $linkedin = get_theme_mod('footer_social_linkedin', __('#', 'solub'));
  ?>

  <?php if($facebook): ?>
    <a href="<?php echo esc_url( $facebook ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
  <?php endif; ?>  

  <?php if($twitter): ?>
    <a href="<?php echo esc_url( $twitter ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15px" height="15px"><path d="M 4.4042969 3 C 3.7572969 3 3.3780469 3.7287656 3.7480469 4.2597656 L 9.7363281 12.818359 L 3.7246094 19.845703 C 3.3356094 20.299703 3.6578594 21 4.2558594 21 L 4.9199219 21 C 5.2129219 21 5.4916406 20.871437 5.6816406 20.648438 L 10.919922 14.511719 L 14.863281 20.146484 C 15.238281 20.680484 15.849953 21 16.501953 21 L 19.835938 21 C 20.482937 21 20.862187 20.272188 20.492188 19.742188 L 14.173828 10.699219 L 19.900391 3.9902344 C 20.232391 3.6002344 19.955359 3 19.443359 3 L 18.597656 3 C 18.305656 3 18.027891 3.1276094 17.837891 3.3496094 L 12.996094 9.0097656 L 9.3945312 3.8554688 C 9.0205313 3.3194687 8.4098594 3 7.7558594 3 L 4.4042969 3 z" fill="currentcolor"></path></svg></a>
  <?php endif; ?>

  <?php if($instagram): ?>
  <a href="<?php echo esc_url( $instagram ); ?>"><i class="fa-brands fa-instagram"></i></a>
  <?php endif; ?>

  <?php if($linkedin): ?>
  <a href="<?php echo esc_url( $linkedin ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
  
  <?php endif;
}

// Post tags
function solub_post_tags() {
  $tags = get_the_tags();
  if($tags) {
    foreach($tags as $tag) {
      echo '<a href="'. esc_url( get_tag_link( $tag->term_id ) ) .'">'. esc_html( $tag->name ) .'</a>';
    }
  }
}

// Posts pagination
function solub_posts_pagination() {
  $pages = paginate_links( array( 
      'type' => 'array',
      'prev_text'    => __('<i class="fal fa-long-arrow-left"></i>','harry'),
      'next_text'    => __('<i class="fal fa-long-arrow-right"></i>','harry'),
  ) );
      if( $pages ) {
      echo '<ul>';
      foreach ( $pages as $page ) {
          echo "<li>$page</li>";
      }
      echo '</ul>';
  }
}


// Filters and sanitizes HTML content
function solub_kses( $custom_html_tags = '' ) {
	$allowed_html = [
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'path'  => array( 
            'd' => true, 
            'fill' => true,  
            'stroke' => true,  
            'stroke-width' => true,  
            'stroke-linecap' => true,  
            'stroke-linejoin' => true,  
            'opacity' => true,  
        ),
		'a' => [
			'class'    => [],
			'href'    => [],
			'title'    => [],
			'target'    => [],
			'rel'    => [],
		],
         'b' => [],
         'blockquote'  =>  [
            'cite' => [],
         ],
         'cite'                      => [
            'title' => [],
         ],
         'code'                      => [],
         'del'                    => [
            'datetime'   => [],
            'title'      => [],
        ],
         'dd'                     => [],
         'div'                    => [
            'class'   => [],
            'title'   => [],
            'style'   => [],
         ],
         'dl'                     => [],
         'dt'                     => [],
         'em'                     => [],
         'h1'                     => [],
         'h2'                     => [],
         'h3'                     => [],
         'h4'                     => [],
         'h5'                     => [],
         'h6'                     => [],
         'i'                         => [
            'class' => [],
         ],
         'img'                    => [
            'alt'  => [],
            'class'   => [],
            'height' => [],
            'src'  => [],
            'width'   => [],
         ],
         'li'                     => array(
            'class' => array(),
         ),
         'ol'                     => array(
            'class' => array(),
         ),
         'p'                         => array(
            'class' => array(),
         ),
         'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
         ),
         'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
         ),
         'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
         ),
         'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
         ),
         'strike'                 => array(),
         'br'                     => array(),
         'strong'                 => array(),
	];

	return wp_kses( $custom_html_tags, $allowed_html );
}