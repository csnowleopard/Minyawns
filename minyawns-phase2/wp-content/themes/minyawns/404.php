<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
 <div class="container">
	<div class="main-content ">
	<div class="alert alert-info page-error" >
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">


			<div class="page-wrapper">
				<div class="page-content">
					<img src="<?php echo get_template_directory_uri(); ?>/images/404error.png" style="margin:auto; display:block;"/>
					<p style="text-align:center;"><?php _e( 'Look like something Wrong ! the page you were looking is not there 
 ', 'minyawns' ); ?></p>

			<a href="<?php echo site_url(); ?>" class="btn btn-medium btn-block green-btn btn-success ">Go Home</a>
					<?php //get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->
	<div>
			</div><!-- #content -->
	</div><!-- #primary -->
			</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>