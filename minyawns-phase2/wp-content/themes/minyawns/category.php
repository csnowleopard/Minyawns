<?php

get_header(); ?>
<div class="blog-bg">
<!-- <h3><img src="<?php echo get_template_directory_uri(); ?>/images/big-minyawns.png"/> Blog</h3> -->
<?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>
</div>
<div class="container bg-white ">
		<div class="row-fluid blog-container">
				<div class="span1"></div>
				<div class="span8 blog-data">

		<?php if ( have_posts() ) : ?>
		
		
				
			

		<?php while ( have_posts() ) : the_post(); ?>
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

  
	<?php twentythirteen_paging_nav(); ?>
	

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

</div>
				<div class="span3 blog-sidebar"><?php get_sidebar(); ?></div>
				
			</div>
</div>


<?php get_footer(); ?>