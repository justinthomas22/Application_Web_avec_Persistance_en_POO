<?php
class Etudiant {

    private $diplomas = array("BUT", "License Pro", "Master");

    private ?int $rowid;
    private ?string $numetu;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $birthday;
    private ?string $diploma;
    private ?int $year;
    private ?string $td;
    private ?string $tp;
    private ?string $adress;
    private ?string $zipcode;
    private ?string $town;
    private ?int $fk_user = null;
    private ?string $password;
    private ?string $username;
    private $db;

    public function hydrate(array $infos, bool $mis_a_jour = false){
        $this->rowid = isset($infos['rowid']) ? (int)$infos['rowid'] : null;
        $this->numetu = isset($infos['numetu']) ? trim($infos['numetu']) : '';

        $this->firstname = $infos['firstname'] ?? '';
        $this->lastname = $infos['lastname'] ?? '';
        $this->birthday = $infos['birthday'] ?? '';
        $this->diploma = $infos['diploma'] ?? '';
        $this->year = isset($infos['year']) && $infos['year'] !== '' 
            ? (int)$infos['year'] 
            : null;

        $this->td = $infos['td'] ?? '';
        $this->tp = $infos['tp'] ?? '';
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

            $sql2 = "INSERT INTO mp_etudiants (numetu, firstname, lastname, birthday, diploma, year, td, tp, adress, zipcode, town, fk_user)
                    VALUES (:numetu, :firstname, :lastname, :birthday, :diploma, :year, :td, :tp, :adress, :zipcode, :town, :fk_user)";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->execute([
                ':numetu' => $this->numetu,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':birthday' => $this->birthday,
                ':diploma' => $this->diploma,
                ':year' => $this->year,
                ':td' => $this->td,
                ':tp' => $this->tp,
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
        $stmt = $this->db->prepare("SELECT * FROM mp_etudiants WHERE rowid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetch_user($id) {
        $stmt = $this->db->prepare("SELECT * FROM mp_users WHERE rowid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll() {
        $sql = "SELECT * FROM mp_etudiants";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $this->validate2();
        $sql2 = "UPDATE mp_etudiants SET
                    numetu = :numetu,
                    firstname = :firstname,
                    lastname = :lastname,
                    birthday = :birthday,
                    diploma = :diploma,
                    year = :year,
                    td = :td,
                    tp = :tp,
                    adress = :adress,
                    zipcode = :zipcode,
                    town = :town,
                    fk_user = :fk_user
                WHERE rowid = :rowid"; 

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bindValue(':numetu', $this->numetu);
        $stmt2->bindValue(':firstname', $this->firstname);
        $stmt2->bindValue(':lastname', $this->lastname);
        $stmt2->bindValue(':birthday', $this->birthday);
        $stmt2->bindValue(':diploma', $this->diploma);
        $stmt2->bindValue(':year', $this->year);
        $stmt2->bindValue(':td', $this->td);
        $stmt2->bindValue(':tp', $this->tp);
        $stmt2->bindValue(':adress', $this->adress);
        $stmt2->bindValue(':zipcode', $this->zipcode);
        $stmt2->bindValue(':town', $this->town);
        $stmt2->bindValue(':fk_user', $this->fk_user);
        $stmt2->bindValue(':rowid', $this->rowid, PDO::PARAM_INT);
        $stmt2->execute();
    }

    public function delete() {
        if ($this->rowid === null) {
            throw new Exception("L'identifiant de l'étudiant est requis pour la suppression.");
        }

        $stmt = $this->db->prepare("SELECT fk_user FROM mp_etudiants WHERE rowid = :rowid");
        $stmt->bindValue(':rowid', $this->rowid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Étudiant non trouvé.");
        }

        $fk_user = $result['fk_user'];

        $stmtDelEtudiant = $this->db->prepare("DELETE FROM mp_etudiants WHERE rowid = :rowid");
        $stmtDelEtudiant->bindValue(':rowid', $this->rowid, PDO::PARAM_INT);
        $stmtDelEtudiant->execute();

        $stmtDelUser = $this->db->prepare("DELETE FROM mp_users WHERE rowid = :fk_user");
        $stmtDelUser->bindValue(':fk_user', $fk_user, PDO::PARAM_INT);
        $stmtDelUser->execute();
    }

    public function find(array $filters = []): array {
        $sql = "SELECT * FROM mp_etudiants WHERE 1=1";
        $params = [];

        if (!empty($filters['numetu'])) {
            $sql .= " AND numetu LIKE :numetu";
            $params[':numetu'] = "%" . $filters['numetu'] . "%";
        }

        if (!empty($filters['lastname'])) {
            $sql .= " AND lastname LIKE :lastname";
            $params[':lastname'] = "%" . $filters['lastname'] . "%";
        }

        if (!empty($filters['firstname'])) {
            $sql .= " AND firstname LIKE :firstname";
            $params[':firstname'] = "%" . $filters['firstname'] . "%";
        }

        if (!empty($filters['diploma'])) {
            $sql .= " AND diploma = :diploma";
            $params[':diploma'] = $filters['diploma'];
        }

        if (!empty($filters['year'])) {
            $sql .= " AND year = :year";
            $params[':year'] = $filters['year'];
        }

        if (!empty($filters['td'])) {
            $sql .= " AND td = :td";
            $params[':td'] = $filters['td'];
        }

        if (!empty($filters['tp'])) {
            $sql .= " AND tp = :tp";
            $params[':tp'] = $filters['tp'];
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
            'numetu', 'firstname', 'lastname', 'birthday',
            'diploma', 'year', 'td', 'tp', 'adress', 'zipcode', 'town',
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
            'numetu', 'firstname', 'lastname', 'birthday',
            'diploma', 'year', 'td', 'tp', 'adress', 'zipcode', 'town'
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

    function getListeDiplome(): array {
        return ["BUT", "License Pro", "Master"];
    }

}
