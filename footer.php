<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Drunk_Education
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info container">
			<div>
				<h6><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h6>
				<p>
				Copyright 2016 - 2017. <br>
				<a href="mailto:info@drunkeducation.com">Email</a> &middot; 
				<a href="http://twitter.com/drunkeducate" target="_blank">Twitter</a> &middot; 
				<a href="http://facebook.com/drunkeducate" target="_blank">Facebook</a>
				</p>
			</div>
			<div>
				<h6>Stay in Touch</h6>
				<div id="mc_embed_signup">
				<form action="//drunktedtalks.us14.list-manage.com/subscribe/post?u=08810a1b890a65f85f62da9e1&amp;id=69c2ae0046" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
				<div class="mc-field-group">
					<input type="email" value="" placeholder="name@email.com" name="EMAIL" class="required email" id="mce-EMAIL">
				</div>
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_08810a1b890a65f85f62da9e1_69c2ae0046" tabindex="-1" value=""></div>
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
				    </div>
				</form>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
