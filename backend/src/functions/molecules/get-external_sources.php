<?php 

if (!defined('PATH'))
    exit;

// Return CSS
function get_css($preload = true)
{
    global $TEMPLATE_DIRECTORY_URI;

    $css = sprintf
    ( 
        '%s/%s',
        $TEMPLATE_DIRECTORY_URI,
        'style.css'
    );
    if ($preload):
?>
    <link rel="stylesheet" href="<?= $css ?>?update=<?= date('His.Ymd') ?>" media="screen">
<?php
    else:
?>
    <link rel="preload" href="<?= $css ?>?update=<?= date('His.Ymd') ?>" as="style">
<?php
    endif;
}

// Return JS
function get_script()
{
    global $TEMPLATE_DIRECTORY_URI;

    $script = sprintf
    ( 
        '<script async src="%s/%s"></script>',
        $TEMPLATE_DIRECTORY_URI,
        'js/script.min.js?update='.date('His.Ymd')
    );

    return $script;

}

// GETTING GOOGLE FONTS
if (GOOGLE_FONTS)
{
    function load_fonts()
    {
        return (
            sprintf
            (
                '<link href="https://fonts.googleapis.com/css2?family=%s" rel="stylesheet">',
                GOOGLE_FONTS
            )
        );
    }
}
if (MATERIAL_DESIGN)
{
    function material_design()
    {
        global $TEMPLATE_DIRECTORY_URI;

        ___('<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" lazyload>');
        ___(sprintf('<script src="%s/js/material-design.js"></script>', $TEMPLATE_DIRECTORY_URI));
    }
}

// GET BOOTSTRAP
function bootstrap($preload = true)
{
    global $TEMPLATE_DIRECTORY_URI;
    if ($preload):
?>
    <link rel="stylesheet" href="<?php ___( $TEMPLATE_DIRECTORY_URI ) ?>/source/bootstrap/dist/css/bootstrap.min.css" media="screen">
<?php
    else:
?>
    <link rel="preload" href="<?php ___( $TEMPLATE_DIRECTORY_URI ) ?>/source/bootstrap/dist/css/bootstrap.min.css" as="style">
<?php
    endif;
}

function lc_header()
{
	if (THEME_COLOR)
       ___( sprintf('<meta name="theme-color" content="%s">', THEME_COLOR) );
    ___( '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=6">');
}

// Load Everything
function sources()
{
    if(defined('USE_AJAX'))
        ___('<script>var plainscripts =  { ajax_url: "' . AJAX_URI . '" }</script>');
}


// Extra resources

if (ENABLE_GM) // Enabling google maps
{
    function google_maps(){
        if(defined('GM_API_KEY'))
        {
            ?>
            <script>
                    window.setTimeout(function(){
                        var google_maps_script = document.createElement('script');
                        google_maps_script.async = 'async';
                        google_maps_script.src = 'https://maps.googleapis.com/maps/api/js?key=<?php ___(GM_API_KEY) ?>&callback=initMap';
                        google_maps_script.type = 'text/javascript';
                        document.body.appendChild(google_maps_script);
                    }, 2000);
            </script>
            <?php
        }
        else {
            ___( '<p style="display: block; background-color: #eee; width: 100%; margin: 1rem; padding: 1rem; border-left: 1px solid #c33;">A DEFINIÇÃO DE <em>GM_API_KEY</em> é obrigatória. Nela contém as informações de chave de API.</p>' );
        }
    }
}

if (function_exists('google_maps'))
{
/**
 *@version 1.0.0
 *@author Lucas Victor
 * Criar um elemento do google maps
 */
function add_map
(
    $coords = [
        [ 'Local 1', -25.344, 131.036 ],
        [ 'Local 2', -25.344 , 131.036 ]
    ],
    $center = [-22.988112920361406, -43.28952527613018],
    $zoom = 8,
    $element_height = 400,
    $element_ID = 'map_dump', 
    $map_selected = 3
)
{
    $mapType = [ 'terrain', 'hybrid', 'satellite', 'roadmap' ];
?>
    <div id="<?php ___($element_ID) ?>" style="height: <?= $element_height ?>px;"></div>
    <script>
    function initMap() {

        var locations = <?php ___(json_encode($coords)) ?>;

        var map = new google.maps.Map(document.getElementById('<?php ___($element_ID) ?>'), {
          zoom: <?php ___($zoom) ?>,
          center: new google.maps.LatLng(<?php ___($center[0]) ?>, <?php ___($center[1]) ?>),
          mapTypeId: '<?php ___($mapType[$map_selected]) ?>'
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }

    }
    
    </script>
    <style>
        #<?php ___($element_ID) ?> {
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
<?php
    google_maps();
}
}