<?php get_header(); ?>
<div class="main-single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="post">
        <div class="singleimg">
          <?php if (has_post_thumbnail()) {
            the_post_thumbnail('full', array('itemprop' => 'image'));
          } ?>
        </div>
        <div class="postinfo">
          <h1 class="post-title"><?php the_title(); ?></h1>
          <p>RÉFÉRENCE : <?php echo strtoupper(get_field("reference")); ?></p>
          <p>CATÉGORIE : <?php echo strtoupper(get_the_terms($post, "photo-categorie")[0]->name); ?></p>
          <p>FORMAT : <?php echo strtoupper(get_the_terms($post, "format")[0]->name); ?></p>
          <p>TYPE : <?php echo strtoupper(get_field("type")); ?></p>
          <p>ANNÉE : <?php the_date("Y"); ?></p>
        </div>

      </div>
      <div class="contactsingle">
        <div class="cta">
          <p>Cette photo vous interesse?</p>
          <button class="btn-contact">Contact</button>
        </div>

        <?php $prevPost = get_previous_post(); ?>
        <?php $nextPost = get_next_post(); ?>

        <div class="pagination">
          <div class="pagination-images">
            <?php if ($prevPost) { ?>
              <div class="imgprev">
                <?php
                $prevThumbnail = get_the_post_thumbnail($prevPost->ID);
                previous_post_link($prevThumbnail);
                ?>
              </div>
            <?php } ?>
            <?php if ($nextPost) { ?>
              <div class="imgnext">
                <?php
                $nextThumbnail = get_the_post_thumbnail($nextPost->ID);
                next_post_link($nextThumbnail);
                ?>
              </div>
            <?php } ?>
          </div>
          <div class="pagination-arrows">
            <?php if ($prevPost) { ?>
              <a class="link-prev" href="<?php echo get_the_permalink($prevPost->ID); ?>">
                <img class="sliderprev" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Lineg.png">
              </a>
            <?php } ?>
            <?php if ($nextPost) { ?>
              <a class="link-next" href="<?php echo get_the_permalink($nextPost->ID); ?>">
                <img class="slidernext" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Lined.png">
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
<div class="vousaimerez">
  <h3> VOUS AIMEREZ AUSSI </h3>
  <div class="vousaimerezimg">
    <?php
    $categories = get_the_terms(get_the_ID(), 'photo-categorie');
    if ($categories) :
      $slug = $categories[0]->slug;
      $args = array(
        'post_type' => 'photo',
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 2,
        'oderby' => 'rand',
        'tax_query' => array(
          array(
            'taxonomy' => 'photo-categorie',
            'field' => 'slug',
            'terms' => $slug,
          ),
        )
      );
      $loop = new WP_Query($args);
    ?>

      <?php get_template_part('templates_part/photo-block', null, array('loop' => $loop)); ?>

    <?php endif; ?>
  </div>

  <?php get_footer(); ?>