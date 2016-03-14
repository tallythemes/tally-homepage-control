<?php
$div_id = ($args['div_id'] != '') ? 'id="'.$args['div_id'].'"' : '';
$rel = ($args['rel'] != '') ? 'rel="'.$args['rel'].'"' : '';
$title = ($args['title'] != '') ? 'title="'.$args['title'].'"' : '';
$style = ($args['css'] != '') ? 'style="'.$args['css'].'"' : '';
$href = ($args['link'] != '') ? 'href="'.$args['link'].'"' : '';
$target = ($args['target'] != '') ? 'target="'.$args['target'].'"' : '';

$class = 'btn';
$class .= ' btn-'.$args['size'];
$class .= ' btn-'.$args['type'];
$class .=  ($args['block'] == 'yes') ? ' btn-block' : '';
$class .= ' '.$args['class'];

echo '<a '.$href.' '.$target.' '.$div_id.' '.$style.' '.$rel.' '.$title.' class="'.$class.'"><span>'.$args['text'].'</span></a>';