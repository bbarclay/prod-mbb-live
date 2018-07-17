<?php 

/**
* Template Name: Homepage
*
**/


get_header(); ?>
<!-- AddEvent script -->
<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
<?php 

  if( shortcode_exists('rpp_popup') )  {

  	echo do_shortcode('[rpp_popup]'); 
  }

 ?>
<main id="content" class="content" itemscope itemtype="WebPageElement" itemprop="mainContentOfPage" tabindex="-1">
	<header class="banner" <?php cascade_the_banner_image(); ?>>
		<div class="container">
			<h1 class="banner__title">
				<?php the_title(); ?>
			</h1>

			<div class="banner__subtitle"></div>
		</div>
	</header>
    <div class="member-homepage">  
    	<div class="video-section">
        	<div class="container">
                <div class="grid">
	                	
	                	<div class="grid__column column-70">
	                		<?php if ( get_field('video_heading') ) : ?>
	                		 	<h2 class="heading"><?php echo get_field('video_heading') ?></h2>
	                		<?php endif; ?> 
	                		<?php if ( get_field('video_of_the_month') ) : ?>	
		                		 <div class="video">
		                		     <?php echo get_field('video_of_the_month') ?>
		                		 </div>
	                		 <?php endif; ?>
	                	</div>
	                	<div class="grid__column  column-30">

		                	<?php if( get_field('blog_heading') ) : ?>
		                		 <h2 class="heading"><?php echo get_field('video_list_heading') ?></h2>
		                	<?php endif; ?>	 
	                		<div class="video-scroll">
	                			<ul class="lists">
	                			<?php 
	                				$args = array(

	                						  'post_type' => 'mybbp_video',
	                						  'post_stataus' => 'publish',
	                						  'posts_per_page' => 5,
	                						  'order' => 'DESC',
	                						  'orderby' => 'date'
	                					);

	                				$query = New WP_Query($args);

	                				if( $query->have_posts() ) {
	                					while( $query->have_posts() ) : $query->the_post();  ?>


	                						<li class="item">
	 
			                					<div class="details">
			                					  <h3 class="name"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
			                					  
			                					  	<?php 
			                					  		$presenter = get_the_term_list( get_the_ID(), 'mybbp_video_presenter', '<div class="presenter">', ', ', '</div>' );

			                					  		if( $presenter )  {
			                					  			echo $presenter;
			                					  		} else {
			                					  			echo '<div class="presenter">Business Blueprint</div>';
			                					  		}
			                					   ?>

			                					</div>
			                				</li>

	                				<?php	
	                					endwhile;
	                				} 

	                				wp_reset_postdata();

	                				?>
	                			</ul>
	                			
	                		</div>
	                	</div>

	                </div>
	            </div>    
	        </div>    
            <div class="featured-posts">
                <div class="container">
                	<?php if( get_field('blog_heading') ) : ?>
                	   <h2 class="heading"><?php echo get_field('blog_heading'); ?></h2>
                	<?php endif; 

                		if(have_rows('news')) :
                			echo '<div class="grid">';
                			while( have_rows('news') ) : the_row(); ?>

		                	 	 <div class="grid__column column-50">
		                	 	   <a href="<?php echo get_sub_field('link') ?>">
			                	 	    <div class="blog">
			                	 	          <?php $image = get_sub_field('image');
			                	 	          ?>
			                	 	 	 	    <div class="thumbnail" style="background: url(<?php echo $image['url']; ?>) 0 0 / cover no-repeat">
			                	 	 	 	  	     
			                	 	 	 	    </div>
			                	 	 	
				                	 	 	 
				                	 	 	  <div class="info">
				                	 	 	   <h3><?php echo get_sub_field('title') ?> </h3>
				                	 	 	   <span><?php echo get_sub_field('presenter') ?></span> 
				                	 	 	  </div>
			                	 	 	 </div>
		                	 	 	</a>
		                	 	 </div>		                		

                	<?php 
                			endwhile;
                			echo '</div>';

                		endif;	
                	?>


                </div>	 
            </div><!-- ./featured-post -->

    </div> 
    <!-- ./ Member-Homepage -->       

		</div>
	</main>

<?php get_footer(); ?>