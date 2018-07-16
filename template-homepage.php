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

            <div class="module conference">
            	<div class="container"> 
                  <?php 

            	  $customer_type =  do_shortcode('[mbb_get_customer_type]'); 

            	  if( $customer_type == 'Fasttrack Gold') {
            	  	$show_dates = 'conference_dates';
            	  	$total_days = 2;

            	  }
            	  else if ( $customer_type == 'Fasttrack Platinum') {
            	  	$show_dates = 'conference_dates';
            	  	$total_days = 4;

            	  }
            	  else if ( $customer_type == 'Elite Gold' ) {
            	  	$show_dates = 'elite_conference_dates';
            	  	$total_days = 2;
            	  }
            	  else if ( $customer_type == 'Elite Platinum'  ) {
            	  	$show_dates = 'elite_conference_dates';
            	  	$total_days = 4;
            	  } else {
            	  	$show_dates =  false;
            	  }
              
            	  	if(!empty($show_dates)) {
            	   		echo '<h2 class="heading">Conference Dates</h2>';
            	  	}

                	  	if( have_rows($show_dates)) :
                	  		echo '<div class="grid">';

                	  		 while( have_rows($show_dates) ) : the_row(); $month = get_sub_field('month'); 

                	  		  echo $is_annual = ( get_sub_field('annual_conference') ) ? get_sub_field('annual_conference')  : false;
                	  		  $tbd = get_sub_field('tbd');  ?>

                                <div class="grid__column column-25">
                               		<?php ( $show_dates != 'elite_conference_dates') ? '<h3 class="topic">'. et_sub_field('topic') . '</h3>': ''; ?>
		                	  			<?php 	if( have_rows('day') ) : ?>

		                	  			 	<?php	
		                	  			 		echo '<div class="calendar">';
		                	  			 		$countDate = 0;

		                	  			 		while( have_rows('day') ) : the_row(); $countDate++;  ?>
		                	  			 
				                	  			 	<div class="date <?php echo ( ( $total_days  == 2 && $countDate == 1 ) &&  $is_annual == false || ( $total_days  == 2 && $countDate == 4 && $is_annual == false) ) ? 'hide' : '';?>">

				                	  			 	    <span class="month <?php echo ($tbd  && $is_annual == false) ?  'no-date' : '';?>"><?php echo $month; ?></span>
				                	  			 	    <span class="day">
				                	  			 	        <?php if( ! $tbd || $is_annual == true ) : ?>
						                	  			 		<?php echo get_sub_field('item') ?>
						                	  			 	<?php else : ?>
						                	  			 		<?php echo __('TBD', 'cascade') ?>
						                	  			 	<?php endif; ?>	
				                	  			 	    </span>
	                	  			 			    </div>
	                	  			 
	                	  			 		<?php 
	                	  			 	   		endwhile;
	                	  			 	   		echo '<div class="year">' . get_sub_field('year') . '</div>';
	                	  			 	        echo '</div>';

	                	  			 	        //Calendar
	                	  			 	        if( ! get_sub_field('tbd') ) :
	                	  			 	        	
	                	  			 	        	if( have_rows('add_to_calendar') ) {

	                	  			 	        	  echo '<div class="calendar-button">';
	                	  			 	        	  	
	                	  			 	        	  	while( have_rows('add_to_calendar') ) : the_row();   ?>
		                	  			 	        		
														<div title="Add to Calendar" class="addeventatc">
														    Add to Calendar
														    <span class="start"><?php 
														    		if($total_days == 2  && $is_annual == false) {
														    			$gold_start_date = date('m/d/Y h:i a', ( strtotime('+1 day', strtotime( get_sub_field('start_date') ) ) )  );
														    			  echo $gold_start_date;	
														    		}
														    		else {
														    			echo get_sub_field('start_date'); 
														    		} ?>	
														    </span>
														    <span class="end"><?php 
															    if($total_days == 2  && $is_annual == false) {
															   		$gold_end_date = date('m/d/Y h:i a', ( strtotime('-1 day', strtotime( get_sub_field('end_date') ) ) )  );
													    			echo $gold_end_date;	
													    		}
													    		else {
													    			echo get_sub_field('end_date'); 
													    		} ?>
													    	</span>
														    <span class="timezone"><?php echo get_sub_field('timezone') ?></span>
														    <span class="title"><?php the_sub_field('summary_of_the_event') ?></span>
														    <span class="description"><?php echo get_sub_field('description_of_the_event') ?></span>
														    <span class="location"><?php echo get_sub_field('location_of_the_event') ?></span>
														</div>

										<?php		  endwhile;
													  echo '</div>';
										            }
	                	  			 	    	endif;
	                	  			   		endif;   ?>
	                	  			 
                	  		</div>

                	   <?php 
                	   		 endwhile;

                	   		echo '</div>'; 
                		endif;  ?>

            </div>	  
        </div><!-- ./conference -->
    </div> 
    <!-- ./ Member-Homepage -->       

		</div>
	</main>

<?php get_footer(); ?>