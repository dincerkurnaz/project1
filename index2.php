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
<?php require 'inc/head.php'; ?>

  <!-- Fine Uploader Thumbnails template w/ customization
    ====================================================================== -->
    <script type="text/template" id="qq-template-manual-trigger">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons">
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Select files</div>
                </div>
                <button type="button" id="trigger-upload" class="btn btn-primary">
                    <i class="icon-upload icon-white"></i> Upload
                </button>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
					<button type="button" class="qq-upload-pause-selector qq-upload-pause">Pause</button>
					<button type="button" class="qq-upload-continue-selector qq-upload-continue">Continue</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>

    <style>
        #trigger-upload {
            color: white;
            background-color: #00ABC7;
            font-size: 14px;
            padding: 7px 20px;
            background-image: none;
        }

        #fine-uploader-manual-trigger .qq-upload-button {
            margin-right: 15px;
        }

        #fine-uploader-manual-trigger .buttons {
            width: 36%;
        }

        #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
            width: 60%;
        }
    </style>

    <title>Fine Uploader Manual Upload Trigger Demo</title>
	
<body class="randbg">
	<?php require 'inc/header.php'; ?>

	<!-- First Container -->
	<section class="first-container" id="fine-uploader-manual-trigger">
		<div class="row">
           <div  id="fine-uploader-trg" class="upload_satir right-text"> 
            <div class="uploadico left-icon1"> 
				<i class="fa fa-plus" aria-hidden="true"></i>
			</div>
			<div class="uploadtext">
            <h2>File Share Transfer</h2>
				<h3>Send large files up to 20GB for free</h3>
			</div>
         </div>
         <div class="right-text uploads_name"> 
         <p></p>
         </div>
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
       <div class="alts"><button type="submit" id="trigger-upload" class="btn btn-alt upload" >UPLOAD</button>
  	</form>
  </div>
  
         </div>
	<div class="crm_yazi">We love Google Chrome!</div>
		
		<input type="file" name="fileinput" class="hide" id="fileinput" />
	</section>
	

	<!-- Third Container / Information -->
	<section style="position:absolute; bottom:40px; width:100%;" class="container-fluid information">
		<div class="container">
			<div class="row">
				<div class="col-xs-4 column text-center">
					<?php
					$uploaded = $mysql->get_uploaded_files();
					if($uploaded == 0)
						echo 'No';
					else
						echo $uploaded;
					?> Uploaded Files
				</div>
				<div class="col-xs-4 column text-center">
					<?php
					$downloads = $mysql->get_downloads();
					if($downloads == 0)
						echo 'No';
					else
						echo $downloads;
					?> Downloads
				</div>
				<div class="col-xs-4 column text-center">
					<?php
					$expired = $mysql->get_expired_files();
					if($expired == 0)
						echo 'No';
					else
						echo $expired;
					?> Expired Files
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
		echo 'var allowed_extensions = '.$extensions;
		?>
	
	</script>


	<!--<script src="media/js/filex.init.js"></script>-->
	
	    <!-- Fine Uploader New/Modern CSS file
    ====================================================================== -->
    <link href="fine-uploader/fine-uploader-new.css" rel="stylesheet">

    <!-- Fine Uploader jQuery JS file
    ====================================================================== 
    <script src="fine-uploader/jquery.fine-uploader.js"></script>-->
	  
    <script src="fine-uploader/fine-uploader.js"></script>
	
	 <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
    ====================================================================== -->
    <script>/*
	    var days = $('input[name=days]').val();
        var downloads = $('input[name=downloads]').val();
        var password = $('input[name=password]').val();
		
        $('#fine-uploader-manual-trigger').fineUploader({
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: 'upload.php?days='+days+'&downloads='+downloads+'&password='+password
            },
            thumbnails: {
                placeholders: {
                    waitingPath: '/fine-uploader/placeholders/waiting-generic.png',
                    notAvailablePath: '/fine-uploader/placeholders/not_available-generic.png'
                }
            },
            autoUpload: false
        });

        $('#trigger-upload').click(function() {
			
			days = $('input[name=days]').val();
			downloads = $('input[name=downloads]').val();
			password = $('input[name=password]').val();
		
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });*/
    </script>
	
	<script>
	
	   // var days = $('input[name=days]').val();
        var downloads = $('input[name=downloads]').val();
        var password = $('input[name=password]').val();
		
        var manualUploader = new qq.FineUploader({
            element: document.getElementById('fine-uploader-trg'),
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: '/upload2.php?downloads='+downloads+'&password='+password+''
            },
            thumbnails: {
                placeholders: {
                    waitingPath: '/fine-uploader/placeholders/waiting-generic.png',
                    notAvailablePath: '/fine-uploader/placeholders/not_available-generic.png'
                }
            },
			retry: {
			enableAuto: false // defaults to false
			},
			resume: {
				enabled: true
			}
 		   ,
            autoUpload: false,
            debug: true
        });

        qq(document.getElementById("trigger-upload")).attach("click", function() {
			//days = $('input[name=days]').val();
			downloads = $('input[name=downloads]').val();
			password = $('input[name=password]').val();
            manualUploader.uploadStoredFiles();
        });
    </script>
	
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5856fd84ced78618"></script> 
</body>
</html>
