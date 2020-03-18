<?php 
    include_once 'connexion.php';
    
    class Artist 
    {
        private $db;
        
        public function __construct() 
        {
            $this->db = connexion();
        }
        
        // Infos sur un artiste 
        public function infos_artist($artist_id)
        {
            $requete = 'SELECT * FROM artist WHERE artist_id=:artist';
            $result = $this->db->prepare($requete);
            $result->bindValue(':artist', $artist_id);
            $result->execute();
            $row_artist = $result->fetch();
            $result->closeCursor();

            return $row_artist;
        }
        
        // Liste des artistes par ordre alphabétique
        public function details_artist()
        {
            // Selection de la table artist à retourner 
            $requete = 'SELECT * FROM artist ORDER BY artist_name';
            $result = $this->db->prepare($requete);
            $result->execute();
            $table_artist = $result->fetchAll();
            $result->closeCursor();
            
            return $table_artist;
        }
        
        // Ajout d'un artiste
        public function add_artist($name)
        {
            $requete = "INSERT INTO artist(artist_name) VALUE (:name)";
            $result = $this->db->prepare($requete);
            $result->bindValue(':name', $name);
            $result->execute();
            $result->closeCursor();
        }

        /* Suppréssion d'un artiste en commencant par ses disques 
         Mise en transaction pour s'assurer du déroulement sur les 2 tables */
        public function del_artist($artist_id)
        {
            try 
            {
                // Start trabsaction 
                $this->db->beginTransaction();

                // Suppression des CD-ROM de l'artiste
                $requete_cd = 'DELETE FROM disc WHERE artist_id =:idArtist';
                $result_cd = $this->db->prepare($requete_cd);
                $result_cd->bindValue(':idArtist', $artist_id);
                $result_cd->execute();
                $result_cd->closeCursor();

                // Suppression de l'artiste 
                $requete_artist = 'DELETE FROM artist WHERE artist_id=:idArtist';
                $result_artist = $this->db->prepare($requete_artist);
                $result_artist->bindValue(':idArtist', $artist_id);
                $result_artist->execute();
                $result_artist->closeCursor();

                // Commit si pas d'erreur avant (Donc pas d'exception)
                $this->db->commit();
            }
            catch (Exception $e)
            {
                // Si exception alors RollBack
                $this->db->rollback();
                echo 'Artiste non supprimé : '.$e->getMessage();
            }
        }

        
        public function __destruct()
        {
            $this->db = null;
        }
    }
?>
