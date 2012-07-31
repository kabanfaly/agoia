<?php
/**
 * Section to add gallery and upload videos
 * @author Praveen Rajan
 */
?>
<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

?>

<script src="<?php echo trailingslashit( WP_PLUGIN_URL . '/' .	dirname(dirname( plugin_basename(__FILE__)))) ?>js/jquery.ui.tabs.js"></script>
<script src="<?php echo trailingslashit( WP_PLUGIN_URL . '/' .	dirname(dirname( plugin_basename(__FILE__)))) ?>js/jquery.multifile.js"></script>

<?php echo '<link rel="stylesheet" href="'.trailingslashit( WP_PLUGIN_URL . '/' .	dirname(dirname( plugin_basename(__FILE__)))).'css/jquery.ui.tabs.css" type="text/css" />';?>
<?php CvgCore::upgrade_plugin();?>
<?php
$title = __('Add Gallery / Videos');
//Section on submitting data.
if ( !empty($_POST) ) {
	CvgCore::processor();
}	
?>
<script type="text/javascript">	
	/*
	 * Section to initialise multiple file upload
	 */
	jQuery(document).ready(function(){
		jQuery('#videofiles').MultiFile({
			STRING: {
		    	remove:'[<?php _e('remove') ;?>]',
		    	denied:'File type not permitted.'
  			},
  			accept : 'mp4,flv,MP4,FLV,mov,MOV,MP3,mp3,m4v,M4V'
	 	});

	 	jQuery('#uploadvideo_btn').click(function(){ 
		 	if(jQuery.trim(jQuery('#galleryselect').val()) == 0) {
			 	alert('Please choose a gallery.');
		 	}else {
			 	jQuery('#uploadvideo_form').submit();
		 	}
		 });
		 
		 jQuery('#addvideo_btn').click(function(){ 
		 	if(jQuery.trim(jQuery('#galleryselect_add').val()) == 0) {
			 	alert('Please choose a gallery.');
		 	}else {
			 	jQuery('#addvideo_form').submit();
		 	}
		 });
		 
		 jQuery('#addmedia_btn').click(function(){ 
		 	if(jQuery.trim(jQuery('#galleryselect_media').val()) == 0) {
			 	alert('Please choose a gallery.');
		 	}else if(jQuery.trim(jQuery('#mediaselect_add').val()) == 0) {
		 		alert('Please choose a media file.');
		 	}else {
			 	jQuery('#addmedia_form').submit();
		 	}
		 });
	});
</script>
<div class="wrap">
	<div class="icon32" id="icon-video"><br></div>
	<h2><?php echo esc_html( __($title) ); ?></h2>
	<div class="clear"></div>

	<?php $tabs = CvgCore::tabs_order(); ?>

	<!-- Section to display tabs -->
	<div id="slider" class="wrap">
        <ul id="tabs">
        	<?php    
        	foreach($tabs as $tab_key => $tab_name) {
        	   echo "\n\t\t<li><a href='#$tab_key'>". __($tab_name) ."</a></li>";
            } 
            ?>
		</ul>
        <?php    
        foreach($tabs as $tab_key => $tab_name) {
            echo "\n\t<div id='$tab_key'>\n";
            $function_name = 'tab_'.$tab_key;
            CvgCore::$function_name();
            echo "\n\t</div>";
        } 
        ?>
    </div>
</div><!-- wrap -->

<script type="text/javascript">
	/*
	 * Section to initialise tab
	 */
	jQuery(document).ready(function(){
		jQuery('#slider').tabs({ fxFade: true, fxSpeed: 'fast' });	
	});
</script>