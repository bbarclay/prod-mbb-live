<?php

get_header(); ?>

	<div class="site__middle  site__middle--modules">
		<main id="content" class="content  content--modules" itemscope itemtype="WebPageElement" itemprop="mainContentOfPage" tabindex="-1">
		
			<section class="timely-tech-section">
			    <div class="container">
					<div class="top-info">
						<div class="row">
							<div class="col-sm-6 col-xs-8">
								<h1><?php echo get_the_title(); ?></h1>
							</div>
							<div class="col-sm-6 col-xs-4">
								<button id="sidebarButton" class="float-right"><span class="fa fa-bars"></span></button>
							</div>
						</div>
					</div>
			    	<div class="grid video-wrap-content">
					 	 <div class="col">
					 	    
					 	 	<?php 	$args = array(
		                        		'post_type' => 'mybbp_timelytech',
		                        		'post_status' => 'publish',
		                        		'order' => 'DESC',
		                        		'orderby' => 'date',	
		                        		'posts_per_page' => 1
		                        	);

	                        	$query = New WP_Query($args);  $count = 0;


	                         	while( $query->have_posts() ) : $query->the_post(); $count++;

									$video_link 	= get_field('video', $query->ID, false );
									$first_position = strpos( $video_link, "medias/");
							        $video_id 		= substr($video_link, ( $first_position + 7 ), 10);

							        if( $count == 1) :      
	                        ?>

					 	     <div class="video-holder">

					 	     	<div id="wistiaEmbed">
					 	     	    <?php echo get_sub_field('video', $query->ID ); ?>
										<div class="wistia_embed wistia_async_<?php echo $video_id; ?> autoPlay=true" style="width:100%;height:100%;">&nbsp;</div>
										<script src="//fast.wistia.com/assets/external/E-v1.js"></script>

					 	     	</div>
					 	     </div>

					 	     <h3>In this session you'll learn...</h3>
							
							<?php if( have_rows('list', $query->ID ) ) : ?>
						 	    <ul class="timeline-list">
						 	    	<?php while( have_rows('list') ) : the_row(); ?>
					                   	  <li>
					                   	  	 <div class="timeline-single">
					                   	  	    <div class="play-btn">
					                   	  	       <?php $time = ( get_sub_field('minutes')  * 60 ) + get_sub_field('seconds'); ?>
					                   	  	 		<button  class="btn-play" data-time="<?php echo $time; ?>"><span class="fa fa-play"></span></button>
					                   	  	 	</div>
					                   	  	 	<?php if( get_sub_field('title') ) : ?>
					                   	  	 		<span class="title"><?php echo get_sub_field('title'); ?></span>
					                   	  	 	<?php endif; ?>
					                   	  	 	<?php if( get_sub_field('minutes') && get_sub_field('seconds') ) : ?>
					                   	  	 		<span class="at-time"><?php echo get_sub_field('minutes'); ?>:<?php echo get_sub_field('seconds'); ?></span>
					                   	  	 	<?php endif; ?>

					                   	  	 	<?php if( get_sub_field('description') ) : ?>
					                   	  	 		<span class="detail">View Details</span>
					                   	  	 	<?php endif; ?>		
												<?php if( get_sub_field('link') ) : ?>
				                   	  	 			<span class="website">Website: <a href="<?php echo get_sub_field('link'); ?>	" target="_blank">Open Link</a></span>
												<?php endif; ?>
												<?php if( get_sub_field('description') ) : ?>
					                   	  	 		<div class="hide detail-content"><?php echo get_sub_field('description') ?></div> 
					                   	  	 	<?php endif; ?>		
					                   	  	 		
					                   	  	 </div>
					                   	  </li>
			                   	   <?php endwhile; ?>
		                   		</ul> 
							<?php endif; ?>

	                   		<?php endif; 
	                   			endwhile;

	                   			wp_reset_postdata();
	                   		    ?>
	                     </div>
	                     <div class="col">
							<?php  
								$args = array(
		                        		'post_type' => 'mybbp_timelytech',
		                        		'post_status' => 'publish',
		                        		'order' => 'DESC',
		                        		'orderby' => 'date',	
		                        		'posts_per_page' => -1
		                        	);

	                        	$query = New WP_Query($args);  $count = 0;
	                        	if( $query->have_posts() ) : ?>
									<div class="video-item">
									 
			                                <?php while( $query->have_posts() ) : $query->the_post(); 

												$video_link 	= get_field('video', $query->ID, false );
												$first_position = strpos( $video_link, "medias/");
										        $video_id 		= substr($video_link, ( $first_position + 7 ), 10);
			                                ?>
			                                	   <div class="item-section" id="<?php echo GET_THE_ID(); ?>">
			                                	       <div class="left-item">
			                                	       		<div class="video-thumbnail" id="<?php echo $video_id ?>">
			                                	       			<div class="fa-spinner-wrap"><span class="fa fa-spin  fa-spinner"></span></div>
			                                	       		</div>
				                                	   		
			                                	       </div>
			                                	       <div class="right-item">
				                                	       	<?php if( have_rows('list') ) : ?>
					                                	   	   <div class="list-item">	
					                                	   	      <ul>	
																   <?php while( have_rows('list') ) :  the_row(); ?>
																		<li><span><?php echo get_sub_field('title') ?></span></li>
																   <?php endwhile; ?>
																   </ul>
		                                                       </div>
														   <?php endif; ?>	
														   <span class="date"><?php echo get_the_date() ?></span>
			                                	       </div>
												   </div>
											<?php endwhile; ?>
										
									</div>
                            <?php    	
	                        	endif;	

	                        	wp_reset_postdata();
	                        ?>
	                     </div>
					</div>
			    </div> 
			</section>

		</main>
	</div>
	<script>
			var prevTime = 0;

			$(document).on('click', '.btn-play', function(){

				var videoWrap = $('#wistiaEmbed');		

				var video_player = videoWrap.find('.wistia_embed');
				var video_id = video_player.attr('id');
		
				var video_filter_id = video_id.replace('wistia_', '');
				var wistiaInnerID = $("#wistia_" + video_filter_id).find('video').attr('id');


				if(wistiaInnerID == undefined) {
					var wistiaInnerID = $("#wistiaEmbed").find('video').attr('id');
					
				} 
			
				var wistiaEmbed = document.getElementById(wistiaInnerID);
				
				var time = $(this).attr('data-time');

			
				if( prevTime == 0 ) {
						
					wistiaEmbed.play(); 
					wistiaEmbed.currentTime = time;

					wistiaTrigger(time, video_filter_id);
					prevTime = time;
					
				} else if( time !=  prevTime ) {

					wistiaEmbed.currentTime = time;

					setTimeout(function(){ wistiaEmbed.play(); }, 1000)

				 	wistiaTrigger(time, video_filter_id);
					prevTime = time;
				

				} else {

		
					wistiaEmbed.currentTime = time;

					setTimeout(function(){ wistiaEmbed.play(); }, 1000)
					

					
					wistiaTrigger(time, video_filter_id);
					prevTime = time;				

				}
			})



			function wistiaTrigger(time, video_id) {
		
				window._wq = window._wq || [];

				console.log('Wistia Trigger ' +video_id);

				// target our video by the first 3 characters of the hashed ID
				_wq.push({ id: video_id, onReady: function(video) {

				
				  // on play, seek the video to 10 seconds, then unbind so it
				  // only happens once.
				  video.bind('play', function(t) {
				  
				     video.time(time);
				     console.log("The video was just played! " + t);
				     return video.unbind;

				  });

				  video.bind('pause', function(t) {
				
				     video.time(time);
				     console.log("The video was just paused! " + time);
				     return video.unbind;

				  });

				}});

		}

		$(window).load(function(){

				var list = $('.video-item').find('.item-section');	
			

				for( var a = 1; a <= list.length; a++ ) {
				
					var id = $('.video-item .item-section:nth-child('+ a +') .video-thumbnail').attr('id');

					console.log(id);
					$.ajax({
						type: 'POST',
				 		url: search_members.ajax_url,
				 		data: {
				 			action: 'get_wistia_image',
				 			security: search_members.security,
				 			id: id,
				 		},
				 		success: function(data) {
						  
				 			var img = '<img src="' + data['data']['img_link'] + '" width="100%" alt="' + data['data']['title'] +'" /><span class="play"><i class="fa fa-play"></i></span>';
				 		
				 			$('.video-item').find('#' + data['data']['id']).html(img);
				 		},
				 		error: function() {

				 		}
					});

				}

			});


			$(document).on('click', '.video-thumbnail', function(){

					var id 		    = $(this).attr('id');
					var videoWrap 	= $('#wistiaEmbed');
					var video_list  = $('.timeline-list');
					var postID 		= $(this).closest('.item-section').attr('id');

					videoWrap.html('');
					videoWrap.removeAttr('class');
					videoWrap.html('<div id="wistia_'+ id+'" class="wistia_embed" style="width:100%;height:100%;">&nbsp;</div>');

					//Clear Video list
					video_list.html('<div class="loader-wrapper"><span class="fa fa-spin fa-lg fa-spinner"></span></div>');

					// Embed Wistia to video player
					var wistiaEmbed = Wistia.embed(id);
				
					// Autoplay it right after embedded
					wistiaEmbed.play();
					
					// Get data from the server
					$.ajax({
						type: 'POST',
				 		url: search_members.ajax_url,
				 		data: {
				 			action: 'get_post_list',
				 			security: search_members.security,
				 			id: postID,
				 		},
				 		success: function(data) {
				 			
						 	if(data['data'].length > 0) {
						 		var item = "";
						 		for(var x = 1; x < data['data'].length; x++) {

						 			var startPoint = ( parseInt( data['data'][x]['minutes'] ) * 60 ) + parseInt( data['data'][x]['seconds'] );

						 			item += '<li><div class="timeline-single"><div class="play-btn"><button class="btn-play" data-time="'+ startPoint +'"><span class="fa fa-play"></span></button></div><span class="title">'+ data['data'][x]['title'] +'</span><span class="at-time">'+ data['data'][x]['minutes'] +':'+ data['data'][x]['seconds'] + '</span>';
						 			if( data['data'][x]['description'] ) {
						 				item += '<span class="detail">View Details</span>';
						 			}
						 			if( data['data'][x]['link'] ) {
						 				item += '<span class="website">Website: <a href="'+ data['data'][x]['link'] +'" target="_blank">Open Link</a></span>';
						 			}
						 			if( data['data'][x]['description'] ) {
						 				item += '<div class="hide detail-content">' + data['data'][x]['description'] + '</div>';
						 			}
						 				item += '</div></li>';

						 		}
						 	}
				 			
				 		
				 			$('.timeline-list').html(item);
				 		},
				 		error: function(err) {
				 			console.log(err);
				 		}
					});

			});

			$('#sidebarButton').on('click', function(){

				$('.video-wrap-content').toggleClass('expand');

				if( $(this).find('span').hasClass('fa-chevron-right') ) {

					$(this).find('span').removeClass('fa-chevron-right').addClass('fa-chevron-left');

				} else {

					$(this).find('span').removeClass('fa-chevron-left').addClass('fa-chevron-right');
				}

			});


			$(document).on('click', '.timeline-single .detail', function(){

				if( $(this).text() == 'View Details' ) {

					$(this).text('Hide Details');

				} else {

					$(this).text('View Details');
				}

				$(this).closest('.timeline-single').find('.detail-content').toggleClass('hide');
			});

	</script>
	<style>
		.loader-wrapper {
		    padding: 50px 0;
		    text-align: center;
		    font-size: 29px;
		    min-height: 300px;
		}
		.top-info {
		    margin-left: -15px;
		    margin-right: -15px;
		}
		.top-info button {
		    float: right;
		    background: transparent;
		    padding: 5px 10px;
		    border: 2px solid #7ac143;
		    height: auto;
		    margin-top: 10px;
		}
		.top-info button span {
			color: #7ac143;
		}
		.timely-tech-section {
			padding: 30px 0;
		}
		.timely-tech-section .container {
		    padding-left: 15px;
		    padding-right: 15px;
		}
		#wistiaEmbed  {
			position: relative;
			padding-bottom: 56.25%; /* 16:9 */
			padding-top: 25px;
			height: 0;
		}
		#wistiaEmbed > div {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
		.timely-tech-section .grid {
			display: flex;
			flex-wrap: wrap;
			position: relative;
		}
		.timely-tech-section .grid .col:nth-child(1) {
			width: calc(100% - 400px);
			transition: all 0.3s ease-in-out;
		}
		.timely-tech-section .grid .col:nth-child(2) {
			width: 400px;
			padding-left: 15px;
			transition: all 0.3s linear;
		}

		.timely-tech-section .expand .col:nth-child(1) {
			width: 100%;
		}
		.timely-tech-section .expand .col:nth-child(2) {
			transform: translateX(400px);
			padding-left: 0;
			display: none;
		}

		.timely-tech-section .video-holder {
			text-align: center;
		}
		.timely-tech-section .list-item ul {
		    list-style: none;
		    padding: 0;
		    margin: 0;
		}
		.timely-tech-section .list-item ul:after {
		    content: '';
		    clear: both;
		    display: block;
		}
		.timely-tech-section .list-item ul li {
		    margin: 0;
		    padding-right: 6px;
		    display: inline-block;
		    float: left;
		    line-height: 1;
		    position: relative;
		}
		.timely-tech-section .list-item ul li:after {
			content: '';
		    position: absolute;
		    right: 2px;
		    top: 50%;
		    width: 3px;
		    height: 3px;
		    border-radius: 50%;
		    background: #d4d3d3;
		}
		.video-thumbnail .fa-spinner-wrap {
		    position: absolute;
		    top: 46%;
		    left: 50%;
		    transform: translate(-50%,-50%);
		    width: 20px;
		    height: 20px;
		    transform-origin: center center;
		}
		.video-item .item-section .right-item {
		    width: calc(100% - 150px);
		    padding-left: 7px;
		}
		.video-item .item-section .left-item {
		    width: 150px;
		}
		.video-item .list-item span {
			display: inline-block;
			font-size: 16px;
			margin-right: 3px;
			color: #222;
			border-radius: 3px;
			margin-bottom: 0px;
			font-family: 'Geogrotesque-Medium', sans-serif;
			line-height: 1.2;
		}
		.top-info button {
		    float: right;
		    background: transparent;
		    padding: 1px 5px;
		    border: 2px solid #7ac143;
		    height: auto;
		    margin-top: 10px;
		}
		#wistiaEmbed {
		    overflow: hidden;
		}
		ul.timeline-list {
		    padding: 0;
		    list-style: none;
		    margin: 0;
		}
		.timeline-single {
		    display: flex;
		    flex-wrap: wrap;
		    align-items: center;
		    padding: 3px 0;
    		border-bottom: 1px solid #f3f2f2;
		}
		.timeline-single .play-btn {
		    width: 35px;
		}

		.timeline-single button {
		    background: transparent;
		    font-size: 11px;
		    height: 20px;
		    width: 20px;
		    border-radius: 50%;
		    border: 2px solid #7ac143;
		    padding: 0;
		    text-align: center;
		    color: #7ac143;
		}
		.timeline-single button:hover {
			color: #f15d22;
			border-color: #f15d22;
			animation: playIndicator 2s linear infinite;
		}
		.timeline-single button span {
			margin-right: -2px;
		}
		.timeline-single .detail-content {
		    width: 100%;
		}
		.timeline-single p {
		    margin-left: 36px;
		    margin-bottom: 3px;
		    padding-right: 40px;
		    margin-top: 5px;
		    font-size: 16px;
		    line-height: 1.3;
		    color: #101010;
		}
		.timeline-single .detail {
		    font-size: 13px;
		    margin-left: 36px;
		    color: #f15d22;
		    margin-right: 5px;
		    border-right: 1px solid #f3f0f0;
		    padding-right: 6px;
		}
		.timeline-single .detail:hover,
		.timeline-single .detail:focus {
			cursor: pointer;
		}
		.timeline-single p span,
		.timeline-single .website {
		    display: block;
		    color: #002749;
		    font-size: 13px;
		}
		.timeline-single p a,
		.timeline-single .website a  {
		    color: #00bce4;
		}
		@keyframes playIndicator {
			0% {
				box-shadow: 0 0px 2px 2px rgba(241, 93, 34, 0.2);
			}
			50% {
				box-shadow: 0 0px 2px 4px rgba(241, 93, 34, 0.2);
			}
			100% {
				box-shadow: 0 0px 2px 2px rgba(241, 93, 34, 0.2);
			}
		}
		.timeline-single .at-time {
		    background: transparent;
		    font-size: 16px;
		    color: #141514;
		    width: 45px;
		    text-align: right;
		}
		.timeline-single .title {
            font-weight: 600;
            text-align: left;
            width: calc(100% - 80px);
		}
		.video-item .item-section {
			display: flex;
			flex-wrap: wrap;
			padding: 10px 0;
			border-top: 1px solid #f1f0f0;
		}
		.video-item .item-section .date {
			font-size: 14px;
			color: #868483;
		}
		.video-item .video-thumbnail {
		    min-height: 90px;
		    background: #f5f5f5;
		    position: relative;
		}
		.video-item .video-thumbnail:hover,
		.video-item .video-thumbnail:focus {
			cursor: pointer;
		}
		.video-item .video-thumbnail:hover .play,
		.video-item .video-thumbnail:focus .play {
            background: rgba(241, 93, 34, 0.8);
		}
		.video-item .video-thumbnail .play {
		    content: '';
		    background: rgba(0, 188, 228, 0.8);
		    width: 50px;
		    height: 35px;
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%,-50%);
		    display: flex;
		    align-items: center;
		    justify-content: center;
		    box-shadow: 0 2px 10px 0 #4c4a4a;
		    color: #fff;
		    transition: background 0.3s ease;
		}
		.video-item .video-thumbnail img {
			display: block;
		}

		@media ( max-width: 1049px ) {
			.timely-tech-section {
			    padding: 30px 20px;
			}
		}
		@media ( max-width: 991px ) {
			.timely-tech-section .grid .col:nth-child(1) {
			    width: 100%;
			}
			.timely-tech-section .grid .col:nth-child(2) {
			    position: absolute;
			    top: 0;
			    right: 0;
			    background: #fff;
			    height: 100%;
				box-shadow: 0 11px 35px 0px rgba(0, 0, 0, 0.1);
			}

		}
		@media ( max-width: 679px ) {
			.top-info button {
			    margin-top: 0;
			}
		}
	</style>

<?php get_footer(); ?>
