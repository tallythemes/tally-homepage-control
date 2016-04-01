<?php
function tallybuilder_tb_section_columns_config(){
	return array(
		'name' => 'columns',
		'meta_id' => 'tbsf_columns',
		'title' => 'Columns Content',
		'context' => 'normal',
		'priority' => 'high',
		'div_id' => 'tbSection_columns_metabox',
		'show_settings' => false,
		'rows' => array(
			array(
				'div_class' => '',
				'column_limit' => '4',
				'column_layout' => '3,3,3,3',
				'show_settings' => true,
				'edit_layout' => true,
				'columns' => array(
					array(
						'div_class' => '',
						'show_settings' => true,
						'contents' => array(
							array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
							array( 'div_class' => '', 'type' => 'text', 'label' => 'Content'),
						),
					),
					array(
						'div_class' => '',
						'show_settings' => true,
						'contents' => array(
							array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
							array( 'div_class' => '', 'type' => 'text', 'label' => 'Content'),
						),
					),
					array(
						'div_class' => '',
						'show_settings' => true,
						'contents' => array(
							array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
							array( 'div_class' => '', 'type' => 'text', 'label' => 'Content'),
						),
					),
					array(
						'div_class' => '',
						'show_settings' => true,
						'contents' => array(
							array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
							array( 'div_class' => '', 'type' => 'text', 'label' => 'Content'),
						),
					),
				),
			),//ROW 1 END
		),//rows
	);
}