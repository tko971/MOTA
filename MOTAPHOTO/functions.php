<?php
//STYLES
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
  wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/mota.css', array(), filemtime(get_stylesheet_directory() . '/css/mota.css'));
  wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery', 'lightbox-script'), filemtime(get_stylesheet_directory() . '/js/scripts.js'), true);
  wp_enqueue_script('lightbox-script', get_stylesheet_directory_uri() . '/js/lightbox.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/lightbox.js'), true);
  $ajax = array(
    "ajaxurl" => admin_url("admin-ajax.php"),
  );
  wp_add_inline_script('theme-script', 'let ajax_data=' . wp_json_encode($ajax) . ";", "before"); //traitement des requetes ajax

}

//MENU
function register_my_menu()
{

  register_nav_menu('main-menu', __('Menu Principal'));
  register_nav_menu('footer-menu', __('Menu Footer'));
}
add_action('init', 'register_my_menu');

//LOGO
add_theme_support('custom-logo');

//CHARGER PLUS AVEC AJAX

add_action("wp_ajax_load_posts", "load_posts");
add_action("wp_ajax_nopriv_load_posts", "load_posts");

function load_posts()
{
  //check_ajax_referer('load_more_posts','security');

  $args = array(
    "post_type" => "photo",
    "post_status" => "publish",
    "post_per_page" => -1, //on va toutes les chercher
    "offset" => 8, //decalage ira en chercher a partir du 9eme

  );

  $loop = new WP_Query($args);

  while ($loop->have_posts()) : $loop->the_post();

?>
    <?php
    $thumbnail_id = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src($thumbnail_id, 'full');
    ?>
    <div class="galerie_photo">
      <div class="hover_lightbox">
        <img class="fullscreen more" src="<?php echo get_stylesheet_directory_uri(); ?>/images/fullscreen.png" data-src="<?php echo esc_url($image[0]); ?>" data-ref="<?php echo get_field("reference"); ?>" data-cat="<?php echo get_the_terms($post, "photo-categorie")[0]->name; ?>">
        <a href="<?php the_permalink() ?>"><img class="oeil" src="<?php echo get_stylesheet_directory_uri(); ?>/images/oeil.png"></a>
        <div class="ref">
          <p><?php echo get_field("reference"); ?></p>
        </div>
        <div class="cat">
          <p><?php echo get_the_terms($post, "photo-categorie")[0]->name; ?></p>
        </div>
      </div>
      <!-- <div class="galerie_photos"> -->
      <a href="#" data-ref="<?php echo get_field("reference"); ?>" data-cat="<?php echo get_the_terms($post, "photo-categorie")[0]->name; ?>"><?php the_post_thumbnail(); ?></a>
      <!-- </div> -->
    </div>
    <?php the_terms($post->ID, 'photos', 'Photo'); ?>
  <?php endwhile;
  wp_reset_postdata(); ?>
  <?php
  //wp_send_json()
  die();
}

//FILTER

add_action("wp_ajax_filtrephoto", "filtrephoto");
add_action("wp_ajax_nopriv_filtrephoto", "filtrephoto"); //non connecté
function filtrephoto()
{
  $tax_query = [];


  if (!empty($_POST["categorie"])) {
    $tax_query[] = array(
      "taxonomy" => "photo-categorie",
      "field" => "id",
      "terms" => $_POST["categorie"],
    );
  }

  if (!empty($_POST["format"])) {
    $tax_query[] = array(
      "taxonomy" => "format",
      "field" => "id",
      "terms" => $_POST["format"],
    );
  }

  $args = array(
    'post_type' => 'photo',
    "orderby" => "date",
    "order" => $_POST['ordre'],
  );
  if (!empty($tax_query)) {
    $args["tax_query"] = $tax_query;
  }


  $loop = new WP_Query($args);
  if ($loop->have_posts()) {
    while ($loop->have_posts()) : $loop->the_post();
  ?>
      <div class="galerie_photo">
      <div class="hover_lightbox">
        <img class="fullscreen more" src="<?php echo get_stylesheet_directory_uri(); ?>/images/fullscreen.png" data-src="<?php echo esc_url($image[0]); ?>" data-ref="<?php echo get_field("reference"); ?>" data-cat="<?php echo get_the_terms($post, "photo-categorie")[0]->name; ?>">
        <a href="<?php the_permalink() ?>"><img class="oeil" src="<?php echo get_stylesheet_directory_uri(); ?>/images/oeil.png"></a>
        <div class="ref">
          <p><?php echo get_field("reference"); ?></p>
        </div>
        <div class="cat">
          <p><?php echo get_the_terms($post, "photo-categorie")[0]->name; ?></p>
        </div>
      </div>
      <!-- <div class="galerie_photos"> -->
      <a href="#" data-ref="<?php echo get_field("reference"); ?>" data-cat="<?php echo get_the_terms($post, "photo-categorie")[0]->name; ?>"><?php the_post_thumbnail(); ?></a>
      <!-- </div> -->
    </div>
      <?php the_terms($post->ID, 'photos', 'Photo'); ?>
  <?php endwhile;
  } else {
    echo "<p>Aucune photo trouvé</p>";
  }

  wp_reset_postdata(); ?>
<?php
  //wp_send_json()
  die();
}
