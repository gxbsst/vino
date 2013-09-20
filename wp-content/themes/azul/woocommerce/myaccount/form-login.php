<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<?php endif; ?>

<div class="col2-set" id="customer_login">

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
	<div class="span8 woo-login-form">
<?php else: ?>
	<div class="span12 woo-login-form">
<?php endif; ?>

	<div>

		<h2><?php _e( 'Registered customers', 'woocommerce' ); ?></h2>
		<form method="post" class="login">
			<p class="form-row form-row-first">
				<input type="text" class="input-text" placeholder="<?php _e( 'Username or email', 'woocommerce' ); ?>*" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<input class="input-text" placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<p class="form-row">
				<?php $woocommerce->nonce_field('login', 'login') ?>
				<span class="btn"><input type="submit" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /></span>
				<a class="lost_password" href="<?php

				$lost_password_page_id = woocommerce_get_page_id( 'lost_password' );

				if ( $lost_password_page_id )
					echo esc_url( get_permalink( $lost_password_page_id ) );
				else
					echo esc_url( wp_lostpassword_url( home_url() ) );

				?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
			</p>
		</form>

	</div>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="span4 woo-register-form"> 
		<h2><?php _e("Not registered?", "azul"); ?></h2>
		<p>Creating an account  is quick and easy, and will allow you to move through our checkout quicker.</p>

		<div class="register-button-wrapper">
			<button class="btn open-register-form">Register</button>
		</div>
	</div>

	<div class="col-2" id="register-popup">
		<div class="register-popup">
			<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
			<form method="post" class="register">

				<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

					<p class="form-row form-row-first">
						<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
					</p>

					<p class="form-row form-row-last">

				<?php else : ?>

					<p class="form-row form-row-wide">

				<?php endif; ?>

					<label for="reg_email"><?php _e( 'Email', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
				</p>

				<div class="clear"></div>

				<p class="form-row form-row-first">
					<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
				</p>
				<p class="form-row form-row-last">
					<label for="reg_password2"><?php _e( 'Re-enter password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
				</p>
				<div class="clear"></div>

				<!-- Spam Trap -->
				<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'register_form' ); ?>

				<p class="form-row-submit">
					<?php $woocommerce->nonce_field('register', 'register') ?>
					
					<span class="btn"><input type="submit" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" /></span>
				</p>

			</form>
		</div>
	</div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>