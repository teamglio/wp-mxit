<?php

  echo '<h1>' . get_bloginfo() . '</h1>';

  get_mxit_nav();

  echo "home.php";

  /**
  // Start the Loop.
  while ( have_posts() ) : the_post();
      echo "<h1>";
      the_title();
      echo "</h1>";
      echo "-----------------";
      the_content();
      
      // Comments
      // If comments are open or we have at least one comment, load up the comment template.
      //if ( comments_open() || get_comments_number() ) {
      //    comments_template();
      //}
  endwhile;
  **/

  get_mxit_footer();

?>