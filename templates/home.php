<h1><?php bloginfo('name'); ?></h1>
<?php get_mxit_header();
    if (is_page()) {
        the_content();
    } else {
        echo 'Archive to be called here';
    }
?>