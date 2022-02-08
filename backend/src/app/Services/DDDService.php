<?

namespace Services;

use InvalidArgumentException;
use Repository\DDDRepository;
use Utils\ConstantsUtil;

class DDDService
{
    public const TABELA = 'ddd';
    public const RECURSOS_GET = ['listar'];
    public const RECURSOS_POST = ['cadastrar'];
    public const RECURSOS_DELETE = ['deletar'];
    public const RECURSOS_PUT = ['atualizar'];

    private array $dados;
    private array $dadosCorpoRequest;
    /**
     * @var object|DDDRepository
     */
    private object $DDDRepository;

    /**
     * UsuariosService constructor.
     * @param array $dados
     */
    public function __construct($dados = [])
    {
        $this->dados = $dados;
        $this->DDDRepository = new DDDRepository();
    }

    /**
     * @return mixed
     */
    public function validarGet()
    {
        $retorno = null;
        $recurso = $this->dados['resource'];
        if (in_array($recurso, self::RECURSOS_GET, true)) {
            $retorno = $this->dados['id'] > 0 ? $this->getOneByKey() : $this->$recurso();
        } else {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    /**
     * @return mixed
     */
    public function validarDelete()
    {
        $retorno = null;
        $recurso = $this->dados['resource'];
        if (in_array($recurso, self::RECURSOS_DELETE, true)) {
            if ($this->dados['id'] > 0) {
                $retorno = $this->$recurso();
            } else {
                throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_ID_OBRIGATORIO);
            }
        } else {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    /**
     * @return mixed
     */
    public function validarPost()
    {
        $retorno = null;
        $recurso = $this->dados['resource'];
        if (in_array($recurso, self::RECURSOS_POST, true)) {
            $retorno = $this->$recurso();
        } else {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    /**
     * @return mixed
     */
    public function validarPut()
    {
        $retorno = null;
        $recurso = $this->dados['resource'];
        if (in_array($recurso, self::RECURSOS_PUT, true)) {
            if ($this->dados['id'] > 0) {
                $retorno = $this->$recurso();
            } else {
                throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_ID_OBRIGATORIO);
            }
        } else {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_GENERICO);
        }

        return $retorno;
    }

    /**
     * @param array $dadosCorpoRequest
     */
    public function setDadosCorpoRequest($dadosCorpoRequest)
    {
        $this->dadosCorpoRequest = $dadosCorpoRequest;
    }

    /**
     * @return mixed
     */
    private function listar()
    {
        return $this->DDDRepository->getMySQL()->getAll(self::TABELA);
    }

    /**
     * @return mixed
     */
    private function getOneByKey()
    {
        return $this->DDDRepository->getMySQL()->getOneByKey(self::TABELA, $this->dados['id']);
    }

    /**
     * @return array
     */
    private function cadastrar()
    {
        [$login, $senha] = [$this->dadosCorpoRequest['login'], $this->dadosCorpoRequest['senha']];

        if ($login && $senha) {
            if ($this->DDDRepository->getRegistroByLogin($login) > 0) {
                throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_LOGIN_EXISTENTE);
            }

            if ($this->DDDRepository->insertUser($login, $senha) > 0) {
                $idInserido = $this->DDDRepository->getMySQL()->getDb()->lastInsertId();
                $this->DDDRepository->getMySQL()->getDb()->commit();
                return ['id_inserido' => $idInserido];
            }

            $this->DDDRepository->getMySQL()->getDb()->rollBack();

            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_GENERICO);
        }
        throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_LOGIN_SENHA_OBRIGATORIO);
    }

    /**
     * @return string
     */
    private function deletar()
    {
        return $this->DDDRepository->getMySQL()->delete(self::TABELA, $this->dados['id']);
    }

    /**
     * @return string
     */
    private function atualizar()
    {
        if ($this->DDDRepository->updateUser($this->dados['id'], $this->dadosCorpoRequest) > 0) {
            $this->DDDRepository->getMySQL()->getDb()->commit();
            return ConstantsUtil::MSG_ATUALIZADO_SUCESSO;
        }
        $this->DDDRepository->getMySQL()->getDb()->rollBack();
        throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_NAO_AFETADO);
    }

}