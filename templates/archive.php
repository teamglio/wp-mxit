<?php
  get_mxit_header();
  if ( have_posts() ) : ?>
      <h1>
          <?php
              if ( is_day() ) :
                  printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );

              elseif ( is_month() ) :
                  printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

              elseif ( is_year() ) :
                  printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );

              elseif ( is_category() ) :
                  single_cat_title('Browsing ');
                  
              else :
                  _e( 'Archives', 'twentyfourteen' );

              endif;
          ?>
      </h1>
      --------------
  <?php
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
          // Previous/next page navigation.
          //twentyfourteen_paging_nav();

      else :
          // If no content, include the "No posts found" template.
          get_template_part( 'content', 'none' );

  endif;
  get_mxit_nav();
  get_mxit_footer();
//}
?>