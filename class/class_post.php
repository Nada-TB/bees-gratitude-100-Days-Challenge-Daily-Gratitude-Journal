<?php
class Post{
    protected $post;
    public $id_user;
    
    function __construct($post, $id_user){
        $this->connexion= new Connexion("localhost","bees-gratitude","postgres","");
        $this->post=$post;
        $this->id_user=intval($id_user);
    }

    public function verify(){
      $data = trim($this->post);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
    }

    public function add_post($query_insert){
        $post=$this->verify($this->post);
        $values=array(
            $post,
            $this->id_user   
        );

        $this->connexion->change_data_database($query_insert, $values);

    }

    public function get_all_posts($query_get){
        return $this->connexion->get_all_data($query_get, [$this->id_user]);
    }

    public function get_post($query_get, $id){
        $values=array(
            intval($id),
            $this->id_user
        );

        return $this->connexion->get_data($query_get,$values);
    }

    public function delete_post($query, $condition){
        $this->connexion->change_data_database($query, [$condition]);
    }

}