<?php global $options_data; ?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta  charset="<?php bloginfo( 'charset' ); ?>" />

	<?php is_responsive(); ?>
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	  
	<?php theme_styles(); ?>
	
	<?php wp_enqueue_script("jquery"); ?>

	<?php theme_after_styles(); ?>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(is_boxed("class")); echo is_boxed("style"); ?>>

<div id="site-wrapper">
	<div id="site-inner-wrapper">

      <header id="site-header" class="container">

        <?php get_logo_and_search(); ?>
		
		<?php get_menu(); ?>

      </header>
