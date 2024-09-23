<?php
include(dirname(__FILE__) . '/../../../wp-load.php');
?>
<h1 class="hidden">Main Navigation</h1>
<ul class="desktop-menu">
	<li><a href="<?php echo get_home_url(); ?>">News</a></li>
	<li class="droppable"><a href="<?php echo get_home_url(); ?>/school-information/">School Information</a>
		<div class="mega-menu">
			<h2>School Information</h2>
			<?php
			// get_template_part('template-parts/mega-menu-dropdowns', 'schoolInfo'); 
			$schoolinfo_menu = get_post(117);
			echo do_shortcode($schoolinfo_menu->post_content);
			?>
		</div>
	</li>
	<li class="droppable"><a href="<?php echo get_home_url(); ?>/policies-forms/" aria-haspopup="true">Policies &amp; Forms</a>
		<div class="mega-menu" aria-label="submenu">
			<h2>Policies &amp; Forms</h2>
			<?php
			// get_template_part('template-parts/mega-menu-dropdowns', 'policies'); 
			$policy_menu = get_post(122);
			echo $policy_menu->post_content;
			?>
		</div>
	</li>
	<li class="droppable"><a href="<?php echo get_home_url(); ?>/faculty-staff/" aria-haspopup="true">Teachers &amp; Staff</a>
		<div class="mega-menu" aria-label="submenu">
			<h2>Teachers &amp; Staff</h2>
			<?php
			//get_template_part( 'template-parts/mega-menu-dropdowns', 'staff'); 
			$faculty_Menu = get_post(70);
			echo $faculty_Menu->post_content;
			?>
		</div>
	</li>

</ul>
<div class="mobile-menu">
	<ul>
		<li><a href="<?php echo get_home_url(); ?>">News</a></li>
		<li><a href="<?php echo get_home_url(); ?>/school-information/">School Information</a></li>
		<li><a href="<?php echo get_home_url(); ?>/policies-forms/">Policies &amp; Forms</a></li>
		<li><a href="<?php echo get_home_url(); ?>/faculty-staff/">Teachers &amp; Staff</a></li>

	</ul>
</div>