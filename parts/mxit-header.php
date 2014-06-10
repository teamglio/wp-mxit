<div>
  <mxit:advert auid="<?php echo get_option('wp_mxit_auid'); ?>">
  </mxit:advert>
</div>

<h1><?php bloginfo('name'); ?></h1>

<?php

$defaults = array(
    'theme_location'  => 'mxit_header_nav',
    'menu'            => '',
    'container'       => 'div',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''
);

wp_nav_menu( $defaults );

?>