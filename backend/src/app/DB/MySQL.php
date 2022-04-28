<?

namespace App\DB;

use InvalidArgumentException;
use PDO;
use PDOException;
use App\Utils\ConstantsUtil;

class MySQL
{
    private object $db;

    /**
     * MySQL constructor.
     */
    public function __construct()
    {
        $this->db = $this->setDB();
    }

    /**
     * @return PDO
     */
    public function setDB()
    {
        try {
            return new PDO(
                'mysql:host=' . HOST . '; dbname=' . DATABASE . ';',
                USER,
                PASSWORD
            );
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * @param $table
     * @return array
     */
    public function getAll($table)
    {
        if ($table) {
            $query = 'SELECT * FROM ' . $table;
            $stmt = $this->db->query($query);
            $records = $stmt->fetchAll($this->db::FETCH_ASSOC);
            if (is_array($records) && count($records) > 0) {
                return $records;
            }
        }
        throw new InvalidArgumentException(ConstantsUtil::MSG_ERRO_NO_RETURN);
    }
    
    /**
     * @return object|PDO
     */
    public function getDb()
    {
        return $this->db;
    }
}
