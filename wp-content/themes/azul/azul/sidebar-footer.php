<?php
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	)
		return;
?>
<div class="row-fluid">
<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
	<ul class="span3">
		<?php do_shortcode(dynamic_sidebar( 'first-footer-widget-area' )); ?>
	</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
	<ul class="span3">
		<?php do_shortcode(dynamic_sidebar( 'second-footer-widget-area' )); ?>
	</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
	<ul class="span3">
		<?php do_shortcode(dynamic_sidebar( 'third-footer-widget-area' )); ?>
	</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
	<ul class="span3">
		<?php do_shortcode(dynamic_sidebar( 'fourth-footer-widget-area' )); ?>
	</ul>
<?php endif; ?>
</div>