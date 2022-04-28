<?

namespace App\Validator;

use App\Utils\ConstantsUtil;
use App\Utils\JsonUtil;
use Services\DDDService;
use InvalidArgumentException;


class RequestValidator
{
    private array $request;
    private array $dadosRequest;
    private object $TokensAutorizadosRepository;

    const GET = 'GET';
    const DDD = 'DDD';

    /**
     * RequestValidator constructor.
     * @param array $request
     */
    public function __construct($request = [])
    {
        //$this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
        $this->request = $request;
    }

    /**
     * @return array|mixed|string|null
     */
    public function request()
    {
        $retorno = utf8_encode(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
        if (in_array($this->request['method'], ConstantsUtil::TIPO_REQUEST, true)) {
            $retorno = $this->direcionarRequest();
        }
        return $retorno;
    }

    /**
     * Metodo para direcionar o tipo de Request
     * @return array|mixed|string|null
     */
    private function direcionarRequest()
    {
        if ($this->request['method'] !== self::GET && $this->request['method'] !== self::DELETE) {
            $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
        }
        //$this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
        $method = $this->request['method'];
        return $this->$method();
    }

    /**
     * Metodo para tratar os GETS
     * @return array|mixed|string
     */
    private function get()
    {
        $retorno = utf8_encode(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
        if (in_array($this->request['route'], ConstantsUtil::TIPO_GET, true)) {
            switch ($this->request['route']) {
                case self::DDD:
                    $DDDService = new DDDService($this->request);
                    $retorno = $DDDService->validarGet();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;
    }
}