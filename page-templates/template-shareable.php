<?php
/**
 * Template Name: Shareable System Centre
 */

get_header(); ?>

<main id="content" class="content" itemscope itemtype="WebPageElement" itemprop="mainContentOfPage" tabindex="-1">
	<article <?php post_class( 'entry--full' ); ?> itemscope itemtype="http://schema.org/CreativeWork">
		<?php while ( have_posts() ) : the_post(); ?>
			
				<header class="banner" <?php cascade_the_banner_image(); ?>>
					<div class="container">
						<h1 class="banner__title" itemprop="headline">
							<?php cascade_the_banner_title();  ?>
						</h1>

						<div class="banner__subtitle"></div>
					</div>
				</header>
		<?php endwhile; ?>
		<div class="container">
        	<?php while (have_posts()) : the_post(); ?>
            	<?php the_content(); ?>                                    
			<?php endwhile; ?>
			<div class="entry__content  clearfix homepage__latest-videos sharepage" itemprop="text">
				<div class="grid " id="featured-videos">
                
                
                
                    		<?php
                                query_posts(array(
                                    'post_type' => 'shareable_files',
                                    'paged'          => $paged,
                                    'order'          => 'ASC',
                                    //'post_status'    => 'publish',
                                    'post_parent'    => 0,  
									'posts_per_page'	=> 3,  
									'orderby'			=> 'menu_order',
                                    ));
							?>
                               
                                 <?php if (have_posts()) : ?>
                               
                                <?php while (have_posts()) : the_post(); ?>
                  
					<div class="column">
						<div class="single-post">	
							<div class="video-thumbnail">
								<img src="<?php the_field('thumbnail'); ?>" class="share-thumb">
								<div class="doc-type">
<a href="<?php the_field('link'); ?>" title="download <?php the_field('file_type'); ?> - <?php the_title(); ?>" class="share-hover" target="new" download>
<?php if (get_field('file_type') == 'document') { ?>
	<img src="<?php echo get_option('home'); ?>/wp-content/themes/prod-mbb-live/assets/share/document.svg" />
<?php } elseif (get_field('file_type') == 'video') { ?>
	<img src="<?php echo get_option('home'); ?>/wp-content/themes/prod-mbb-live/assets/share/video.svg" />
<?php } elseif (get_field('file_type') == 'presentation') { ?>
	<img src="<?php echo get_option('home'); ?>/wp-content/themes/prod-mbb-live/assets/share/presentation.svg" />
<?php } elseif (get_field('file_type') == 'spreadsheet') { ?>
	<img src="<?php echo get_option('home'); ?>/wp-content/themes/prod-mbb-live/assets/share/sheet.svg" />
<?php } elseif (get_field('file_type') == 'other') { ?>
	<img src="<?php echo get_option('home'); ?>/wp-content/themes/prod-mbb-live/assets/share/other.svg" />
<?php } else { ?>
<?php }?>
</a>
								</div><!-- doc-type -->	
							</div><!-- video-thumbnail -->
							<div class="video-details">
								<p class="name share-name">
                                	<a href="<?php the_field('link'); ?>" title="download <?php the_field('file_type'); ?> - <?php the_title(); ?>" class="share-link" target="new" download>
										<?php the_title(); ?>
                                    </a>
                                </p>
                                <div class="share-desc">
                                <?php the_content(); ?>
                                </div>
								<div class="content-footer">
                                	<div class="presenter"><?php the_field('submitted_by'); ?></div>
                                    <div class="presenter"><?php the_field('date_submission'); ?></div>
                            	</div>								
							</div><!-- video-details -->
						</div><!-- single-post -->
					</div><!-- column -->
                    
                     <?php endwhile; ?>
                        
                        <div class="clear-share">   
                        	<center>     
                            <nav class="pagination" role="navigation">
                                <?php echo paginate_links( $args ); ?>
                            </nav>
                            </center>
                        </div>
                                <?php endif; ?>  
                                <?php wp_reset_query();?>  
                </div><!-- featured-videos -->			
			</div>
		</div>
	</article>
	
</main>
<style>
.sharepage{
	background:none !important;
	padding:1em 0;
	}
.clear-share{width:100%;}
.share-post{position:relative}
.share-name{
	height:35px;
	margin-bottom:0.5em !important
}
.doc-type{
	transition: all .2s ease-in-out; 
	position:absolute;
	width:40px;
	height:40px;
	top:-20px;
	right:-20px;
}

img.share-thumb{
	border-bottom: 4px solid #001e36;
    border-image: linear-gradient(90deg, rgba(0,30,54,1) 0%, rgba(0,169,198,1) 100%);
    border-image-slice: 1;
    border-radius: 4px;
    -webkit-border-radius: 4px;
}

.single-post:hover .doc-type{
	position:absolute;
	width:50px;
	height:50px;
	top:-25px;
	right:-25px;
	overflow:visible;
}
.share-desc{
	height:80px;
	overflow-y: auto;
	margin-bottom:3em;
	font-size:0.8em;
}

/* width */
.share-desc::-webkit-scrollbar {
  width: 3px;
}
/* Track */
.share-desc::-webkit-scrollbar-track {
  background: #f1f1f1; 
} 
/* Handle */
.share-desc::-webkit-scrollbar-thumb {
  background: #888; 
}
/* Handle on hover */
.share-desc::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

@media (min-width: 768px){
	.homepage__latest-videos .column, .homepage__success-stories .column {
		width: 33.333%;
	}
}
</style>

<?php get_footer(); ?>