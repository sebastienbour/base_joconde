<?php
class Nombre {
    private $nombre;
    private $db;

    public function __construct($nombre){
        $this->nombre=$nombre;
        $this->db = require "config/database.php";
    }

    public function getOeuvres(){
        switch($this){
            case $this->baseMySQLPleine() : 
            try {
                $query = "DELETE FROM Oeuvres";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
        
                $query_reset = "ALTER TABLE Oeuvres AUTO_INCREMENT = 1";
                $stmt_reset = $this->db->prepare($query_reset);
                $stmt_reset->execute();
                
            }
            catch (PDOException $e) {
                die("Erreur lors de la suppression des données : " . $e->getMessage());
            }
            case $this->baseMySQLVide() : 
            $url="https://data.culture.gouv.fr/api/explore/v2.1/catalog/datasets/base-joconde-extrait/records?limit=20&offset=$this->nombre";
            $response=file_get_contents($url);

            $oeuvresjson=json_decode($response, true);

            $this->saveOeuvres($oeuvresjson);
        }

        try {
            $query = "SELECT * FROM Oeuvres ORDER BY ref ASC";
            $stmt = $this->db->query($query);

            $oeuvres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $oeuvres;
        }
        catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }

    public function baseMySQLPleine(){
        try {
            $query = "SELECT COUNT(*) FROM Oeuvres";
            $stmt = $this->db->query($query);

            $count = $stmt->fetchColumn();

            if ($count < 0) {
                return false;
            } else {
               return true;
            }
        }
        catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }

    protected function baseMySQLVide(){
        try {
            $query = "SELECT COUNT(*) FROM Oeuvres";
            $stmt = $this->db->query($query);

            $count = $stmt->fetchColumn();

            if ($count > 0) {
                return false;
            } else {
               return true;
            }
        }
        catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }

