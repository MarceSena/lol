<?

namespace App\Validator;

use App\Utils\ConstantsUtil;
use App\Utils\JsonUtil;
use App\Services\DDDService;
use InvalidArgumentException;


class RequestValidator
{
    private array $request;

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
        $response = utf8_encode(ConstantsUtil::MSG_ERRO_TYPE_ROUTE);
        if (in_array($this->request['method'], ConstantsUtil::TYPE_REQUEST, true)) {
            $response = $this->redirectRequest();
        }
        return $response;
    }

    /**
     * Metodo para direcionar o TYPE de Request
     * @return array|mixed|string|null
     */
    private function redirectRequest()
    {
        if ($this->request['method'] !== self::GET) {
            $this->dadosRequest = JsonUtil::requestBody();
        }
        $method = $this->request['method'];
        return $this->$method();
    }

    /**
     * @return array|mixed|string
     */
    private function get()
    {
        $response = utf8_encode(ConstantsUtil::MSG_ERRO_TYPE_ROUTE);
        if (in_array($this->request['route'], ConstantsUtil::TYPE_GET, true)) {
            switch ($this->request['route']) {
                case self::DDD:
                    $DDDService = new DDDService($this->request);
                    $response = $DDDService->validateGet();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RESOURCE);
            }
        }
        return $response;
    }
}
