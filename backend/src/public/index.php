<?
include '../bootstrap.php';

require_once '../vendor/autoload.php';

use App\Validator\RequestValidator; 
use App\Utils\ConstantsUtil;
use App\Utils\RoutesUtil;
use App\Utils\JsonUtil;

try {
    $requestValidator = new RequestValidator(RoutesUtil::getRoutes());
    $retorno = $requestValidator->request();
   
    $JsonUtil = new JsonUtil();
    $JsonUtil->processarArrayParaRetornar($retorno);

} catch (Exception $exception) {
    echo json_encode([
        ConstantsUtil::TIPO => ConstantsUtil::TIPO_ERRO,
        ConstantsUtil::RESPOSTA => utf8_encode($exception->getMessage())
    ], JSON_THROW_ON_ERROR, 512);
    exit;
}
