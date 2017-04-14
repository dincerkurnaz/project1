<!-- Navigation Bar -->
<span itemscope itemtype="http://schema.org/SoftwareApplication">
	<nav class="navbar navbar-static-top">
		<!-- Container -->
		<div class="containers">
			<div class="navbar-header">
				<!-- Toggle Button first -->
				<a class="navbar-brand" href="<?php echo $mysql->get_setting('site_url'); ?>"><img itemprop="image" src="media/img/filex@3x.svg" alt="File Sharing" height="170%" /> <span>Beta - V2</span></a> 
			</div>
			
			<!-- Navigation Links -->
			<div class="nrml_menu">
				<ul class="right_menu">
					<?php
					if(isset($_pageheader) && $_pageheader == 1)
						echo '<li class="active"><a href="'.$mysql->get_setting('site_url').'index.php">File Sharing</a></li>';
					else
						echo '<li><a href="'.$mysql->get_setting('site_url').'index.php">File Sharing</a></li>';
						
					if($mysql->get_setting('allow_stats') == '1') {
						if(isset($_pageheader) && $_pageheader == 2)
							echo '<li class="active"><a style="border:0px;" href="'.$mysql->get_setting('site_url').'check-stats/">Check Stats</a></li>';
						else
							echo '<li><a style="border:0px;" href="'.$mysql->get_setting('site_url').'check-stats/">Check Stats</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</nav><!-- End of navigation -->