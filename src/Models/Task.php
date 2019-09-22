<?php


namespace BeeJee\App\Models;

use BeeJee\App\Persistable;

/**
 * Class Task
 *
 * @property int    $id
 * @property string email
 * @property string username
 * @property string text
 * @property bool   done
 * @property bool   edited_by_admin
 * @property int    created
 * @property int    updated
 *
 * @package BeeJee\App\Models
 */
class Task
{
    use Persistable;

    const PER_PAGE = 3;

    const AVAILABLE_SORT = [
        'email desc'    => 'Email ↓ ',
        'email asc'     => 'Email ↑ ',
        'username desc' => 'Имя пользователя ↓ ',
        'username asc'  => 'Имя пользователя ↑ ',
        'done desc'     => 'Готовность ↓ ',
        'done asc'      => 'Готовность ↑ ',
    ];


    /**
     * @var \PDO
     */
    private $db;

    /**
     * Task constructor.
     *
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function create(): Task
    {
        $statement = $this->db->prepare('
            INSERT INTO tasks (email, username, text, done) VALUES (:email, :username, :text, :done)
        ');
        $statement->bindValue(':email', $this->email, \PDO::PARAM_STR);
        $statement->bindValue(':username', $this->username, \PDO::PARAM_STR);
        $statement->bindValue(':text', $this->text, \PDO::PARAM_STR);
        $statement->bindValue(':done', $this->done, \PDO::PARAM_INT);

        $statement->execute();

        $this->id = $this->db->lastInsertId();

        return $this;
    }

    public function update(): Task
    {
        $statement = $this->db->prepare('
            UPDATE tasks SET text=:text, done=:done, edited_by_admin=:edited_by_admin WHERE id=:id
        ');
        $statement->bindValue(':text', $this->text, \PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);
        $statement->bindValue(':done', $this->done, \PDO::PARAM_INT);
        $statement->bindValue(':edited_by_admin', $this->edited_by_admin, \PDO::PARAM_INT);

        $statement->execute();

        return $this;
    }

    public function getList($order_by = 'id desc', $offset = 0, $limit = self::PER_PAGE): array
    {
        $statement = $this->db->prepare("SELECT * FROM tasks ORDER BY ${order_by} LIMIT :limit OFFSET :offset");
        $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        $collection = [];

        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $item) {
            $collection[] = (new static($this->db))->fromArray($item);
        }

        return $collection;
    }

    public function count(): int
    {
        $statement = $this->db->prepare('SELECT count(*) FROM tasks');
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function getById(int $id): Task
    {
        $statement = $this->db->prepare('SELECT * FROM tasks WHERE id = :id');
        $statement->execute([
            'id' => $id,
        ]);

        return (new static($this->db))->fromArray($statement->fetch());
    }
}