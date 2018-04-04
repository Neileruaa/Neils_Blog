<?php
  /**
   * On va creer une classe pour avoir acces aux bases de données !
   * J'utilise de la POO
   */
    class DB{
    private $host = 'localhost';
    private $username = 'root'; //root //id4203946_aurebapt
    private $password = 'titi0301'; //titi2020 //aurebapt
    private $database = 'Blog'; //myblog //id4203946_geekhub
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null){
            if($host != null){
                $this->host = $host;
                $this->username = $username;
                $this->password = $password;
                $this->database = $database;
            }
            try {
                $this->db = new PDO('mysql:host='.$this->host.
                ';dbname='.$this->database,
                $this->username,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                      PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
                    //   j'affiche les erreurs de SQL pour pouvoir debugger
            } catch (PDOException $e) {
                die('Il est impossible de se connecter
                dans cette base de donnée avec ces identifiants');
            }
        }
    public function requete($sql, $data=array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchALL(PDO::FETCH_OBJ);
        //avoir les resultats sous forme d'objet !
    }
    }
?>