    public function saveOeuvres($oeuvres) {
        foreach ($oeuvres['results'] as $oeuvre) {
            $ref = $oeuvre['reference'];
            $auteur = ($oeuvre['auteur'] ?? 'Non renseigné');
            $commentaires = (strlen($oeuvre['commentaires']) > 1000) ? substr($oeuvre['commentaires'], 0, 1000) : ($oeuvre['commentaires'] ?? 'Non renseigné');
            $ancienneAppartenance = (strlen($oeuvre['ancienne_appartenance']) > 1000) ? substr($oeuvre['ancienne_appartenance'], 0, 1000) : ($oeuvre['ancienne_appartenance'] ?? 'Non renseigné');
            $dateAcquisition = ($oeuvre['date_d_acquisition'] ?? 'Non renseigné');
            $decouverteCollecte = ($oeuvre['decouverte_collecte'] ?? 'Non renseigné');
            $denomination = ($oeuvre['denomination'] ?? 'Non renseigné');
            $lieuDepot = ($oeuvre['lieu_de_depot'] ?? 'Non renseigné');
            $description = (strlen($oeuvre['description']) > 1000) ? substr($oeuvre['description'], 0, 1000) : ($oeuvre['description'] ?? 'Non renseigné');
            $mesures = ($oeuvre['mesures'] ?? 'Non renseigné');
            $domaine = (is_array($oeuvre['domaine']) ? implode(', ', $oeuvre['domaine']) : ($oeuvre['domaine'] ?? 'Non renseigné'));
            $dateMAJ = ($oeuvre['date_de_mise_a_jour'] ?? 'Non renseigné');
            $dateCreation = ($oeuvre['date_creation'] ?? 'Non renseigné');
            $region = ($oeuvre['region'] ?? 'Non renseigné');
            $departement = ($oeuvre['departement'] ?? 'Non renseigné');
            $dateSujetRep = ($oeuvre['date_sujet_represente'] ?? 'Non renseigné');
            $epoque = ($oeuvre['epoque'] ?? 'Non renseigné');
            $localisation = ($oeuvre['localisation'] ?? 'Non renseigné');
            $ville = ($oeuvre['ville'] ?? 'Non renseigné');
            $codeMuseofile = ($oeuvre['code_museofile'] ?? 'Non renseigné');
            $nomOfficielMusee = ($oeuvre['nom_officiel_musee'] ?? 'Non renseigné');
            $precisionsAuteur = (strlen($oeuvre['precisions_sur_l_auteur']) > 1000) ? substr($oeuvre['precisions_sur_l_auteur'], 0, 1000) : ($oeuvre['precisions_sur_l_auteur'] ?? 'Non renseigné');
            $precisionsInscriptions = (strlen($oeuvre['precisions_inscriptions']) > 1000) ? substr($oeuvre['precisions_inscriptions'], 0, 1000) : ($oeuvre['precisions_inscriptions'] ?? 'Non renseigné');
            $precisionsSujetsRep = (strlen($oeuvre['precisions_sujets_representes']) > 1000) ? substr($oeuvre['precisions_sujets_representes'], 0, 1000) : ($oeuvre['precisions_sujets_representes'] ?? 'Non renseigné');
            $periodeCreation = ($oeuvre['periode_de_creation'] ?? 'Non renseigné');
            $periodeUtilisation = ($oeuvre['periode_d_utilisation'] ?? 'Non renseigné');
            $sujetRep = (strlen($oeuvre['sujet_represente']) > 1000) ? substr($oeuvre['sujet_represente'], 0, 1000) : ($oeuvre['sujet_represente'] ?? 'Non renseigné');
            $materiauxTechniques = (is_array($oeuvre['materiaux_techniques']) ? implode(', ', $oeuvre['materiaux_techniques']) : ($oeuvre['materiaux_techniques'] ?? 'Non renseigné'));
            $titre = ($oeuvre['titre'] ?? 'Non renseigné');
            $utilisation = ($oeuvre['utilisation'] ?? 'Non renseigné');
            $lienSiteAssocie = ($oeuvre['lien_site_associe'] ?? 'Non renseigné');
            $coordonnees = ($oeuvre['coordonnees']['lon'] ?? 'Non renseigné').', '.($oeuvre['coordonnees']['lat'] ?? 'Non renseigné');

            try {
                $sql = "INSERT INTO Oeuvres (ref, auteur, commentaires, ancienneAppartenance, dateAcquisition, decouverteCollecte, denomination, lieuDepot, description, mesures, domaine, dateMAJ, dateCreation, region, departement, dateSujetRep, epoque, localisation, ville, codeMuseofile, nomOfficielMusee, precisionsAuteur, precisionsInscriptions, precisionsSujetsRep, periodeCreation, periodeUtilisation, sujetRep, materiauxTechniques, titre, utilisation, lienSiteAssocie, coordonnees) 
                        VALUES (:ref, :auteur, :commentaires, :ancienneAppartenance, :dateAcquisition, :decouverteCollecte, :denomination, :lieuDepot, :description, :mesures, :domaine, :dateMAJ, :dateCreation, :region, :departement, :dateSujetRep, :epoque, :localisation, :ville, :codeMuseofile, :nomOfficielMusee, :precisionsAuteur, :precisionsInscriptions, :precisionsSujetsRep, :periodeCreation, :periodeUtilisation, :sujetRep, :materiauxTechniques, :titre, :utilisation, :lienSiteAssocie, :coordonnees)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['ref' => $ref, 'auteur' => $auteur, 'commentaires' => $commentaires, 'ancienneAppartenance' => $ancienneAppartenance, 'dateAcquisition' => $dateAcquisition, 'decouverteCollecte' => $decouverteCollecte, 'denomination' => $denomination, 'lieuDepot' => $lieuDepot, 'description' => $description, 'mesures' => $mesures, 'domaine' => $domaine, 'dateMAJ' => $dateMAJ, 'dateCreation' => $dateCreation, 'region' => $region, 'departement' => $departement, 'dateSujetRep' => $dateSujetRep, 'epoque' => $epoque, 'localisation' => $localisation, 'ville' => $ville, 'codeMuseofile' => $codeMuseofile, 'nomOfficielMusee' => $nomOfficielMusee, 'precisionsAuteur' => $precisionsAuteur, 'precisionsInscriptions' => $precisionsInscriptions, 'precisionsSujetsRep' => $precisionsSujetsRep, 'periodeCreation' => $periodeCreation, 'periodeUtilisation' => $periodeUtilisation, 'sujetRep' => $sujetRep, 'materiauxTechniques' => $materiauxTechniques, 'titre' => $titre, 'utilisation' => $utilisation, 'lienSiteAssocie' => $lienSiteAssocie, 'coordonnees' => $coordonnees]);
            }
            catch (PDOException $e) {
                die("Erreur lors de la requête SQL : " . $e->getMessage());
            }
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>