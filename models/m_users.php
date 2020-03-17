<?php 
    include_once 'connexion.php';
    
    class User 
    {
        private $db;
        
        public function __construct() 
        {
            $this->db = connexion();
        }
        
        public function user_details($id)
        {
            $requete = 'SELECT * FROM user WHERE user_id =:user_id';
            $result = $this->db->prepare($requete);
            $result->bindValue(':user_id', $id);
            $result->execute();
            $row = $result->fetch();
            $result->closeCursor();
            
            return $row;
        }
        
        public function user_infos($login)
        {
            $requete = 'SELECT * FROM user JOIN role ON user.user_role_id = role.role_id WHERE user_nk_name =:login OR user_email =:login';
            $result = $this->db->prepare($requete);
            $result->bindValue(':login', $login);
            $result->execute();
            $row = $result->fetch();
            $result->closeCursor();
            
            return $row;
        }
        
        public function user_by_var($var_table, $var_user)
        {
            $requete = "SELECT user_id FROM user WHERE $var_table =:variable";
            $result = $this->db->prepare($requete);
            $result->bindValue(':variable', $var_user);
            $result->execute();
            $row = $result->fetchAll();
            $result->closeCursor();
            
            return $row;
        }
        
        public function new_user($array)
        {
            $requete = 'INSERT INTO user(user_name, user_fst_name, user_nk_name, user_email, user_pwd, user_role_id, user_confirm, user_key) VALUE (:name, :first_name, :nickname, :mail, :pwd, 2, false, :key)';
            
            $result = $this->db->prepare($requete);
            $result->execute($array);
            $result->closeCursor();
        }
        
        public function selct_verif_user($id)
        {
            $requete = 'SELECT user_id, user_key, user_confirm FROM user WHERE user_nk_name =:pseudo';
            $result = $this->db->prepare($requete);
            $result->bindValue(':pseudo', $id);
            $result->execute();
            $row = $result->fetch();
            $result->closeCursor();
            
            return $row;
        }
        
        public function verif_user($id)
        {
            $requete = 'UPDATE user SET user_confirm = true WHERE user_id =:user_id';
            $result = $this->db->prepare($requete);
            $result->bindValue(':user_id', $id);
            $result->execute();
            $result->closeCursor();
        }
        
        public function select_key($id)
        {
            $requete = 'SELECT user_key FROM user WHERE user_id =:user';
            $result = $this->db->prepare($requete);
            $result->bindValue(':user', $id);
            $result->execute();
            $row = $result->fetch();
            $result->closeCursor();
            
            return $row->user_key;
        }
        
        public function change_key($id, $key)
        {
            $requete = 'UPDATE `user` SET user_key =:key WHERE user_nk_name =:id OR user_email =:id';
            $result = $this->db->prepare($requete);
            $result->bindValue(':key', $key);
            $result->bindValue(':id', $id);
            $result->execute();
            $result->closeCursor();
        }
        
        public function change_pwd_user($array)
        {
            $requete = 'UPDATE `user` SET user_pwd =:pwd WHERE user_id =:id';
            $result = $this->db->prepare($requete);
            $result->execute($array);
            $result->closeCursor();
        }
        
        public function delete_user($id)
        {
            $requete = 'DELETE FROM user WHERE user_id =:user';
            $result = $this->db->prepare($requete);
            $result->bindValue(':user', $id);
            $result->execute();
            $result->closeCursor();
        }


        public function __destruct()
        {
            $this->db = null;
        }
    }
?>
