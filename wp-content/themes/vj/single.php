<?php get_header(); ?>
<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">
		<?php while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content( $more_link_text = null, $stripteaser = false )(); ?>

		<?php comments_template('', true); ?>
		
		<?php endwhile; ?>

		</section>
		<aside class="sidebar span4 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 
	</div>
</div>
<?php get_footer(); ?>