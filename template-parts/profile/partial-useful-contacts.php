<section class="useful-contacts-secion ">

		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'entry--full' ); ?> itemscope itemtype="http://schema.org/CreativeWork">

				<div class="container">
					<div class="entry__content  clearfix" itemprop="text">
						<?php the_content(); ?>

						<?php
						$children = new WP_Query(array(
							'posts_per_page' => -1,
							'post_type'      => 'useful_contact_types',
							'orderby'        => 'title',
							'order'          => 'ASC'
						));

						if ( $children->have_posts() ) : ?>
							<div class="grid  grid--boxes">
								<?php while ( $children->have_posts() ) : $children->the_post(); ?>
									<div class="grid__column">
										<div class="box">
											<a href="<?php the_permalink(); ?>" class="box__link">
												<div class="box__label">
													<?php the_title(); ?>
												</div>
											</a>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</article>

		<?php endwhile; ?>

</section>		