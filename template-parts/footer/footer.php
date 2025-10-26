<!-- footer area start -->
<footer class="tp-footer-ptb p-relative" data-bg-color="#1F2220">
   <div class="container">
      <?php if (is_active_sidebar('footer-widget-1') || is_active_sidebar('footer-widget-2') || is_active_sidebar('footer-widget-3') || is_active_sidebar('footer-widget-4')) : ?>
         <div class="tp-footer-widget-border pt-90">
            <div class="row">
               <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                  <?php if (is_active_sidebar('footer-widget-1')) : ?>
                     <?php dynamic_sidebar('footer-widget-1'); ?>
                  <?php endif; ?>
               </div>
               <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 col-12">
                  <?php if (is_active_sidebar('footer-widget-2')) : ?>
                     <?php dynamic_sidebar('footer-widget-2'); ?>
                  <?php endif; ?>
               </div>
               <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                  <?php if (is_active_sidebar('footer-widget-3')) : ?>
                     <?php dynamic_sidebar('footer-widget-3'); ?>
                  <?php endif; ?>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                  <?php if (is_active_sidebar('footer-widget-4')) : ?>
                     <?php dynamic_sidebar('footer-widget-4'); ?>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      <?php endif; ?>
      <div class="tp-footer-copyright-ptb pt-20 pb-20">
         <div class="row align-items-center">
            <div class="col-lg-6">
               <div class="tp-footer-copyright">
                  <?php solub_footer_copyright(); ?>
               </div>
                                          
            </div>
            <div class="col-lg-6">
               <div class="tp-footer-widget-social text-lg-end">
                  <?php solub_footer_social(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- footer area end -->