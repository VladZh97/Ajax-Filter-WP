<div class="category__list">
  <ul class="category__items">
    <li class="category__btn category__btn--active  js-filter-item"><a href="<?home_url('blog');?>" class="category__link">Najnowsze artykuły</a></li>
      <?php
          $cat_args = array(
              'exclude' => array(1),
              'option_all' => 'All',
              'hide_empty' => false,
              'order' => 'ASC',
              'orderby' => 'ID',
          );
          $categories = get_categories($cat_args);
          foreach ($categories as $cat): ?>
              <li class="category__btn js-filter-class="category__link" data-categ$cat->term_id?>" href="<?= get_cate($cat->term_id)?>"><?=$cat->name?></a></li>
         <?php endforeach;
      ?>
  </ul>
</div>


<div class="posts js-filter">
  <?php

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);

    if($query -> have_posts()):
        while($query -> have_posts()):
            $query -> the_post();?>
                <a href="<?php echo the_permalink(); ?>" class="post__body">
                    <div class="post__body-image"><?php the_post_thumbnail('full'); ?></div>
                    <p class="post__body-date"><?php echo get_the_date(); ?></p>
                    <h1 class="post__body-title"><?php the_title();?></h1>
                </a>
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>