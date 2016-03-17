<?php
$div_id = ($args['div_id'] != '') ? 'id="'.$args['div_id'].'"' : '';
$rel = ($args['rel'] != '') ? 'rel="'.$args['rel'].'"' : '';
$css = ($args['css'] != '') ? 'style="'.$args['css'].'"' : '';

$class = 'tbraw_services';
$class .= ' '.$args['class'];
$class .= ' tbraw_'.$args['column'];

if(is_front_page()){
	$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
}else{
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
}
$query_args = array(
	'post_type' => 'tt_service',
	'posts_per_page' => $args['limit'],
	'paged' => $paged 
);
if($args['cat'] != ''){
	$query_args['tax_query '] = array(
		array(
			'taxonomy' => 'tt_service_cat',
			'field'    => 'slug',
			'terms'    => $args['cat'],
		)
	);
}


$tbraw_query = new WP_Query( $query_args );
?>
<div class="<?php echo $class; ?>" <?php echo $div_id; ?> <?php echo $rel; ?> <?php echo $css; ?> >
	<div class="tbraw_services_inner">
        <?php if($tbraw_query->have_posts()): ?>
        	<?php while ( $tbraw_query->have_posts() ): $tbraw_query->the_post(); ?>
            	<div class="tbraw_service_item">
                	<div class="tbraw_service_item_inner">
                    	
                    </div>
                </div>
            <?php endwhile; ?>
            <?php if($args['paginate'] == 'yes'){ echo tallybuilder_paginate($tbraw_query); } ?>
        <?php else: ?>
        	Sorry No post found
        <?php endif; ?>
	</div>
</div>