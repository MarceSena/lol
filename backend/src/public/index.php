<?
include '../bootstrap.php';

require_once '../vendor/autoload.php';

use App\Validator\RequestValidator; 
use App\Utils\ConstantsUtil;
use App\Utils\RoutesUtil;
use App\Utils\JsonUtil;

try {
    $requestValidator = new RequestValidator(RoutesUtil::getRoutes());
    $response = $requestValidator->request();
   
    $JsonUtil = new JsonUtil();
    $JsonUtil->processArray($response);

} catch (Exception $exception) {
    echo json_encode([
        ConstantsUtil::TYPE=> ConstantsUtil::ERRO,
        ConstantsUtil::RESPONSE=> utf8_encode($exception->getMessage())
    ], JSON_THROW_ON_ERROR, 512);
    exit;
}
