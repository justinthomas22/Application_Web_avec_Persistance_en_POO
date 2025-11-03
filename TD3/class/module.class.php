<?php
class Module {

    private ?int $modid;
    private ?string $modnom;
    private ?int $modcoeff;
    private $db;

    public function hydrate(array $infos, bool $mis_a_jour = false){
        $this->modid = isset($infos['modid']) ? (int)$infos['modid'] : null;

        $this->modnom = $infos['modnom'] ?? '';
        $this->modcoeff = isset($infos['modcoeff']) && $infos['modcoeff'] !== '' 
            ? (int)$infos['modcoeff'] 
            : null;

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

    public function create() {
        $this->validate();

        try {
            $sql = "INSERT INTO mp_modules (modnom, modcoeff)
                    VALUES (:modnom, :modcoeff)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':modnom' => $this->modnom,
                ':modcoeff' => $this->modcoeff,
            ]);

            $this->modid = $this->db->lastInsertId();

            return $this->modid;

            $this->db->commit();

        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création du module : " . $e->getMessage());
        }
    }


    public function fetch($id) {
        $stmt = $this->db->prepare("SELECT * FROM mp_modules WHERE modid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll() {
        $sql = "SELECT * FROM mp_modules";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $this->validate();
        $sql2 = "UPDATE mp_modules SET
                    modnom = :modnom,
                    modcoeff = :modcoeff
                WHERE modid = :modid"; 

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bindValue(':modnom', $this->modnom);
        $stmt2->bindValue(':modcoeff', $this->modcoeff);
        $stmt2->bindValue(':modid', $this->modid, PDO::PARAM_INT);
        $stmt2->execute();
    }

    public function delete() {
        if ($this->modid === null) {
            throw new Exception("L'identifiant du module est requis pour la suppression.");
        }

        $stmtDelModule = $this->db->prepare("DELETE FROM mp_modules WHERE modid = :modid");
        $stmtDelModule->bindValue(':modid', $this->modid, PDO::PARAM_INT);
        $stmtDelModule->execute();
    }

    public function find(array $filters = []): array {
        $sql = "SELECT * FROM mp_modules WHERE 1=1";
        $params = [];

        if (!empty($filters['modnom'])) {
            $sql .= " AND modnom LIKE :modnom";
            $params[':modnom'] = "%" . $filters['modnom'] . "%";
        }

        if (!empty($filters['modcoeff'])) {
            $sql .= " AND modcoeff LIKE :modcoeff";
            $params[':modcoeff'] = "%" . $filters['modcoeff'] . "%";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validate(): void {
        $requiredFields = [
            'modnom', 'modcoeff',
        ];

        foreach ($requiredFields as $field) {
            if (!isset($this->$field) || $this->$field === '' || $this->$field === null) {
                throw new Exception("Le champ '$field' est obligatoire et ne peut pas être vide.");
            }

            if ($field === 'coeff') {
                if (!is_numeric($this->$field) || (int)$this->$field <= 0) {
                    throw new Exception("Le champ '$field' doit être un entier positif.");
                }
            }
        }
    }
}
