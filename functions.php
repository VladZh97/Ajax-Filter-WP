<?php

function my_enqueue() {

  wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/script.js', array('jquery') );

  wp_localize_script( 'ajax-script', 'my_ajax_object',
          array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );


add_action( 'wp_ajax_nopriv_filter','filter_ajax' );
add_action( 'wp_ajax_filter','filter_ajax' );

function filter_ajax() {

  $category = $_POST['category'];


  $args = array ( 
    'post_type' => 'post', 
    'posts_per_page' => -1
  );

  if(isset($category)) { 
    $args['category__in'] = array($category); 
  }

  $query = new WP_Query($args);

  if($query->have_posts()): 
    while($query->have_posts()) : $query->the_post(); ?>

      <a href="<?php echo the_permalink(); ?>" class="post__body">
          <div class="post__body-image"><?php the_post_thumbnail('full'); ?></div>
          <p class="post__body-date"><?php echo get_the_date(); ?></p>
          <h1 class="post__body-title"><?php the_title();?></h1>
      </a>
    <?php endwhile;
          endif;
    wp_reset_postdata();
  die();
}

?>