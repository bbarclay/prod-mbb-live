<div class="cd-section cd-date-section" id="date">
			<div class="container">
				<?php if( get_sub_field('heading') ) : ?>
					<h3 class="cd-title"><?php echo get_sub_field('heading') ?></h3>
				<?php endif;  ?>
				<?php if( get_sub_field('description') ) : ?>	
					<div class="cd-description"><?php echo get_sub_field('description') ?></div>
				<?php endif;  ?>

					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="cd-calendar">
							<?php 
                            	$no_of_dates = count( get_sub_field('dates') );

                            	if( have_rows('dates') ) :
                            		$count 		 = 0;
                            	    

                            		while( have_rows('dates')) : the_row(); 
                            			$count++;
                            				if($count == 1) {
                            					$first_day = get_sub_field('item');
                            				}

                            				if($count ==  $no_of_dates ) {
                            					$last_day = get_sub_field('item');
                            				}
                            				
                            ?>	
										<div class="date">
											<span class="month"><?php echo date( 'M', strtotime( get_sub_field('item') ) ); ?></span>
											<span class="day"><?php echo date( 'jS', strtotime(  get_sub_field('item') ) ); ?></span>
										</div>

                            <?php	
                            		endwhile;
                            	endif;	
                            ?>

							</div>
							<div class="cd-button">
								<div title="" class="btn-addevent addeventatc" id="addeventatc1" aria-haspopup="true" aria-expanded="false" tabindex="0" style="visibility: visible;">
								    Add to Calendar
								    <span class="start atc_node"><?php echo $first_day ?> 9:00 am</span>
							   		<span class="end atc_node"><?php echo $last_day ?> 6:00 pm</span>
							        <span class="timezone atc_node">Pacific/Sydney</span>
							        <span class="title atc_node"><?php echo get_sub_field('heading'); ?></span>
								    <span class="description atc_node"></span>
								    <span class="location atc_node"></span>
									<span class="addeventatc_icon atc_node"></span>
								</div>
							</div>
						</div>
					</div>	
			</div>
</div>