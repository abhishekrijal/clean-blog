<?php 
/**
 * Post content template part.
 * @package Clean_Blog
 */

?>

    <div class="post-preview">
    <a href="<?php the_permalink(); ?>">
        <?php the_title( '<h2 class="post-title">', '</h2>' ); ?>
        <h3 class="post-subtitle">
        <?php the_excerpt(); ?>
        </h3>
    </a>
   
    <?php clean_blog_posted_on(); ?>

    </div>
    <hr>
