<div class="galerie">
    <?php
    $loop = $args['loop'];
    ?>
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
        <?php
        $thumbnail_id = get_post_thumbnail_id();
        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
        ?>
        <div class="galerie_photo">
            <div class="hover_lightbox">
                <img class="fullscreen" src="<?php echo get_stylesheet_directory_uri(); ?>/images/fullscreen.png" data-src="<?php echo esc_url($image[0]); ?>" data-ref="<?php echo get_field("reference"); ?>" data-cat="<?php echo get_the_terms($post, "photo-categorie")[0]->name; ?>">
                <a href="<?php the_permalink() ?>"><img class="oeil" src="<?php echo get_stylesheet_directory_uri(); ?>/images/oeil.png"></a>
                <div class="ref">
                    <p><?php echo strtoupper(get_field("reference")); ?></p>
                </div>
                <div class="cat">
                    <p><?php echo strtoupper(get_the_terms($post, "photo-categorie")[0]->name); ?></p>
                </div>
            </div>
            <a href="#" data-ref="<?php echo strtoupper(get_field("reference")); ?>" data-cat="<?php echo get_the_terms($post, "photo-categorie")[0]->name; ?>">
                <!-- <div class="galerie_photos"> -->
                <?php the_post_thumbnail(); ?>
                <!-- </div> -->
            </a>
        </div>
        <?php the_terms($post->ID, 'photos', 'Photo'); ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>