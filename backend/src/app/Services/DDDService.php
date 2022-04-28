<?

namespace Services;

use InvalidArgumentException;
use Repository\DDDRepository;
use App\Utils\ConstantsUtil;

class DDDService
{
    public const TABELA = 'ddd';
    public const RECURSOS_GET = ['listar'];

    private array $dados;

    /**
     * @var object|DDDRepository
     */
    private object $DDDRepository;

    /**
     * DDDService constructor.
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
  
  }