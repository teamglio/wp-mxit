<?php
  get_mxit_header();
  if ( have_posts() ) : ?>
      <h1>
          <?php
              if ( is_day() ) :
                  printf( __( 'Daily Archives: %s', 'wp-mxit' ), get_the_date() );

              elseif ( is_month() ) :
                  printf( __( 'Monthly Archives: %s', 'wp-mxit' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

              elseif ( is_year() ) :
                  printf( __( 'Yearly Archives: %s', 'wp-mxit' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wp-mxit' ) ) );

              elseif ( is_category() ) :
                  single_cat_title('');
                    
              else :
                  _e( 'Posts', 'wp-mxit' );

              endif;
          ?>
      </h1>
      --------------
  <?php

          $queried_object = get_queried_object();
          $cat_ID = $queried_object->cat_ID ;

          query_posts( array( 'cat' => $cat_ID, 'orderby' => 'date', 'order' => 'ASC') );

          // Start the Loop.
          while ( have_posts() ) : the_post();

             echo '<br><a href="';
             the_permalink();
             echo '">';
             echo $wp_query->current_post + 1;
             echo '</a> ) <a href="';
             the_permalink();
             echo '">';
             the_title();
             echo '</a>';
             the_excerpt();
             echo '----------------';


          endwhile;

          wp_reset_query();

      else :
          // If no content, include the "No posts found" template.

  endif;
  get_mxit_nav();
  get_mxit_footer();
//}
?>