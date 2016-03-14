<?php
$div_id = ($args['div_id'] != '') ? 'id="'.$args['div_id'].'"' : '';
$rel = ($args['rel'] != '') ? 'rel="'.$args['rel'].'"' : '';
$style = ($args['css'] != '') ? 'style="'.$args['css'].'"' : '';

$class = 'alert';
$class .= ' alert-'.$args['type'];
$class .= ($args['dismissible'] == 'yes') ? ' alert-dismissible' : '';
$class .= ' '.$args['class'];

$remove_link = ($args['dismissible'] == 'yes') ? '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : '';

echo '<div class="'.$class.'" role="alert" '.$div_id.' '.$rel.' '.$style.'>'.$remove_link .$args['content'].'</div>';