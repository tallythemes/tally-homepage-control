<?php
add_action( 'admin_menu', 'tallybuilder_admin_menu_register' );

function tallybuilder_admin_menu_register(){
	add_menu_page( __( 'Tally Builder', 'tally-builder' ), __( 'Tally Builder', 'tally-builder' ), 'manage_options', 'tallybuilder', 'tallybuilder_admin_page_content', TALLYBUILDER__PLUGIN_URL.'assets/images/icon-light.png', 6 ); 
}

function tallybuilder_admin_page_content(){
	echo '<div class="wrap">';
		$view = NULL;
		if(isset($_GET['view'])){
			$view = urlencode($_GET['view']);
		}
		if($view == 'sections'){
			tallybuilder_admin_html_editPage();
		}else{
			tallybuilder_admin_html_pagesList();
		}
	echo '</div>';
}