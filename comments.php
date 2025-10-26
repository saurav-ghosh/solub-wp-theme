<?php
// Check if comments are allowed
if (comments_open()) :
    ?>
    <div id="comments" class="contact-form-box mb-50">
        <?php
        // Display the comments list
        if (have_comments()) :
            ?>
            <div class="postbox-comment mb-60">
                <h3 class="postbox-comment-title">
                    <?php
                    $comment_count = get_comments_number();
                    echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'exdos');
                    ?>
                </h3>
                <ul>
                    <?php
                    wp_list_comments(array(
                        'style'       => 'ul',
                        'short_ping'  => true,
                        'callback' => 'custom_comment_list'
                    ));
                    ?>
                </ul>
            </div>


            <?php
            // Display comment pagination if needed
            the_comments_pagination(array(
                'prev_text' => esc_html__('Previous', 'exdos'),
                'next_text' => esc_html__('Next', 'exdos'),
            ));
        endif;
        
        if ( is_user_logged_in() ) {
            $cl = 'loginformuser';
        } else {
            $cl = '';
        }

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');

        $fields = array(
            'author' => '<div class="row"><div class="col-xl-6"><div class="postbox-details-input-box"><div class="postbox-details-input mb-20"><input type="text" name="author" id="author" placeholder="' . esc_attr__('Your name', 'exdos') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '>
            </div></div></div>',

            'email' => '<div class="col-xl-6"><div class="postbox-details-input-box"><div class="postbox-details-input mb-20">
               <input type="email" name="email" id="email" placeholder="' . esc_attr__('Your email', 'exdos') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
         </div></div></div>',

            'url' => '<div class="col-xl-12">
                  <div class="postbox-details-input-box">
                     <div class="postbox-details-input mb-20">
               <input type="text" name="url" id="url" placeholder="' . esc_attr__('Your website', 'exdos') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
         </div></div></div></div>',
        );


        $defaults = [
            'fields'             => $fields,
            'comment_field' => '<div class="col-xxl-12 ' . $cl . '"><div class="postbox-details-input-box">
                     <div class="postbox-details-input mb-20">
                       <textarea id="comment" name="comment" placeholder="' . esc_attr__('Your Comment Here...', 'exdos') . '" required></textarea>
                </div></div></div>
            ',
            'submit_button' => '<div class="col-12"><div class="postbox-details-input-box">
                                    <button type="submit" class="tp-btn btn-text-flip d-inline-block">
                                       <span data-text="Send Message">' . esc_html__('Post Comment', 'exdos') . '</span>
                                    </button>
                                </div></div>',

            'cookies' => '<div class="col-xxl-12">
                <div class="postbox__comment-agree d-flex align-items-start mb-25">' .
                '<input class="e-check-input" type="checkbox" id="e-agree" name="wp-comment-agree" value="1" checked>' .
                '<label class="e-check-label" for="e-agree">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'exdos') . '</label></div>
            </div>'
        ];
        // Display the comment form
        comment_form($defaults);
        ?>
    </div><!-- .comments-area -->
<?php endif; ?>


<?php
// Move the comment textarea to the bottom
function move_comment_textarea_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_action('comment_form_fields', 'move_comment_textarea_to_bottom');
// comments for end 


// custom_comment_list
function custom_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
        // Display pingbacks and trackbacks differently if needed
        ?>
        <li class="pingback">
            <p><?php esc_html_e('Pingback:', 'exdos'); ?> <?php comment_author_link(); ?></p>
        </li>
        <?php
    } else {
        // Display regular comments
        ?>
        <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="postbox-comment-box d-flex">
                <div class="postbox-comment-info ">
                    <div class="postbox-comment-avater mr-20">
                        <?php echo get_avatar($comment, 50); ?>
                    </div>  
                </div>
                <div class="postbox-comment-text">
                    <div class="postbox-comment-name">
                        <span class="post-meta"> <?php comment_date(); ?></span>
                        <h5><?php comment_author(); ?></h5>
                    </div>
                    <p><?php comment_text(); ?></p>
                    <div class="postbox-comment-reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>    
                
                
        <?php
    }
}
