<?php get_header(); ?>
<section class="tp-postbox-ptb p-relative pt-130 pb-120">
  <div class="container">
      <div class="row">
        <div class="col-lg-8">
            <div class="tp-postbox-wrapper">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                <?php get_template_part('template-parts/content', get_post_format()); ?>

                <?php endwhile; endif; ?>

                <div class="tp-pagination pt-30">
                  <nav>
                     <?php solub_posts_pagination(); ?>
                  </nav>
              </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tp-sidebar-wrapper pl-45">
              <?php get_sidebar(); ?>
            </div>
        </div>
      </div>
  </div>
</section>

<?php get_footer(); ?>