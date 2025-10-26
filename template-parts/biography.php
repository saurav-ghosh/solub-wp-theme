<?php 
  $author_id = get_post_field( 'post_author', get_the_ID() );

  $author_name = get_the_author_meta('display_name', $author_id);
  $author_email = get_the_author_meta('user_email', $author_id);
  $author_description = get_the_author_meta('description', $author_id);
  $author_facebook = get_the_author_meta('facebook', $author_id);
  $author_linkedin = get_the_author_meta('linkedin', $author_id);
  $author_vimeo = get_the_author_meta('vimeo', $author_id);
?>

<div class="postbox-details-author-box mb-55 d-flex align-items-start">
    <div class="postbox-details-author-avatar">
      <?php echo get_avatar( $author_email, 80, '', '', [ 'class' => 'media-object img-circle' ] );?> 
    </div>
    <div class="postbox-details-author-content">
      <h5 class="postbox-details-author-title"><?php echo esc_html($author_name); ?></h5>
      <p><?php echo esc_html($author_description); ?></p>
      <div class="postbox-details-author-social">
         
          <?php if ( ! empty( $author_facebook ) ) : ?>
              <a href="<?php echo esc_url($author_facebook) ?>"><i class="fab fa-facebook-f"></i></a>
          <?php endif; ?>

          <?php if(!empty($author_linkedin)) : ?>
          <a href="<?php echo esc_url($author_linkedin) ?>"><i class="fab fa-linkedin-in"></i></a>
          <?php endif; ?>

          <?php if(!empty($author_vimeo)) : ?>
          <a href="<?php echo esc_url($author_vimeo) ?>"><i class="fab fa-vimeo-v"></i></a>
          <?php endif; ?>
      </div>
    </div>
</div>