<?PHP

$controladores = glob( CONTROLLERS .'/*.php');
$models = glob( MODELS .'/*.php');

// Acá comienza lo cambiado por GPT
require ROOT_DIR . 'src/models/EntityModel.php';
// Hasta acá lo cambiado por GPT

foreach($controladores as $c){require_once( $c );}
foreach($models as $m){require_once( $m );}