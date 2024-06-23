<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="wrapper" class="hfeed">
    <header id="header" role="banner">
      <div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <?php if (has_custom_logo()) : ?><?php the_custom_logo(); ?>
      <?php else : ?>
        <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
      <?php endif; ?>
      </div>
      <nav id="menu" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
          <span class="line l1"></span>
          <span class="line l2"></span>
          <span class="line l3"></span>
        </button>
        <?php
        wp_nav_menu(
          [
            "theme_location" => "main-menu",
            "container" => "div",
            "menu_class" => "menu",
          ]
        );
        ?>
      </nav>
    </header>
  </div>
  <div id="container">
    <main id="content" role="main">