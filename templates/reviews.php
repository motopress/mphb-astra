<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @link https://developer.wordpress.org/reference/functions/comment_form/
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required() || !mphbr_is_reviews_enabled_for_post()) {
    return;
}

do_action('mphbr_reviews_content_before');

?>

    <div id="comments" class="comments-area mphb-reviews">

        <?php do_action('mphbr_reviews_content'); ?>

        <div class="mphbr-new-review-box mphb-hide">
            <?php

            $comments_args = apply_filters(
                'mphbr_comment_form_args',
                array(
                    'class_form' => 'mphbr-review-form comment-form',
                    'label_submit' => esc_html__('Post review', 'mphb-astra'), // Change the title of send button
                    'title_reply' => sprintf(esc_html__('Review "%s"', 'mphb-astra'), get_the_title()), // Change the title of the reply section
                    'comment_field' => '<p class="comment-form-comment"><label for="comment">' .
                        esc_html__('Your review', 'mphb-astra') .
                        '</label> <textarea id="comment" name="comment" cols="45" rows="4" maxlength="65525" required="required"></textarea></p>'
                )
            );

            comment_form($comments_args);

            ?>
        </div>

        <?php if (have_comments()) { ?>

            <ol class="comment-list ast-comment-list">
                <?php
                $list_args = apply_filters(
                    'mphbr_list_comments_args',
                    array(
                        'style' => 'ol',
                        'short_ping' => true,
                        'avatar_size' => 50,
                        'callback' => 'astra_theme_comment'

                    )
                );

                wp_list_comments($list_args);

                ?>
            </ol><!-- .comment-list -->

            <?php

            $comments_navigation_args = apply_filters(
                'mphbr_comments_navigation_args',
                array(
                    'prev_text' => esc_html__('Older reviews', 'mphb-astra'),
                    'next_text' => esc_html__('Newer reviews', 'mphb-astra'),
                )
            );

            the_comments_navigation($comments_navigation_args);

            ?>

            <?php // If comments are closed and there are comments, let's leave a little note, shall we? ?>

        <?php } else if (comments_open()) { ?>
            <p class="no-comments"><?php esc_html_e('There are no reviews yet.', 'mphb-astra'); ?></p>
        <?php } ?>

    </div><!-- #comments -->

<?php

do_action('mphbr_reviews_content_after');
