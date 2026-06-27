<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Sticky Navbar (outside hero) -->
<nav id="navbar">
  <a href="<?php bloginfo( 'home' ); ?>" class="logo">DLTB <em>CO</em></a>

    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => 'ul',
        'menu_class'     => 'nav-links',
        'fallback_cb'    => false,
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'walker'         => new DLTB_Walker_Nav_Menu(), 
    ) );
    ?>

    <a href="#booking" class="btn-book-nav">Book Now</a>

    <!-- Hamburger (mobile) -->
    <button class="hamburger" id="hamburger" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- Mobile menu (hidden by default) -->
<div class="mobile-menu" id="mobile-menu">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => 'ul',
        'menu_class'     => 'mobile-nav-list',
        'fallback_cb'     => '__return_false',
        'depth'           => 2,
    ) );
    ?>
    <a href="#" class="m-book">Book Now</a>
</div>

<main>