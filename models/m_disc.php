<?php 
    include_once 'connexion.php';
    
    class Disc 
    {
        private $db;
        
        public function __construct() 
        {
            $this->db = connexion();
        }
        
        public function disc_details()
        {
            $requete = 'SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id';
            $result = $this->db->query($requete);
            $table = $result->fetchAll();
            $result->closeCursor();
            
            return $table;
        }
        
        public function disc_artist($id)
        {
            // Je reccupère simplement la table disc
            $requete = 'SELECT * FROM disc WHERE artist_id = :artist';
            $result = $this->db->prepare($requete);
            $result->bindValue(':artist', $id);
            $result->execute();
            $table = $result->fetchAll();
            $result->closeCursor();
            
            return $table;
        }

        public function disc_infos($id)
        {
            $requete = 'SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc_id =:disc';
            $result = $this->db->prepare($requete);
            $result->bindValue(':disc', $id);
            $result->execute();
            $row = $result->fetch();
            $result->closeCursor();
            
            return $row;
        }
        
        public function disc_last()
        {
            $requete = 'SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id ORDER BY disc_id DESC LIMIT 3';
            $result = $this->db->prepare($requete);
            $result->execute();
            $table = $result->fetchAll();
            $result->closeCursor();
            
            return $table;
        }


        public function del_disc($id)
        {
            $requete = 'DELETE FROM disc WHERE disc_id =:id_disc';
            $result = $this->db->prepare($requete);
            $result->bindValue(':id_disc', $id);
            $result->execute();
            $result->closeCursor();
        }
        
        public function update_pict($id, $destination, $name)
        {
            // Mise en transaction pour s'assurer des l'upload avant le changement de nom 
            try
            {
                // START TRANSACTION 
                $this->db->beginTransaction();

                // Alors Upload du fichier 
                move_uploaded_file($_FILES['imagePochette']['tmp_name'], $destination); 

                // Changement du nom dans la base de donnée
                $requete = 'UPDATE disc SET disc_picture =:nom_picture WHERE disc_id=:idDisc';
                $result = $this->db->prepare($requete);
                $result->bindValue(':nom_picture', $name);
                $result->bindValue(':idDisc', $id);
                $result->execute();
                $result->closeCursor();

                // Affichage du résultat ?>
                <h1 class="center-align flow-text">Téléchargement réussi</h1>
                <h2 class="center-align"><?= $name ?></h2>
                <p class="center-align">Nouvelle pochette :</p>
                <div class="center-align"><img src="../../assets/img/<?= $name ?>" alt="Nouvelle image"></div><?php

                // Commit 
                $this->db->commit();
                clearstatcache();
                header('Refresh: 3; URL=vue_cd.php');
            }
            catch (Exception $e)
            {
                // RollBack
                $this->db->rollback();
                echo 'Erreur pendant le chargemnt de la photo : '.$e->getMessage();
            }
        }
        
        public function up_disc($array)
        {
            $requete = 'UPDATE disc SET disc_title =:titre, disc_label=:label, disc_genre=:genre, disc_year=:annee, disc_price=:prix, artist_id=:artist WHERE disc_id =:idDisc';

            $result = $this->db->prepare($requete);
            $result->execute($array);
            $result->closeCursor();
        }

        public function add_disc($array, $destination_pict)
        {
            try
            {
                // START TRANSACTION 
                $this->db->beginTransaction();

                // Alors Upload du fichier 
                move_uploaded_file($_FILES['imagePochette']['tmp_name'], $destination_pict); 

                // Insertion des valeurs dans la table
                $requete = 'INSERT INTO disc(disc_title, disc_label, disc_genre, disc_year, disc_price, artist_id, disc_picture) VALUE (:titre, :label, :genre, :annee, :prix, :artist, :picture)';
                $result = $this->db->prepare($requete);
                $result->execute($array);
                $result->closeCursor();

                // Commit 
                $this->db->commit();
                clearstatcache();
            }
            catch (Exception $e)
            {
                // RollBack
                $this->db->rollback();
                echo 'Erreur pendant le chargement du formulaire : '.$e->getMessage();
            }
        }

        public function __destruct()
        {
            $this->db = null;
        }
    }
?>