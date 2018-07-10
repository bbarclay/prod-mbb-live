<div class="upt-consultant">

 	<?php $consultant = get_user_meta(get_current_user_id(), 'consultant', true ) ?>

	<?php if( have_rows('consultants') ) : 

			while( have_rows('consultants') ) : the_row();   
	
					if( $consultant == get_sub_field('name') ) : ?>


						<div class="info">
							<div class="info-left">
								 
								 <img src="<?php echo get_sub_field('photo') ?>" width="100%" alt="Business Blueprint Consultant" />

								 <?php 

								  	echo '<div class="name">' . get_sub_field('name') . '</div>';

								 	if( have_rows('buttons') ) :
								 		$count = 0;
								 		echo '<ul class="list">';
								 		while( have_rows('buttons') ) : the_row(); $count++; ?>

								 			<li><a href="<?php echo ($count == 1) ? 'mailto:' : '' ?><?php echo get_sub_field('link') ?>" class="btn" target="_blank"><?php echo get_sub_field('text') ?></a></li>

								 <?php  endwhile; 
								 		echo '</ul>';
								 	endif;
								 ?>	

							 </div>

							 <?php if( get_sub_field('bio') ) { ?>
								 <div class="bio info-right">
								 	<?php echo get_sub_field('bio') ?>
								 </div>
							 <?php } ?>	 

						</div>


	<?php 	
					endif;
			endwhile; 

	      endif; ?>	
	
</div>