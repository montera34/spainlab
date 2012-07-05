<?php if (get_post_type() == 'architects'): // ---Architects--- Tiene que estar escrito con mayúscula para funcionar.?>
<?php the_title(); ?>
<?php the_content(); ?>

TEST This is an architect

<?php elseif (get_post_type() == 'remotes' ) : // ---Remotes---- ?>
<?php the_title(); ?>
<?php the_content(); ?>

TEST This is a remote

<?php else : ?>

<?php the_title(); ?>
<?php the_content(); ?>
TEST ALL

<?php endif ; ?>
