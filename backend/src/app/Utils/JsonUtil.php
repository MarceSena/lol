<?

namespace App\Utils;

use App\Utils\ConstantsUtil;
use InvalidArgumentException;
use JsonException;

class JsonUtil
{

    public function processArray($response)
    {
        $data = [];
        $data[ConstantsUtil::TYPE] = ConstantsUtil::ERRO;

        if ((is_array($response) && count($response) > 0) || strlen($response) > 10) {
            $data[ConstantsUtil::TYPE] = ConstantsUtil::SUCCESS;
            $data[ConstantsUtil::RESPONSE] = $response;
        }

        $this->returnJson($data);
    }

    private function returnJson($json)
    {
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
        echo json_encode($json, JSON_THROW_ON_ERROR, 1024);
        exit;
    }

    public static function requestBody()
    {
        try {
            $postJson = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERR0_JSON_EMPTY);
        }
        if (is_array($postJson) && count($postJson) > 0) {
            return $postJson;
        }
    }
}
