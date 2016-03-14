<?php
$div_id = ($args['div_id'] != '') ? 'id="'.$args['div_id'].'"' : '';
$rel = ($args['rel'] != '') ? 'rel="'.$args['rel'].'"' : '';
$style = ($args['css'] != '') ? 'style="'.$args['css'].'"' : '';
$type = ($args['type'] != '') ? ' progress-bar-'.$args['type'] : '';
$striped = ($args['striped'] == 'yes') ? ' progress-bar-striped ' : '';
$animated = ($args['animated'] == 'yes') ? ' active ' : '';

$class = 'progress';
$class .= ' '.$args['class'];
?>
<div class="<?php echo $class; ?>" <?php echo $div_id; ?> <?php echo $rel; ?> <?php echo $type; ?> >
  <div class="progress-bar <?php echo $type . $striped . $animated;?>" role="progressbar" aria-valuenow="<?php echo $args['width']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $args['width']; ?>%;">
    <?php echo $args['content']; ?>
  </div>
</div>