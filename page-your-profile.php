<?php 

get_header(); 

?> 


<main id="content" class="content">

	<section class="module module__membership">
		<div class="container">
			<div class="notes" id="bb-note"><span class="fa fa-exclamation-circle"></span><span class="text"> IMPORTANT: All Members (Fast Track & Elite) can view your name and state below, you can choose what other information to share or hide by clicking the edit button.</span></div> 
			<?php echo do_shortcode('[MBB_contactInfo]') ?>	
		</div>			
	</section>

	<section class="content-section">
		<?php if( have_rows('items') ) : ?>
			<div class="user-navigation">
				<div class="container">
					<div class="list">
						<?php while( have_rows('items') ) :  the_row(); ?>

							<div class="item">
								<a href="<?php echo get_sub_field('link') ?>">
								 <div class="item__link">
								 	<h3><?php echo get_sub_field('title') ?></h3>
								 	<?php 
								 		$image = get_sub_field('icon'); 

										echo wp_get_attachment_image($image['id'], 'full');
								 	
								 	?>		
								 </div>
								</a> 
							</div>
						<?php endwhile; ?>
					</div>
				</div>    
			</div>
		<?php endif; ?>
		<div class="container">  
			<?php 
				global $post;
    			$post_slug = $post->post_name;

				if( is_page('conference-dates') ) {
				
						get_template_part('template-parts/profile/partial', 'conference');
				}
				else if( is_page('i-need-help-with') ) {

				  		get_template_part('template-parts/profile/partial', 'help-with');

				}
				else if( is_page('a-team') ) {

				  		get_template_part('template-parts/profile/partial', 'ateam');

				}
				else if( is_page('useful-contacts') ) {

				  		get_template_part('template-parts/profile/partial', 'useful-contacts');

				} else if( is_page('upcoming-webinars') )  {

				  		get_template_part('template-parts/profile/partial', $post_slug);

				} else if( is_page('consultant') || is_page('consultant-page-2') ) {

				  		get_template_part('template-parts/profile/partial', 'consultant');

				} else { 

				     if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php else: ?>
						<p>Sorry, nothing found that matched your criteria.</p>
					<?php endif; ?>

			<?php }  ?>
			
		</div>
	</section>

</main>

<?php get_footer(); ?>