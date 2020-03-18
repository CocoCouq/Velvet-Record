<?php 
    include_once 'connexion.php';
    
    class Admin
    {
        private $db;
        
        public function __construct() 
        {
            $this->db = connexion();
        }

        // Selection des users (Utilisateurs puis Administrateurs) par ordre de date d'inscription
        public function select_all_users()
        {
            $requete = 'SELECT * FROM user JOIN role ON user_role_id = role_id ORDER BY user_role_id DESC, user_id DESC';
            $result = $this->db->prepare($requete);
            $result->execute();
            $table = $result->fetchAll();
            $result->closeCursor();
            
            return $table;
        }
        
        // Count des utilisateurs selon leur role 
        public function count_users($role)
        {
            $requete = 'SELECT user_id FROM user WHERE user_role_id = '.$role;
            $result = $this->db->prepare($requete);
            $result->execute();
            $tab = $result->fetchAll();
            $result->closeCursor();
            
            return count($tab);
        }
        
        // Suppression d'un ulisateur
        public function delete_user($id)
        {
            $requete = 'DELETE FROM user WHERE user_nk_name =:input OR user_email =:input';
            $result = $this->db->prepare($requete);
            $result->bindValue(':input', $id);
            $result->execute();
            $result->closeCursor();
        }
        
        // Validation email utilisateurs
        public function valid_user($id)
        {
            $requete = 'UPDATE user SET user_confirm = true WHERE user_nk_name =:input OR user_email =:input';
            $result = $this->db->prepare($requete);
            $result->bindValue(':input', $id);
            $result->execute();
            $result->closeCursor();
        }

        // Passage d'un utilisateur en Admin 
        public function upgrade_admin($id)
        {
            $requete = 'UPDATE user SET user_role_id = 1 WHERE user_nk_name =:input OR user_email =:input';
            $result = $this->db->prepare($requete);
            $result->bindValue(':input', $id);
            $result->execute();
            $result->closeCursor();
        }

        public function __destruct()
        {
            $this->db = null;
        }
    }
?>

