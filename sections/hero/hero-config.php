<?php
function tallybuilder_tb_section_hero_config(){
	return array(
		'name' => 'hero',
		'meta_id' => 'tbsf_hero',
		'title' => 'Hero',
		'context' => 'normal',
		'priority' => 'high',
		'div_id' => 'tbSection_hero_metabox',
		'show_settings' => true,
		'rows' => array(
			array(
				'div_class' => '',
				'column_limit' => '1',
				'column_layout' => '12,0,0,0',
				'show_settings' => true,
				'edit_layout' => false,
				'columns' => array(
					array(
						'div_class' => '',
						'show_settings' => true,
						'contents' => array(
							array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
							array( 'div_class' => '', 'type' => 'text', 'label' => 'Content'),
							array( 'div_class' => '', 'type' => 'button', 'label' => 'Buttons'),
						),
					),
					array(
						'div_class' => '',
						'show_settings' => true,
						'contents' => array(
							array( 'div_class' => '', 'type' => 'title', 'label' => 'Title'),
							array( 'div_class' => '', 'type' => 'text', 'label' => 'Content'),
							array( 'div_class' => '', 'type' => 'button', 'label' => 'Buttons'),
						),
					),
				),
			),//ROW 1 END
		),//rows
	);
}