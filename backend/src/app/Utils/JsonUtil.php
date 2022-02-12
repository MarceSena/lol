<?

namespace App\Utils;

use App\Utils\ConstantsUtil;
use InvalidArgumentException;
use JsonException;

class JsonUtil {

    public function processarArrayParaRetornar($retorno) 
    {
        $dados = [];
        $dados[ConstantsUtil::TIPO] = ConstantsUtil::TIPO_ERRO;

        if ((is_array($retorno) && count($retorno) > 0) || strlen($retorno) > 10) {
            $dados[ConstantsUtil::TIPO] = ConstantsUtil::TIPO_SUCESSO;
            $dados[ConstantsUtil::RESPOSTA] = $retorno;
        }

        $this->retornarJson($dados);
    }

    private function retornarJson($json)
    {
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
        echo json_encode($json, JSON_THROW_ON_ERROR, 1024);
        exit;
    }

    public static function tratarCorpoRequisicaoJson()
    {
        try {
            $postJson = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERR0_JSON_VAZIO);
        }
        if (is_array($postJson) && count($postJson) > 0) {
            return $postJson;
        }
    }



}