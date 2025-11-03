<?php
class Enseignant 
{
    private ?int $rowid;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $birthday;
    private ?string $adress;
    private ?string $zipcode;
    private ?string $town;
    private ?int $fk_user = null;
    private ?string $password;
    private ?string $username;
    private $db;

    public function hydrate(array $infos, bool $mis_a_jour = false){
        $this->rowid = isset($infos['rowid']) ? (int)$infos['rowid'] : null;

        $this->firstname = $infos['firstname'] ?? '';
        $this->lastname = $infos['lastname'] ?? '';
        $this->birthday = $infos['birthday'] ?? '';
        $this->adress = $infos['adress'] ?? '';
        $this->zipcode = isset($infos['zipcode']) ? trim($infos['zipcode']) : '';
        $this->town = $infos['town'] ?? '';

        if (!empty($infos['password'])) {
            $this->password = password_hash($infos['password'], PASSWORD_DEFAULT);
        } elseif (!$mis_a_jour) {
            throw new Exception("Mot de passe obligatoire");
        }

        if (!empty($infos['username'])) {
            $this->username = $infos['username'];
        } elseif (!$mis_a_jour) {
            throw new Exception("Username obligatoire");
        }
    }

    public function __construct(PDO $db, array $infos = []) {
        $this->db = $db;
        if (!empty($infos)) {
            $this->hydrate($infos);
        }
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function create(){
        $this->validate();
        try {
            $this->db->beginTransaction();

            $sql1 = "INSERT INTO mp_users (username, password, firstname, lastname, admin)
                    VALUES (:username, :password, :firstname, :lastname, 0)";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute([
                ':username' => $this->username,
                ':password' => $this->password,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname
            ]);
            $this->fk_user = $this->db->lastInsertId();

            $sql2 = "INSERT INTO mp_enseignants (firstname, lastname, birthday, adress, zipcode, town, fk_user)
                    VALUES (:firstname, :lastname, :birthday, :adress, :zipcode, :town, :fk_user)";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->execute([
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':birthday' => $this->birthday,
                ':adress' => $this->adress,
                ':zipcode' => $this->zipcode,
                ':town' => $this->town,
                ':fk_user' => $this->fk_user,
            ]);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e; 
        }
    }

    public function fetch($id) {
        $stmt = $this->db->prepare("SELECT * FROM mp_enseignants WHERE rowid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetch_user($id) {
        $stmt = $this->db->prepare("SELECT * FROM mp_users WHERE rowid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll() {
        $sql = "SELECT * FROM mp_enseignants";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $this->validate2();
        $sql2 = "UPDATE mp_enseignants SET
                    firstname = :firstname,
                    lastname = :lastname,
                    birthday = :birthday,
                    adress = :adress,
                    zipcode = :zipcode,
                    town = :town,
                    fk_user = :fk_user
                WHERE rowid = :rowid"; 

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bindValue(':firstname', $this->firstname);
        $stmt2->bindValue(':lastname', $this->lastname);
        $stmt2->bindValue(':birthday', $this->birthday);
        $stmt2->bindValue(':adress', $this->adress);
        $stmt2->bindValue(':zipcode', $this->zipcode);
        $stmt2->bindValue(':town', $this->town);
        $stmt2->bindValue(':fk_user', $this->fk_user);
        $stmt2->bindValue(':rowid', $this->rowid, PDO::PARAM_INT);
        $stmt2->execute();
    }

    public function delete() {
        if ($this->rowid === null) {
            throw new Exception("L'identifiant de l'enseignant est requis pour la suppression.");
        }

        $stmt = $this->db->prepare("SELECT fk_user FROM mp_enseignants WHERE rowid = :rowid");
        $stmt->bindValue(':rowid', $this->rowid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Enseignant non trouvé.");
        }

        $fk_user = $result['fk_user'];

        $stmtDelEtudiant = $this->db->prepare("DELETE FROM mp_enseignants WHERE rowid = :rowid");
        $stmtDelEtudiant->bindValue(':rowid', $this->rowid, PDO::PARAM_INT);
        $stmtDelEtudiant->execute();

        $stmtDelUser = $this->db->prepare("DELETE FROM mp_users WHERE rowid = :fk_user");
        $stmtDelUser->bindValue(':fk_user', $fk_user, PDO::PARAM_INT);
        $stmtDelUser->execute();
    }

    public function find(array $filters = []): array {
        $sql = "SELECT * FROM mp_enseignants WHERE 1=1";
        $params = [];

        if (!empty($filters['firstname'])) {
            $sql .= " AND firstname LIKE :firstname";
            $params[':firstname'] = "%" . $filters['firstname'] . "%";
        }

        if (!empty($filters['lastname'])) {
            $sql .= " AND lastname LIKE :lastname";
            $params[':lastname'] = "%" . $filters['lastname'] . "%";
        }

        if (!empty($filters['birthday'])) {
            $sql .= " AND birthday = :birthday";
            $params[':birthday'] = $filters['birthday'];
        }

        if (!empty($filters['adress'])) {
            $sql .= " AND adress LIKE :adress";
            $params[':adress'] = "%" . $filters['adress'] . "%";
        }

        if (!empty($filters['zipcode'])) {
            $sql .= " AND zipcode LIKE :zipcode";
            $params[':zipcode'] = "%" . $filters['zipcode'] . "%";
        }

        if (!empty($filters['town'])) {
            $sql .= " AND town LIKE :town";
            $params[':town'] = "%" . $filters['town'] . "%";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validate(): void {
        $requiredFields = [
            'firstname', 'lastname', 'birthday',
            'adress', 'zipcode', 'town',
            'username', 'password'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($this->$field) || $this->$field === '' || $this->$field === null) {
                throw new Exception("Le champ '$field' est obligatoire et ne peut pas être vide.");
            }

            if ($field === 'year') {
                if (!is_numeric($this->$field) || (int)$this->$field <= 0) {
                    throw new Exception("Le champ '$field' doit être un entier positif.");
                }
            }
        }
    }

    public function validate2(): void {
        $requiredFields = [
            'firstname', 'lastname', 'birthday',
            'adress', 'zipcode', 'town',
        ];

        foreach ($requiredFields as $field) {
            if (!isset($this->$field) || $this->$field === '' || $this->$field === null) {
                throw new Exception("Le champ '$field' est obligatoire et ne peut pas être vide.");
            }

            if ($field === 'year') {
                if (!is_numeric($this->$field) || (int)$this->$field <= 0) {
                    throw new Exception("Le champ '$field' doit être un entier positif.");
                }
            }
        }
    }
}
