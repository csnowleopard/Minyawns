<?php /* Template Name: Real Estate Landing Page Template */ ?>
    <?php get_header(); ?>
    <div class="realestate-landing">
        <div class="container">
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php echo the_content(); ?>
                </article>
                <!-- /article -->
            <?php endwhile; ?>
            <?php endif; ?>
            
            <div class="cta_text">
                <h2>Your Personal Assistant</h2>
                <h4>Only when you want it.</h4>
            </div>
            
            <div class="cta_button">
                <a href="#myModal" data-toggle="modal" id="link_employerregister" onclick="return true">Get Your Minyawn &raquo;</a>
                <a href="/">More Info &raquo;</a>
            </div>
            <br style="clear:both;">
        </div>
        <br style="clear:both;">
    </div>
    <br style="clear:both;">
    <?php get_footer(); ?>