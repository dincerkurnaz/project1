<?php
require 'config.php';
require 'inc/mysql.class.php';

if($mysql->is_banned($_SERVER['REMOTE_ADDR'])) {
	$mysql->add_enter_attempt($_SERVER['REMOTE_ADDR']);
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	die('<h2><center>Oops! You have been banned from this site.</center></h2>');
}

$_pageheader = 1;
?>
<!DOCTYPE html>
<html lang="en">
<link rel="alternate" href="https://quictransfer.com/" hreflang="en"/>
<?php require 'inc/head.php'; ?>
<body class="randbg">
	<?php require 'inc/header.php'; ?>

	<!-- First Container -->
	<section class="first-container">
		<div class="row">
			<label for="fileinput" class="over-container">
           <div class="upload_satir right-text"> 
            <div class="uploadico left-icon1"> 
				<i class="fa fa-plus" aria-hidden="true"></i>
			</div>
			<div class="uploadtext">
            <h2>File Transfer</h2>
				<h3>Send large files up to 20GB for free</h3>
			</div>
         </div>
         <div class="right-text uploads_name"> 
         <p></p>
         </div>
         </label>
         	<form method="post" action="index.php" name="upload">
       <div class="dvs_ortalik">

						<div class="hkacgund">
							<p><span>Delete files after</span> <input type="text" name="downloads" class="form-control" style="width:40px;" /> <span>downloads</span></p>
						</div>


						<div class="head text-center password">
							<p>Protect files with password:</p>
							<input type="text" name="password" class="form-control big" />
						</div>


                    </div>
       <div class="alts"><button type="submit" class="btn btn-alt upload" >File Transfer</button>
  	</form>
  </div>
  
         </div>
		
		<input type="file" name="fileinput" class="hide" id="fileinput" />
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		        <script src="media/js/rand.bg.js" type="text/javascript" charset="utf-8"></script>
<script>
$(".randbg").RandBG();
</script>
	<script>
		<?php
		$extensions = $mysql->get_setting('allowed_extensions');
		if($extensions == '')
			echo 'var all_extensions_allowed = true;';
		else
			echo 'var all_extensions_allowed = false;';
			
		echo "\r\n		";
		
		$extensions = implode("','", explode(',', $extensions));
		$extensions = "['$extensions'];";
        if(isset($extensions))
		   echo 'var allowed_extensions = '.$extensions;
		?>
	
	</script>


	<script src="media/js/filex.init.js"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5856fd84ced78618"></script> 
<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-5AwkQ48bEcXAt"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-5AwkQ48bEcXAt.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->
</body>
</html>
