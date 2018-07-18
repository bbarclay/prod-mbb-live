<div class="upt-consultant">


	<?php 
			$consultant = do_shortcode('[mbb_your_consultant]'); 

			if( have_rows('consultants') ) :

			
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
					endwhile; ?>
	<?php   else: ?>
							
			  <p>N/A</p>		

	<?php   endif; ?>	
    
</div>
<div class="upt-consultant-note">
	<div class="row">
    	<div class="col-sm-6">
    	    <h3>EMAIL</h3>
    		<p>If your enquiry is of medium urgency, email is best. You will receive a response within 24-48 hours. If you have admin related questions about your membership, it's best to try and find the information on this site, or email <a href="mailto:support@businessblueprint.com">support@businessblueprint.com</a> and they will be able to help you.</p>
    	</div>
    	<div class="col-sm-6">
    	    <h3>VOXER</h3>
    		<p>For short enquiries with medium-high importance, for a quick response, the best method will be Voxer. You will receive a reply usually on the same day, but always within 24 hours. The above link will open the desktop version of Voxer, or you can add the Consultant by searching within your Voxer phone app.</p>
    	</div>
    	<div class="col-sm-6">
    	    <h3>LINKED IN</h3>
    		<p>If you'd like to view your consultant's work history and experience, then click this link to be taken to their Linked In page. This is not an ideal way to send a message to your consultant as they do not monitor this inbox regularly.</p>
    	</div>
    	<div class="col-sm-6">
    	    <h3>BOOK A CALL</h3>
    		<p>For a longer, more detailed conversation, you are able to book a time with your consultant via this booking calendar. You can book a 20-minute conversation with your consultant up to 3 weeks in advance. If you need to book outside of this, please email <a href="mailto:support@businessblueprint.com">support@businessblueprint.com</a> and we will try our best to accommodate.</p>
    	</div>
    </div>
</div>