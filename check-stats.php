<?php
require 'config.php';
require 'inc/mysql.class.php';
require 'inc/filex.class.php';

if($mysql->get_setting('allow_stats') == '0') {
	header('Location: index.php');
	die();
}

if($mysql->is_banned($_SERVER['REMOTE_ADDR'])) {
	$mysql->add_enter_attempt($_SERVER['REMOTE_ADDR']);
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	die('<h2><center>Oops! You have been banned from this site.</center></h2>');
}

$site = $mysql->get_setting('site_url');

$e = 0;
if(isset($_POST['stats-code-submit'])) {
	if(!isset($_POST['stats-code']))
		$e = 1;
	else{
		$statscode = $_POST['stats-code'];
		if($statscode == '')
			$e = 1;
		else{
			if($mysql->check_existing_statscode($statscode) === true)
				header("Location: {$site}stats/{$statscode}/");
			else
				$e = 2;
		}
	}
}

$_pageheader = 2;
?>
<!DOCTYPE html>
<html>
<?php require 'inc/head.php'; ?>
<body class="randbg">
	<?php require 'inc/header.php'; ?>
	
	<!-- Sixth Container -->
	<!-- Check Stats Container -->
	<section class="container check-stats">
		<p class="big">Check Stats</p>
		<p class="medium">Enter your stats code to check your file statistics</p>
		<?php
		if($e == 1)
			echo '<p class="bg-danger">Please insert your stats code</p>';
		elseif($e == 2)
			echo '<p class="bg-danger">Submitted stats code doesn\'t exist</p>';
		?>
		<form method="post" action="">
			<input type="text" name="stats-code" class="form-control" />
			<button type="submit" name="stats-code-submit" class="btn btn-success pull-right">Check Stats</button>
		</form>
	</section>
	
	<!-- Third Container / Information -->
	<section style="position:absolute; bottom:40px; width:100%;" class="container-fluid information">
		<div class="container">
			<div class="row">
            <div class="col-xs-3 column text-center">
            </div>
				<div class="col-xs-3 column text-center">
					<?php
					$uploaded = $mysql->get_uploaded_files();
					if($uploaded == 0)
						echo 'No';
					else
						echo $uploaded;
					?> Uploaded Files
				</div>
				<div class="col-xs-3 column text-center">
					<?php
					$downloads = $mysql->get_downloads();
					if($downloads == 0)
						echo 'No';
					else
						echo $downloads;
					?> Downloads
				</div>
				<div style="display:none" class="col-xs-3 column text-center">
					<?php
					$expired = $mysql->get_expired_files();
					if($expired == 0)
						echo 'No';
					else
						echo $expired;
					?> Expired Files
				</div>
                          <div class="col-xs-3 column text-center">
            </div>  
                
			</div>
		</div>
	</section>
	
<?php
	if($mysql->get_setting('allow_ads') == '1') {
		$adscode = $mysql->get_setting('ads_code');
?>
	<section class="ads text-center">
		<?php echo $adscode; ?>
	</section>
<?php
	}
?>
	
	<!-- Footer -->
	<footer class="footer_mns">
		<?php echo $mysql->get_setting('footer_info'); ?>
	</footer>
	
	
	
	<!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="media/bootstrap/js/bootstrap.min.js"></script>
    <script src="media/js/rand.bg.js" type="text/javascript" charset="utf-8"></script>
<script>
$(".randbg").RandBG();
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5856fd84ced78618"></script> 
</body>
</html>
