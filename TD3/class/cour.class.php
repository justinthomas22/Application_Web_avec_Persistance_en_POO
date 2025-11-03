<?php
class Cour {

    private ?int $cour_id;
    private ?string $dates;
    private ?string $heure_deb;
    private ?string $heure_fin;
    private ?int $promo;
    private ?string $cour_td;
    private ?string $cour_tp;
    private ?int $fk_enseignant = null;
    private ?int $fk_matiere = null;
    private $db;

    public function hydrate(array $infos, bool $mis_a_jour = false){
        $this->cour_id = isset($infos['cour_id']) ? (int)$infos['cour_id'] : null;

        $this->dates = isset($infos['dates']) && $infos['dates'] !== '' 
            ? $infos['dates'] 
            : null;

        $this->heure_deb = $infos['heure_deb'] ?? null;
        $this->heure_fin = $infos['heure_fin'] ?? null;
        $this->promo = !empty($infos['promo']) ? (int)$infos['promo'] : null;


        $this->cour_td = $infos['cour_td'] ?? null;
        $this->cour_tp = $infos['cour_tp'] ?? null;
        $this->fk_enseignant = !empty($infos['fk_enseignant']) ? (int)$infos['fk_enseignant'] : null;
        $this->fk_matiere = !empty($infos['fk_matiere']) ? (int)$infos['fk_matiere'] : null;
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
            $sql1 = "INSERT INTO mp_cours (dates, heure_deb, heure_fin, promo, cour_td, cour_tp, fk_enseignant, fk_matiere)
                    VALUES (:dates, :heure_deb, :heure_fin, :promo, :cour_td, :cour_tp, :fk_enseignant, :fk_matiere)";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute([
                ':dates' => $this->dates,
                ':heure_deb' => $this->heure_deb,
                ':heure_fin' => $this->heure_fin,
                ':promo' => $this->promo,
                ':cour_td' => $this->cour_td,
                ':cour_tp' => $this->cour_tp,
                ':fk_enseignant' => $this->fk_enseignant,
                ':fk_matiere' => $this->fk_matiere,
            ]);

        } catch (Exception $e) {
            throw $e; 
        }
    }

    public function fetch($id) {
        $stmt = $this->db->prepare("SELECT * FROM mp_cours WHERE cour_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchEnseignantList(): array {
        $stmt = $this->db->query("SELECT rowid, firstname, lastname FROM mp_enseignants");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function fetchMatiereList(): array {
        $stmt = $this->db->query("SELECT matid, matnom FROM mp_matieres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function fetchAll() {
        $sql = "SELECT * FROM mp_cours";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $this->validate();
        $sql2 = "UPDATE mp_cours SET
                    dates = :dates,
                    heure_deb = :heure_deb,
                    heure_fin = :heure_fin,
                    promo = :promo,
                    cour_td = :cour_td,
                    cour_tp = :cour_tp,
                    fk_enseignant = :fk_enseignant,
                    fk_matiere = :fk_matiere
                WHERE cour_id = :cour_id"; 

        $stmt2 = $this->db->prepare($sql2);
        $stmt2->bindValue(':dates', $this->dates);
        $stmt2->bindValue(':heure_deb', $this->heure_deb);
        $stmt2->bindValue(':heure_fin', $this->heure_fin);
        $stmt2->bindValue(':promo', $this->promo);
        $stmt2->bindValue(':cour_td', $this->cour_td);
        $stmt2->bindValue(':cour_tp', $this->cour_tp);
        $stmt2->bindValue(':fk_enseignant', $this->fk_enseignant);
        $stmt2->bindValue(':fk_matiere', $this->fk_matiere);
        $stmt2->bindValue(':cour_id', $this->cour_id, PDO::PARAM_INT);
        $stmt2->execute();
    }

    public function delete() {
        if ($this->cour_id === null) {
            throw new Exception("L'identifiant du cour est requis pour la suppression.");
        }

        $stmtDelCour = $this->db->prepare("DELETE FROM mp_cours WHERE cour_id = :cour_id");
        $stmtDelCour->bindValue(':cour_id', $this->cour_id, PDO::PARAM_INT);
        $stmtDelCour->execute();

    }

    public function find(array $filters = []): array {
        $sql = "SELECT * FROM mp_cours WHERE 1=1";
        $params = [];

        if (!empty($filters['dates'])) {
            $sql .= " AND dates LIKE :dates";
            $params[':dates'] = "%" . $filters['dates'] . "%";
        }

        if (!empty($filters['heure_deb'])) {
            $sql .= " AND heure_deb LIKE :heure_deb";
            $params[':heure_deb'] = "%" . $filters['heure_deb'] . "%";
        }   

        if (!empty($filters['heure_fin'])) {
            $sql .= " AND heure_fin LIKE :heure_fin";
            $params[':heure_fin'] = "%" . $filters['heure_fin'] . "%";
        }

        if (!empty($filters['promo'])) {
            $sql .= " AND promo LIKE :promo";
            $params[':promo'] = "%" . $filters['promo'] . "%";
        }

        if (!empty($filters['cour_td'])) {
            $sql .= " AND cour_td LIKE :cour_td";
            $params[':cour_td'] = "%" . $filters['cour_td'] . "%";
        }

        if (!empty($filters['cour_tp'])) {
            $sql .= " AND cour_tp LIKE :cour_tp";
            $params[':cour_tp'] = "%" . $filters['cour_tp'] . "%";
        }

         if (!empty($filters['fk_enseignant'])) {
            $sql .= " AND fk_enseignant = :fk_enseignant";
            $params[':fk_enseignant'] = $filters['fk_enseignant'];
        }

        if (!empty($filters['fk_matiere'])) {
            $sql .= " AND fk_matiere = :fk_matiere";
            $params[':fk_matiere'] = $filters['fk_matiere'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validate(): void {
        $requiredFields = [
            'dates', 'heure_deb', 'heure_fin', 
            'promo', 'fk_enseignant', 'fk_matiere'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($this->$field) || $this->$field === '' || $this->$field === null) {
                throw new Exception("Le champ '$field' est obligatoire et ne peut pas être vide.");
            }
        }

        // Validation de la hiérarchie : si TP rempli, TD doit l'être aussi
        $hasTP = isset($this->cour_tp) && $this->cour_tp !== '' && $this->cour_tp !== null;
        $hasTD = isset($this->cour_td) && $this->cour_td !== '' && $this->cour_td !== null;

        if ($hasTP && !$hasTD) {
            throw new Exception("Si vous remplissez le champ 'cour_tp', vous devez également remplir 'cour_td'.");
        }
    }
}
