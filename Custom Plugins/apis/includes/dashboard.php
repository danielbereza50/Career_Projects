<div class = "dashboard-section-1">
	<div class = "dashboard-section-1-item">
 		<img src="/wp-content/plugins/quimonit/images/logo-2.png" alt="" width="210" height="70"> 
	</div>
	<div class = "dashboard-section-1-item">
		<div class = "profile_complete">
			<button class="button">
				<a href = "/make-an-appointment" style = "color:white;">MAKE AN APPOINTMENT</a>
			</button>
		<?php 
			$first_name = get_user_meta( get_current_user_id(), 'first_name', true ); 
			$last_name = get_user_meta( get_current_user_id(), 'last_name', true ); 
			$avatar = get_avatar( get_current_user_id(), 32 );
			$age = 32;	

			echo '<div class = "profile_wrapper">';
				echo '<div class = "profile_image">';
					echo $avatar;
				echo '</div>';

				echo '<div class = "user_name">';
					echo $first_name . " " . $last_name;
					echo '<br>';
					echo $age . " years";
				echo '</div>';
			echo '</div>';
			?>
		</div>
	</div>
</div>
<!-- end of first section -->
<div class = "dashboard-section-2">
	<div class = "dashboard-section-2-item">
		<nav class="mobile-menu">
			<a href="#" class="hamburger-wrapper">
				<div class="hamburger-menu"></div>
			</a>
			<div class="mobile-menu-overlay">
				<?php echo do_shortcode('[addmenu]'); ?>
			</div>
		</nav>
	</div>
	<div class = "dashboard-section-2-item">
		<h2><span class = "welcome-txt">Hello, Welcome here</span></h2>
	</div>
	<div class = "dashboard-section-2-item">
		<div><span class = "reports">Reports</span> <input type="date" id="birthdaytime" name="birthdaytime"> </div>
	</div>
</div>
<!-- end of second section -->
<div class = "dashboard-section-3">
		<div class = "dashboard-section-3-item">
			<div id = "dashboard">
				<img src="/wp-content/plugins/quimonit/images/dashboard.png" alt="" width="150" height="70">
			</div>
			<div id = "switch-url">
				<img src="/wp-content/plugins/quimonit/images/switch-url.png" alt="" width="150" height="70">
			</div>
			<div id = "add-url">
				<img src="/wp-content/plugins/quimonit/images/add-url.png" alt="" width="150" height="70">
			</div>
			<div id = "settings">
				<img src="/wp-content/plugins/quimonit/images/settings.png" alt="" width="150" height="70">
			</div>
			<a href = "/wp-login.php?action=logout">
				<div id = "logout">
					<img src="/wp-content/plugins/quimonit/images/logout.png" alt="" width="150" height="70">
				</div>
			</a>	
		</div>
		<div class = "dashboard-section-3-item">
			<div id = "dashboard-area">
					<div class = "dashboard-inner-container">
							<div class = "dashboard-item">
								<?php include 'views/uptime.php'; ?>
							</div>
							<div class = "dashboard-item">
								<?php include 'views/pagecrawl.php'; ?>
							</div>
							<div class = "dashboard-item">
								<?php include 'views/mxtoolbox.php'; ?>
							</div>
							<div class = "dashboard-item">
									<?php include 'views/quttera.php'; ?>
							</div>
							<div class = "dashboard-item">
									<?php 
									if (has_woocommerce_subscription('','480','active')) {
										include 'views/blacklist.php'; 
									}else{
										echo 'You need premium subscription to view';
									}
								?>
								</div>
							</div>
						</div><!-- end of container -->
					</div>
				</div>
			<div id = "switch-url-area">
				Coming Soon!
			</div>
			<div id = "add-url-area">
				<?php
				if(isset($_POST['submit'])) {
					 include 'actions/add.php';			 
				}
				?>
				<form method="POST" action="" enctype="multipart/form-data" id = "add-url-form">
					<div class = "form-wrapper">
						<div class = "form-item">
							<input type="url" id="" value="" tabindex="1" size="20" name="title" placeholder = "https://" required>
						</div>	
						<div class = "form-item">
							<input type="submit" name="submit" value="ADD URL" class="submit-btn" />
						</div>
					</div>		
				</form>
				<?php
				$count = 0;
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args = array(
					'author'        =>  $current_user->ID,
					'post_type' => 'urls',
					'posts_per_page' => 6,
					'orderby'=> 'date', 
					'order' => 'ASC',
					'paged' => $paged
				);
				$the_query = new WP_Query( $args ); ?>
				<div class = "outermost-wrapper">
					<div class="outer-url-wrapper">
						<div class="outer-url-item">
							SR. NO
						</div>
						<hr>
						<div class="outer-url-item">
							URL NAME
						</div>
						<div class="outer-url-item">
							ACTIONS
						</div>
						<div class="outer-url-item">
						</div>
					</div>	
					<?php
					if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
										$count++;
										?>
								<div class="url-wrapper">
											<div class="url-item">
													<p><b><?php echo $count; ?></b></p>
											</div>
											<div class="url-item">
													<p><b><?php the_title(); ?></b></p>
											</div>
											<div class="url-item">
													<p><b><i class="fa fa-trash" aria-hidden="true"></i></b></p>
											</div>
											<div class="url-item">
													<p><b><i class="fa fa-eye" aria-hidden="true"></i></b></p>
											</div>
								</div>
							<?php endwhile; ?>
							<?php if ($the_query->max_num_pages > 1) { ?>
								<nav class="prev-next-posts">
									<div class="prev-posts-link">
										<?php echo get_next_posts_link( 'Older Articles', $the_query->max_num_pages ); ?>
									</div>
									<div class="next-posts-link">
										<?php echo get_previous_posts_link( 'Newer Articles' ); // display newer posts link ?>
									</div>
								</nav>
							<?php } ?>
					</div>
				</div>
				<?php
				wp_reset_postdata(); 
				endif; 
				?>
				<div id = "settings-area">
				<?php echo do_shortcode('[gravityform id="3" title="false"]') ?>
			</div>
			</div>
		</div>
</div>
<!-- end of third section -->