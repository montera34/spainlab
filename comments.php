<?php // Do not delete these lines
if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
	die ('Please do not load this page directly. Thanks!<br />Por favor, no intentes acceder a esta p&aacute;gina directamente. Gracias.');
?>

<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.'); ?></p>
</div><!-- #comments -->
	<?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
		return;
	endif; ?>

	<?php
        // You can start editing here -- including this comment!
	?>

        <div class="comments_heading clear">
            <div class="comment_qty"><?php
		human_comment_count();
//                printf( _n('No comments', '%1$s comments', get_comments_number()),
//                number_format_i18n( get_comments_number() ), '' );
                ?></div>
            <div class="add_comment"><a href="#respond">Submit yours</a></div>
        </div>

    <?php if (have_comments()) : ?>

        <div class="comment_list">
            <ol>
            <?php
                wp_list_comments(array(
			'style' => 'ol',
			'type' => 'comment',
			'avatar_size' => 64,
			'reply_text' => 'respond to this comment',
			'login_text' => 'you must log in to comment',
			'callback' => 'commentlist')
		);
            ?>
            </ol>
        </div><!-- end #comment_list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comments-nav">
			<div class="nav-previous"><?php previous_comments_link('Previous comments'); ?></div>
			<div class="nav-next"><?php next_comments_link('Next comments'); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far

		if ('open' == $post->comment_status) { // If comments are open, but there are no comments
			//echo '<p class="nocomments">No hay comentarios en esta entrada.</p>';
		} else { // comments are closed 
			echo '<p class="nocomments">Comments are closed in this post.</p>';
		}

    endif; // end have_comments() ?>



    <?php if ('open' == $post->comment_status) : ?>

    <div id="respond" class="clear">
        <div class="respond_meta">
		<?php comment_form_title( 'Submit comment', 'Respond to %s' ); ?>
	</div>
        <div class="comment_form page-text">

        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
            <p class="comment_message">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
        <?php else : ?>

            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" onSubmit="return checkFields();">

                <?php if ( $user_ID ) : ?>

                    <p class="comment_message">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

                <?php else : ?>
                    <div class="user_data">
				<fieldset>
					<?php if($req) echo "<span class='req'>*</span>"; ?>
					
					<input type="text" name="author" id="author" value="" size="22" tabindex="1" /> 
					<label for="author">Name</label>					
				</fieldset>
				<fieldset>
					<?php if($req) echo "<span class='req'>*</span>"; ?>
					<input type="text" name="email" id="email" size="22" tabindex="2" value="" />
					<label for="email">Email (won't be publish) </label>
				</fieldset>
				<fieldset>
					<input type="text" name="url" id="url" size="22" tabindex="3" value="" placeholder="http://" />
					<label for="url">Website</label>
				</fieldset>
                    </div>
                <?php endif; ?>

                <!--<p class="comment_message"><small><strong>XHTML:</strong> You can use these tags: <code><?php //echo allowed_tags(); ?></code></small></p>-->

                <fieldset class="comment_field">
<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
		<!--<label for="comment">Comentario</label>-->
                    <textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
                </fieldset>

		<fieldset class="comment_submit">
			<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="Submit" />
                	<?php comment_id_fields(); ?>
		</fieldset>  
		<fieldset class="cancel" id="cancel-comment-reply">
			<?php cancel_comment_reply_link('Cancel reply'); ?>
		</fieldset>
		<fieldset class="comment_suscrip">
	                <?php do_action('comment_form', $post->ID); ?>
		</fieldset>

            </form>

        <?php endif; // If registration required and not logged in ?>

        </div>

        <?php endif; // if you delete this the sky will fall on your head ?>

    </div>

</div>
<?php //endif; // end ! comments_open() ?>
<!-- #comments -->
