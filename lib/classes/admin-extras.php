<?php

class Wz_Admin_Extras {

	function Wz_Admin_Extras()
	{
		$this->__construct();
	} // end DXIA_Start
	
	function __construct()
	{
		add_action( 'admin_print_footer_scripts', array(&$this, '_admin_mce' ) ,99);
		add_action( 'admin_print_styles', array(&$this, '_metabox_css' ) );
		add_action('admin_print_footer_scripts', array(&$this, '_admin_js'), 10);
	} // end __construct

	function _metabox_css() {

		global $wz_liburl, $wz_version, $current_screen;	

		if ( is_admin()  )
    		{
    			wp_enqueue_style( 'custom-metabox', $wz_liburl . 'css/custom.css', array(), $wz_version, 'all' );
        		wp_enqueue_style( 'wpalchemy-metabox', $wz_liburl . 'css/metaboxes.css', array(), $wz_version, 'all' );
    		}
	}

	function _admin_mce() {
		?>
		<script type="text/javascript">
		//<<[CDATA[
		jQuery(document).ready(function($) {
			/**
			* Meta: TinyMCE
			*/
			function RunTinyMCE() {
				var i = 1;
				$('.customEditor textarea').each(function(e) {
					var id = $(this).attr('id');
					if (!id) {
						id = 'customEditor-' + i++;
						$(this).attr('id', id);
					} //Apply TinyMCE to everyone except the one to copy
					if(!$(this).parents('div.wpa_group').hasClass('tocopy'))
						tinyMCE.execCommand('mceAddControl', false, id);
				});
			}

			RunTinyMCE(); //run onload
			$.wpalchemy.bind('wpa_copy', function(the_clone) { //run when copy is made
				RunTinyMCE();
			});

			/**
			* Meta: Fields Sorting
			*/
			var textareaID;
			$('.wpa_loop-steps').sortable({
				cancel: ':input,button,.customEditor', // exclude TinyMCE area from the sort handle
				axis: 'y',
				opacity: 0.5,
				tolerance: 'pointer',
				change: function() { // show update-required notice when sort is made
					$(this).parent().find('.update-warning').show();
				},
				start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
					textareaID = $(ui.item).find('.customEditor textarea').attr('id');
					tinyMCE.execCommand('mceRemoveControl', false, textareaID);
				},
				stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
					tinyMCE.execCommand('mceAddControl', false, textareaID);
				}
			});
		});
		//]]>>
		</script>
		<?php
	}
		
	function _admin_js(){
		if(!is_admin())
			return; 

		global $current_screen;

		if ( $current_screen->base != 'post' || $current_screen->id != 'wprez' )
			return;
		?>
			<script type="text/javascript">
				//<[CDATA[	
				jQuery(document).ready(function($){
					$('.update-warning').hide();
					$('#postdivrich').children().hide();

					$('.docopy-steps').click(function(){
						$('.wpa_group-steps .postbox').addClass('closed');
						$('.wpa_group-steps.tocopy').prev().children('.postbox').removeClass('closed').addClass('open');
						numberItems();
						copyPrevious();
						//updatePreview();
					});
					$('.dodelete').click(function(){
						numberItems();
						//updatePreview();
					});
					$('input.title').change(function(){
						numberItems();
						//updatePreview();
					});
					$('a.preview').click(function(){
						$(this).attr('target', false).attr('href', '#');
						updatePreview();
						return false;
					});
					function numberItems(){
						var listItems = 0;

						$('.wpa_group-steps .postbox').each(function(){
							listItems++;
							$(this).addClass('pos' + listItems);
							$(this).children('.hndle').empty();
							var thisTitle = $('.pos' + listItems + ' .title').val();
							$(this).children('.hndle').append('<span class="numindicator">#' + listItems + ' ' + thisTitle + '</span>');
							$(this).removeClass('pos' + listItems);
						});
					}
					function copyPrevious(){
						$('.targeted').removeClass('targeted');
						$('.wpa_group-steps.tocopy').prev().addClass('targeted')
						$('.targeted').prev().addClass('subject');
						$(window).scrollTop($('.targeted').offset().top - 28);
					}
					function updatePreview(){
						$('#wprez-preview').remove();
						var lastSlide = $('.wpa_group-steps').length-1;
						$('#postdivrich').after('<iframe id="wprez-preview" src="<?php the_permalink(); ?>#/step' + lastSlide + '" width="100%" style="min-height:600px; max-height:1200px;" scrolling="no"></iframe>');
						// $('#postdivrich').show();
					}
					//updatePreview();		
					numberItems();
				});
				//]]>>
			</script>
			<?php
	}
} // end DXIA_Meta_Boxes


