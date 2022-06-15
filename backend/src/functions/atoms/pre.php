<?php
if (!defined('PATH')) exit;

/**
 *
 * @author Lucas Victor
 *
 * DEBUG DE VARIÁVEIS POSTA AUTOMATICAMENTE DENTRO DO DOM <pre>
 *
 * @since 1.0.0 		Módulo iniciado
 * @since 2.0.0			CSS Embutido --->  _custom-alerts.sass
 *							Este CSS é direcionado especialmente para debugs amigaveis
 *						
 *
 */
function pre($param)
{
?>
<pre><?php var_dump( $param ) ?></pre>
<?php
}
