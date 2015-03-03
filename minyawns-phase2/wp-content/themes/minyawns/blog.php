<?php
/*
Template Name: Blog
*/
get_header();

?>
<div class="blog-bg">
<!-- <h3><img src="<?php echo get_template_directory_uri(); ?>/images/big-minyawns.png"/> Blog</h3> 
<?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>-->
</div>
<div class="container bg-white ">
		<div class="row-fluid blog-container">
				<div class="span1"></div>
				<div class="span8 blog-data">
			<?php // Display blog posts on any page @ http://m0n.co/l
		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query('showposts=100' . '&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				  <div class="post-item">
    <div class="post-info">
      <h2 class="post-title">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
      <?php the_title(); ?>
      </a>
      </h2>
   <span class="post-meta">by <?php the_author(); ?> | <?php the_time('F j, Y'); ?> | Posted in <?php the_category(', ') ?> | <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span>
    </div>
    <div class="post-content">
	<?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail();
} 
?>
<?php echo do_shortcode('[ssba]'); ?>
<?php the_excerpt(); ?>
<a class="readmore" href="<?php the_permalink(); ?>">Read More</a>
    </div>
  </div>

	<?php endwhile; ?>
	<?php if ($paged > 1) { ?>

		<nav id="nav-posts">
			<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
			<div class="next"><?php previous_posts_link('Newer Posts &raquo;'); ?></div>
		</nav>

		<?php } else { ?>

		<nav id="nav-posts">
			<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
		</nav>

		<?php } ?>
		
				</div>
				<div class="span3 blog-sidebar"><?php get_sidebar(); ?></div>
				
			</div>
</div>


<?php get_footer(); ?>