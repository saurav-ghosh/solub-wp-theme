<?php get_header(); ?>

<section class="tp-postbox-ptb p-relative pt-130 pb-90">
  <div class="container">
      <div class="row">
        <div class="col-lg-8">
            <div class="postbox-details-wrapper">

            <?php 
                get_template_part('template-parts/content', get_post_format());

                get_template_part( 'template-parts/biography');

                if(comments_open() || get_comments_number()) : 
                    comments_template();
                endif;

            ?>
            </div>
        </div>

        <?php if(is_active_sidebar('posts-sidebar')) : ?>
          <div class="col-lg-4">
            <div class="tp-sidebar-wrapper pl-45">
              <?php get_sidebar(); ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
</section>

<?php get_footer(); ?>