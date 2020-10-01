<?php

class Connexion{
    protected $host;
    protected $dbname;
    protected $user;
    private $password;

    function __construct($host,$dbname,$user,$password){
        $this->host=$host;
        $this->dbname=$dbname;
        $this->user=$user;
        $this->password=$password;
        $this->connexion=new PDO('pgsql:host='.$this->host.';port= 5432 ; dbname='.$this->dbname, $this->user, $this->password);
    }
    
    public function create_connexion(){
        try{
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return 'success';
        }catch(PDOException $e){
            return 'failed';
        }   
    }

    protected function define_condition($response, $condition){
        if($condition !==null){
            return $response->execute($condition);
        }else{
            return $response->execute();
        }
           
    }
    
    // changes: update, insert, delete
    public function change_data_database($query, $data){
        $response=$this->connexion->prepare($query);
        $response->execute($data);
    }

   public function get_all_data($query,$condition){
        $get_data=$this->connexion->prepare($query);
        //$get_data->execute($condition);
        $this->define_condition($get_data, $condition);
        $data=$get_data->fetchAll(PDO::FETCH_ASSOC); 
        return $data;
   }

   public function get_data($query, $condition){
        $get_data=$this->connexion->prepare($query);
        //$get_data->execute($condition);
        $this->define_condition($get_data, $condition);
        $data=$get_data->fetch(PDO::FETCH_ASSOC);
        return $data;
   }

}