<?php

class Router{
    protected $hompe_page;
    protected $template;
    protected $query;

    function __construct($home_page, $template, $query){
        $this->home_page=$home_page;
        $this->template=$template;
        $this->query=$query;
    }
   
    public function getTemplate(){
        
            if(isset($_GET[$this->query]) && in_array($_GET[$this->query], $this->template, true)){
                include 'Controllers/'.$_GET[$this->query].".php";
        
            }else{
                include 'Controllers/'.$this->home_page.".php";
            }   
                 
   }
}