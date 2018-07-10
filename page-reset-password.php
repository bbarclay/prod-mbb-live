<?php 
/**
*
*/
get_header(); ?>

	<main id="content" class="content" itemscope itemtype="WebPageElement" itemprop="mainContentOfPage" tabindex="-1">

		<?php get_template_part( 'template-parts/content/header' ); ?>

		<div class="container">	

			<div class="reset-password-form">

				<h1>Change</h1>
				<div class="inner">
					<?php $key = $_GET['key']; ?>

					    <form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
					        <p class="form-row">
					            <label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?>
					            <input type="text" name="user_login" id="user_login">
					        </p>
					 
					        <p class="lostpassword-submit">
					            <input type="submit" name="submit" class="lostpassword-button"
					                   value="<?php _e( 'Reset Password', 'personalize-login' ); ?>"/>
					        </p>
					    </form>

				 </div>
			</div>

		</div>
	</main>
<?php 

get_footer();