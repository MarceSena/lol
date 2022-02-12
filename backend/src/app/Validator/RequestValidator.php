<?

namespace App\Validator;

use App\Utils\ConstantsUtil;
use Utils\JsonUtil;
use Services\UsuariosService;
use Services\DDDService;
use InvalidArgumentException;


class RequestValidator
{
    private array $request;
    private array $dadosRequest;
    private object $TokensAutorizadosRepository;

    const GET = 'GET';
    const DELETE = 'DELETE';
    const USUARIOS = 'USUARIOS';
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
     * Metodo para tratar os DELETES
     * @return mixed|string
     */
    private function delete()
    {
        $retorno = utf8_encode(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
        if (in_array($this->request['route'], ConstantsUtil::TIPO_DELETE, true)) {
            switch ($this->request['route']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarDelete();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;
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
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarGet();
                    break;
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

    /**
     * Metodo para tratar os POSTS
     * @return array|null|string
     */
    private function post()
    {
        $retorno = null;
        if (in_array($this->request['route'], ConstantsUtil::TIPO_POST, true)) {
            switch ($this->request['route']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $UsuariosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $UsuariosService->validarPost();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
            }
            return $retorno;
        }
        throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
    }

    /**
     * Metodo para tratar os PUTS
     * @return array|null|string
     */
    private function put()
    {
        $retorno = null;
        if (in_array($this->request['route'], ConstantsUtil::TIPO_PUT, true)) {
            switch ($this->request['route']) {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $UsuariosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $UsuariosService->validarPut();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
            }
            return $retorno;
        }
        throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_TIPO_ROTA);
    }
}