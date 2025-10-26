<?php

/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined('ABSPATH') || exit;

global $product;

if (! comments_open()) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div class="tp-product-details-review-wrapper tp-product-details-review-wrapper-2">
		<h3 class="tp-product-details-review-title-2">
			<?php
			$count = $product->get_review_count();
			if ($count && wc_review_ratings_enabled()) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf(esc_html(_n('%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce')), esc_html($count), get_the_title());
				echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product); // WPCS: XSS ok.
			} else {
				esc_html_e('Reviews', 'woocommerce');
			}
			?>
		</h3>

		<div class="row">
			<div class="col-xl-12">
				<?php if (have_comments()) : ?>
					<div class="tp-product-details-review-item-wrapper-2">
						<?php
						// Custom callback function for displaying comments in the new markup
						function custom_woocommerce_comments($comment, $args, $depth)
						{
							global $comment;
							$rating = get_comment_meta($comment->comment_ID, 'rating', true);
						?>
							<div class="tp-product-details-review-item-2 <?php echo ($depth > 1) ? '' : 'mb-35'; ?>">
								<div class="row">
									<div class="col-lg-8">
										<div class="tp-product-details-review-avater-2 d-flex">
											<div class="tp-product-details-review-avater-thumb">
												<a href="#">
													<?php echo get_avatar($comment, 60); ?>
												</a>
											</div>
											<div class="tp-product-details-review-avater-content">
												<?php if ($rating && wc_review_ratings_enabled()) : ?>
													<div class="tp-product-details-review-avater-rating d-flex align-items-center">
														<?php for ($i = 1; $i <= 5; $i++) : ?>
															<span>
																<i class="fas fa-star<?php echo ($i <= $rating) ? '' : '-o'; ?>"></i>
															</span>
														<?php endfor; ?>
													</div>
												<?php endif; ?>
												<h3 class="tp-product-details-review-avater-title">
													<?php echo get_comment_author(); ?>
												</h3>
												<span class="tp-product-details-review-avater-meta mb-10">
													<?php echo get_comment_date(); ?>
												</span>
												<div class="tp-product-details-review-avater-comment">
													<?php comment_text(); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
						}

						// Display comments using custom callback
						wp_list_comments(array('callback' => 'custom_woocommerce_comments'));
						?>
					</div>

					<?php
					// Pagination for comments
					if (get_comment_pages_count() > 1 && get_option('page_comments')) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links(
							apply_filters(
								'woocommerce_comment_pagination_args',
								array(
									'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
									'next_text' => is_rtl() ? '&larr;' : '&rarr;',
									'type'      => 'list',
								)
							)
						);
						echo '</nav>';
					endif;
					?>
				<?php else : ?>
					<p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?></p>
				<?php endif; ?>
			</div>

			<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
				<div class="col-lg-12">
					<div class="tp-product-details-review-form pt-55">
						<h3 class="tp-product-details-review-form-title">
							<?php echo have_comments() ? esc_html__('Add a Review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()); ?>
						</h3>

						<?php
						$commenter = wp_get_current_commenter();
						$comment_form = array(
							'title_reply'         => '',
							'title_reply_to'      => esc_html__('Leave a Reply to %s', 'woocommerce'),
							'title_reply_before'  => '<span id="reply-title" class="comment-reply-title" style="display:none;">',
							'title_reply_after'   => '</span>',
							'comment_notes_after' => '',
							'label_submit'        => esc_html__('Send message', 'woocommerce'),
							'logged_in_as'        => '',
							'comment_field'       => '',
							'submit_button'       => '<div class="col-12"><button type="submit" class="tp-btn">%4$s</button></div>',
							'class_form'          => 'comment-form',
							'class_submit'        => 'tp-btn',
						);

						$name_email_required = (bool) get_option('require_name_email', 1);
						$fields = array(
							'author' => '<div class="col-md-6 mb-30"><div class="tp-contact-input"><input class="tp-input" name="author" type="text" placeholder="' . esc_attr__('Your Name', 'woocommerce') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($name_email_required ? 'required' : '') . ' /></div></div>',
							'email'  => '<div class="col-md-6 mb-30"><div class="tp-contact-input"><input class="tp-input" name="email" type="email" placeholder="' . esc_attr__('Your Email', 'woocommerce') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($name_email_required ? 'required' : '') . ' /></div></div>',
						);

						$comment_form['fields'] = $fields;

						// Rating field
						if (wc_review_ratings_enabled()) {
							$comment_form['comment_field'] = '<div class="tp-product-details-review-form-rating mb-30 d-flex align-items-center">
								<p>' . esc_html__('Your Rating :', 'woocommerce') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</p>
								<div class="tp-product-details-review-form-rating-icon d-flex align-items-center" id="star-rating">
									<input type="hidden" name="rating" id="rating" value="" ' . (wc_review_ratings_required() ? 'required' : '') . '>
									<span class="star" data-rating="1"><i class="far fa-star"></i></span>
									<span class="star" data-rating="2"><i class="far fa-star"></i></span>
									<span class="star" data-rating="3"><i class="far fa-star"></i></span>
									<span class="star" data-rating="4"><i class="far fa-star"></i></span>
									<span class="star" data-rating="5"><i class="far fa-star"></i></span>
								</div>
							</div>
							<div class="contact-form-box">
								<div class="row">';
						} else {
							$comment_form['comment_field'] = '<div class="contact-form-box"><div class="row">';
						}

						// Comment textarea
						$comment_form['comment_field'] .= '<div class="col-md-12 mb-45">
							<div class="tp-contact-input">
								<textarea class="tp-input tp-textarea" name="comment" cols="30" rows="10" placeholder="' . esc_attr__('Write your review here...', 'woocommerce') . '" required></textarea>
							</div>
						</div>';

						$account_page_url = wc_get_page_permalink('myaccount');
						if ($account_page_url) {
							$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
						}

						comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
						?>
					</div>
				</div>
			<?php else : ?>
				<div class="col-lg-12">
					<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<style>
	/* Hide default WooCommerce rating elements */
	.comment-form-rating,
	.stars,
	.comment-form-rating select,
	p.stars {
		display: none !important;
	}

	.tp-product-details-review-form-rating-icon .star {
		cursor: pointer;
		font-size: 18px;
		margin-right: 5px;
		color: #ddd;
		transition: color 0.2s;
	}

	.tp-product-details-review-form-rating-icon .star:hover,
	.tp-product-details-review-form-rating-icon .star.active {
		color: #ffc107;
	}

	.tp-product-details-review-form-rating-icon .star i {
		pointer-events: none;
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const stars = document.querySelectorAll('.tp-product-details-review-form-rating-icon .star');
		const ratingInput = document.getElementById('rating');
		let selectedRating = 0;

		stars.forEach(function(star, index) {
			// Click event
			star.addEventListener('click', function() {
				selectedRating = parseInt(this.getAttribute('data-rating'));
				ratingInput.value = selectedRating;
				updateStars(selectedRating);
			});

			// Hover events
			star.addEventListener('mouseenter', function() {
				const hoverRating = parseInt(this.getAttribute('data-rating'));
				updateStars(hoverRating);
			});
		});

		// Reset to selected rating when mouse leaves the rating area
		document.getElementById('star-rating').addEventListener('mouseleave', function() {
			updateStars(selectedRating);
		});

		function updateStars(rating) {
			stars.forEach(function(star, index) {
				const starRating = parseInt(star.getAttribute('data-rating'));
				const icon = star.querySelector('i');

				if (starRating <= rating) {
					icon.className = 'fas fa-star';
					star.classList.add('active');
				} else {
					icon.className = 'far fa-star';
					star.classList.remove('active');
				}
			});
		}
	});
</script>