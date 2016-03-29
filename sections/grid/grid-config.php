<?php
$tb_section_grid_config = array(
	'meta_id' => 'tbsf_grid',
	'title' => 'Grid',
	'context' => 'normal',
	'priority' => 'high',
	'div_id' => 'tbSection_grid_metabox',
	'show_settings' => true,
	'rows' => array(
		array(
			'div_class' => '',
			'column_limit' => '1',
			'column_layout' => '12,0,0,0',
			'show_settings' => true,
			'edit_layour' => false,
			'columns' => array(
				array(
					'div_class' => '',
					'show_settings' => true,
					'contents' => array(
						array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
						array( 'div_class' => '', 'type' => 'text', 'label' => 'Description'),
						array( 'div_class' => '', 'type' => 'grid', 'label' => 'Grid Content'),
						array( 'div_class' => '', 'type' => 'button', 'label' => 'Buttons'),
					),
				),
			),
		),//ROW 1 END
	),//rows
);