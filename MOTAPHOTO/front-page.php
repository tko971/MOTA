<?php get_header(); ?>

<div class="bannerimg">
  <div class="bannerimage">
    <?php $loop = new WP_Query(array('post_type' => 'photo', 'posts_per_page' => 1, "orderby" => "rand")); ?>
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
      <?php the_post_thumbnail(); ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  </div>
  <div class="titrebanniere">
    <?php echo wp_get_attachment_image(135, "", array("class" => "img-responsive"));  ?>
  </div>
</div>

<div class="taxonomy">
  <div class="categorie">
    <?php $categories = get_terms(['taxonomy' => 'photo-categorie']) ?>
    <select id='listecategories'>
      <option value="">CATEGORIES</option>
      <?php foreach ($categories as $categorie) { ?>
        <option value="<?= $categorie->term_id; ?>"><?= $categorie->name; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="format">
    <?php $formats = get_terms(['taxonomy' => 'format']) ?>
    <select id='listeformats'>
      <option value="">FORMATS</option>
      <?php foreach ($formats as $format) { ?>
        <option value="<?= $format->term_id; ?>"><?= $format->name; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="trier">
    <select id='ordre'>
      <option value="DESC">TRIER PAR</option>
      <option value="ASC">A partir des plus anciennes</option>
      <option value="DESC">A partir des plus récentes</option>
    </select>
  </div>
</div>

<?php $loop = new WP_Query(array('post_type' => 'photo', 'posts_per_page' => 8,)); ?>
<?php get_template_part('templates_part/photo-block', null, array('loop' => $loop)); ?>



<div class="loadmore">Charger plus</div>
<?php get_footer(); ?>