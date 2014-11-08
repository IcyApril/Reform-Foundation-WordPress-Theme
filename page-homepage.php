<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<?php
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
							?>
							<div class="row">
								<div class="col-md-7">
									<!--<h1><?php bloginfo('title'); ?> <small><?php bloginfo('description'); ?></small></h1>-->
									<h1><?php bloginfo('description'); ?></h1>
									<br />
									<p class="lead"><?php echo get_post_meta($post->ID, 'custom_tagline' , true);?></p>
								</div>
								<div class="col-md-3 col-md-offset-2">
									<img src="<?php echo $featured_src[0]; ?>" class="pull-right" />
								</div>
							</div>

						</header>
						<hr />
						<section class="row post_content">

							<div class="col-sm-8">
								<div class="well">
									<?php the_content(); ?>
								</div>
								<hr />
								<?php
								$args = array(
									'numberposts' => 10,
									'offset' => 0,
									'category' => 0,
									'orderby' => 'post_date',
									'order' => 'DESC',
									'post_type' => 'post',
									'post_status' => 'publish',
									'suppress_filters' => true
								);

								$recent_posts = wp_get_recent_posts( $args, ARRAY_A );

								foreach ($recent_posts as $recent) {
									?>
									<article id="post-<?php echo $recent['ID']; ?>" <?php echo get_post_class('clearfix', $recent['ID']); ?> role="article">

										<header>

											<div class="page-header"><h1 class="h2"><a href="<?php echo get_post_permalink($recent['ID']) ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $recent['post_title']; ?></a></h1></div>

											<p class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo get_the_time('Y-m-j', $recent['ID']); ?>" pubdate><?php echo get_the_date('F jS, Y', $recent['ID'],'', FALSE); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', ', '', $recent['ID']); ?>.</p>

										</header> <!-- end article header -->

										<section class="post_content clearfix">
											<?php
											echo apply_filters('the_content', $recent['post_content']);
												?>
										</section> <!-- end article section -->

										<footer>
											<p class="tags"><?php echo get_the_term_list($recent['ID'], 'post_tag', '<span class="tags-title">' . __("Tags","wpbootstrap") . ':</span> ', ' ', '' ); ?></p>

										</footer> <!-- end article footer -->

									</article> <!-- end article -->
									<hr />
								<?php
									}
								?>
								<div class="col-md-12">
									<div class="pull-right">
										<a href="posts" class="btn btn-primary">View all posts</a>
									</div>
								</div>
							</div>

							<?php get_sidebar('sidebar2'); // sidebar 2 ?>

						</section> <!-- end article header -->

						<footer>

							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>

						</footer> <!-- end article footer -->

					</article> <!-- end article -->

					<?php
						// No comments on homepage
						//comments_template();
					?>

					<?php endwhile; ?>

					<?php else : ?>

					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>

					<?php endif; ?>
				</div> <!-- end #main -->

				<?php //get_sidebar(); // sidebar 1 ?>

			</div> <!-- end #content -->

<?php get_footer(); ?>