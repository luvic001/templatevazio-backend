<?php 

/**
 * @author Lucas Victor
 *
 * @version 1.0.0
 *
 * @package GBL 
 * @subpackage Circular graph SVG
 *
 * @since 1.0.0 - Introduced
 *
 * @param {ARRAY} $data - size: Diameter {INT}
 * 						- stroke_w: Stroke width {STRING}
 * 						- color: Stroke color {STRING}
 * 						- ID: Special ID {STRING}
 * 						- view_box: {INT} Square box size
 * 						- max_percent: {INT} Maximun percentage count
 *
 * @requires format-to_format.php - @version 1.0.0
 *
 * @return STRING
 */

if (!defined('PATH'))
	exit;

function circle_svg($data = array())
{


$data = to_object($data);

$size = $data->size ?? 100;
$stroke_w = $data->stroke_w ?? '.2';
$color = $data->color ?? '#4CC790';
$ID = $data->ID ?? null;
$view_box = $data->view_box ?? 36;
$max_percent = $data->max_percent ?? 100;
$fill = $data->fill ?? '#dddddd';

$dimentions['initial'] = $size / (3.14159 * 2);
$dimentions['final'] = $dimentions['initial'] * 2;

$dimentions['view-box'] = [
	'x' => $view_box / 2,
	'y' => (($view_box - $dimentions['final']) / 2)
];

$dimentions = to_object($dimentions);

?>
<style>
	.circular-chart {
	  display: block;
	  margin: 10px auto;
	  max-height: 250px;
	}

	.circle-php-svg {
		fill: <?= $fill ?>;
	  stroke-linecap: round;
	  animation: progress 1s ease-out forwards;
		stroke-width: <?= $stroke_w ?>px;
		stroke: <?= $color ?>;
	}

	<?php 
		if ($ID) {
			___(sprintf('
				#%s path {
					stroke: %s !important;
					stroke-width: %spx !important;
					fill: %s !important
				}
			', $ID, $color, $stroke_w, $fill));
		}
	?>

	@keyframes progress {
	  0% {
	    stroke-dasharray: 0 100;
	  }
	}
</style>
<svg viewBox="0 0 <?= sprintf('%s %s', $view_box, $view_box ) ?>" <?=  $ID ? sprintf('id="%s"', $ID) : '' ?> class="circular-chart">
  <path class="circle-php-svg"
    stroke-dasharray="<?= $max_percent ?>, 100"
    d="M<?= floatval($dimentions->{'view-box'}->x) ?> <?= $dimentions->{'view-box'}->y ?>
      a <?= $dimentions->initial ?> <?= $dimentions->initial ?> 0 0 1 0 <?= $dimentions->final ?>
      a <?= $dimentions->initial ?> <?= $dimentions->initial ?> 0 0 1 0 -<?= $dimentions->final ?>"
  />
</svg>
<?php
}