<?php
class Matiere {

    private ?int $matid;
    private ?string $matnom;
    private ?int $matcoeff;
    private ?int $fk_modules;
    private $db;

    public function hydrate(array $infos, bool $mis_a_jour = false){
        $this->matid = isset($infos['matid']) ? (int)$infos['matid'] : null;
        $this->matnom = $infos['matnom'] ?? '';
        $this->matcoeff = isset($infos['matcoeff']) ? (int) trim($infos['matcoeff']) : null;
        $this->fk_modules = isset($_POST['fk_modules']) ? (int)$_POST['fk_modules'] : null;
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
            $sql2 = "INSERT INTO mp_matieres (matnom, matcoeff, fk_modules)
                    VALUES (:matnom, :matcoeff, :fk_modules)";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->execute([
                ':matnom' => $this->matnom,
                ':matcoeff' => $this->matcoeff,
                ':fk_modules' => $this->fk_modules,
            ]);
        } catch (Exception $e) {
            throw $e; 
        }
    }


    public function fetch($id) {
        $stmt = $this->db->prepare("SELECT * FROM mp_matieres WHERE matid = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchModulesList(): array {
        $stmt = $this->db->query("SELECT modid, modnom FROM mp_modules");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }



    public function fetchAll() {
        $sql = "SELECT * FROM mp_matieres";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $this->validate();
        $sql2 = "UPDATE mp_matieres SET
                    matnom = :matnom,
                    matcoeff = :matcoeff,
                    fk_modules = :fk_modules
                WHERE matid = :matid"; 

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bindValue(':matnom', $this->matnom);
        $stmt2->bindValue(':matcoeff', $this->matcoeff);
        $stmt2->bindValue(':fk_modules', $this->fk_modules);
        $stmt2->bindValue(':matid', $this->matid, PDO::PARAM_INT);
        $stmt2->execute();
    }

    public function delete() {
        if ($this->matid === null) {
            throw new Exception("L'identifiant de la matière est requis pour la suppression.");
        }

        $stmtDelMatiere = $this->db->prepare("DELETE FROM mp_matieres WHERE matid = :matid");
        $stmtDelMatiere->bindValue(':matid', $this->matid, PDO::PARAM_INT);
        $stmtDelMatiere->execute();
    }

    public function find(array $filters = []): array {
        $sql = "SELECT * FROM mp_matieres WHERE 1=1";
        $params = [];

        if (!empty($filters['matnom'])) {
            $sql .= " AND matnom LIKE :matnom";
            $params[':matnom'] = "%" . $filters['matnom'] . "%";
        }

        if (!empty($filters['matcoeff'])) {
            $sql .= " AND matcoeff LIKE :matcoeff";
            $params[':matcoeff'] = "%" . $filters['matcoeff'] . "%";
        }

        if (!empty($filters['fk_modules'])) {
            $sql .= " AND fk_modules = :fk_modules";
            $params[':fk_modules'] = $filters['fk_modules'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validate(): void {
        $requiredFields = [
            'matnom', 'matcoeff'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($this->$field) || $this->$field === '' || $this->$field === null) {
                throw new Exception("Le champ '$field' est obligatoire et ne peut pas être vide.");
            }

            if ($field === 'matcoeff') {
                if (!is_numeric($this->$field) || (int)$this->$field <= 0) {
                    throw new Exception("Le champ '$field' doit être un entier positif.");
                }
            }
        }
    }
}
