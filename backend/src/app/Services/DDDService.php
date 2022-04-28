<?

namespace App\Services;

use InvalidArgumentException;
use App\Repository\DDDRepository;
use App\Utils\ConstantsUtil;

class DDDService
{
    public const TABLE = 'ddd';
    public const RESOURCE_GET = ['getAll'];

    private array $data;

    /**
     * @var object|DDDRepository
     */
    private object $DDDRepository;

    /**
     * DDDService constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
        $this->DDDRepository = new DDDRepository();
    }

    /**
     * @return mixed
     */
    public function validateGet()
    {
        $response = null;
        $resource = $this->data['resource'];
        if (in_array($resource, self::RESOURCE_GET, true)) {
            $response =  $this->$resource();
        } else {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_RESOURCE);
        }

        if ($response === null) {
            throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_GENERIC);
        }

        return $response;
    }

    /**
     * @return mixed
     */
    private function getAll()
    {
        return $this->DDDRepository->getMySQL()->getAll(self::TABLE);
    }
}
