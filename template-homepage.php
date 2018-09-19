<?php 

/**
* Template Name: Homepage
*
**/

get_header(); ?>
<main id="content" class="content" itemscope itemtype="WebPageElement" itemprop="mainContentOfPage" tabindex="-1">
	<header class="banner" <?php cascade_the_banner_image(); ?>>
		<div class="container">
			<h1 class="banner__title">
				<?php the_title(); ?>
			</h1>

			<div class="banner__subtitle"></div>
		</div>
	</header>
  
  	<!-- Start of homepage banner -->
	<div class="homepage homepage__video">
    	<div class="container">
            <div class="grid">
            	<div class="column">
            		<?php if ( get_field('video_heading') ) : ?>
            		 	<h2 class="heading"><?php echo get_field('video_heading') ?></h2>
            		<?php endif; ?> 
            		<?php if ( get_field('video') ) : ?>	
                		 <div class="inner-video">
                		     <?php echo get_field('video') ?>
                		 </div>
            		 <?php endif; ?>
            	</div>
            	<div class="column">
                	<?php if( get_field('video_heading_2') ) : ?>
                		 <h4 class="latest-uploads-heading"><?php echo get_field('video_heading_2') ?></h4>
                	<?php endif; ?>	 
            		<div class="latest-uploads-wrapper">
						<?php echo do_shortcode('[mbb_latest_uploads]') ?>
            		</div>
            	</div>
            </div>
        </div>    
    </div>   
    <!-- End of homepage banner -->

    <!-- Start of homepage latest videos -->
    <div class="homepage homepage__latest-videos">
        <div class="container">
        	<?php if( get_field('featured_video_heading') ) : ?>
        	   <h2 class="heading text-center"><?php echo get_field('featured_video_heading'); ?></h2>
        	<?php endif; ?>

			<?php echo do_shortcode('[mbb_featured_videos]') ?>
        </div>	 
    </div>
    <!-- End of homepage latest videos -->

    <!-- Start of homepage latest videos -->
    <div class="homepage homepage__success-stories">
        <div class="container">
        	<?php if( get_field('video_heading_3') ) : ?>
        	   <h2 class="heading text-center"><?php echo get_field('video_heading_3'); ?></h2>
        	<?php endif; ?>

			<?php echo do_shortcode('[mbb_success_stories]') ?>
        </div>	 
    </div>
    <!-- End of homepage latest videos -->

    </div> 
</main>

<?php get_footer(); ?>