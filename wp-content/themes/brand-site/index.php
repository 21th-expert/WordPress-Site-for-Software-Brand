<?php
/**
 * Fallback template for the Brand Site theme.
 */
get_header();
?>
<main id="site-content" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
</main>
<?php
get_footer();
