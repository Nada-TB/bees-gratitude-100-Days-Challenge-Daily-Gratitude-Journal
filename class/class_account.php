<?php

class Account{ 
    //get the form data in array key=>value
    protected $account_information; 
    // an array of regex to check data key=>value
    public $pattern;

    function __construct($account_information, $pattern){
        $this->account_information=$account_information;
        $this->pattern=$pattern;
        $this->connexion=new Connexion("localhost","bees-gratitude","postgres","");
    }
    
    public function verify_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function hash_password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    // for login
    public function check_password($password, $hash){
        return password_verify($password, $hash);
    }

    //verify if the given data matches the regex
    public function check_match($match, $value){
        if(preg_match($match, $value)==1){
            return 'true';
        }else{
            return 'false';
        }
    }

    // verify if all the items of a given array are equal to true
    public function check_all_values_equal($array){
        if (count(array_unique($array)) === 1 && end($array) === 'true'){
            return true;
        }else{
            return false;
        }
    }

    public function get_false_values($value){
        return ($value === 'false');
    }
    
    public function check_values(){
        $check=array(); //key=>value
        foreach($this->account_information as $key=>$value){
            if($key==="email"){
                //convert boolean to string;
                $response= $this->verify_email($value) ? 'true' : 'false'; 
                $check[$key]= $response;
                continue;
            }
            $check[$key]=$this->check_match($this->pattern[$key], $value);
        }
        return $check;
    }

    public function verify_email_exists( $query,$email){
         return $this->connexion->get_data($query, [$email]); 
    }

    public function send_errors_form(){
        $errors=array_filter($this->check_values(), function($value){
            return ($value === 'false');
        });
        $response=" those values are invalid: ";
        foreach ($errors as $key=>$value){
            $response.=$key.", ";
        }
        return $response;
    }

    public function create_session($query_get, $landing_page){
        $user=$this->connexion->get_data($query_get, [$this->account_information['email']]);
        header('P3P: CP="CAO PSA OUR"');
        session_start();
        $_SESSION['id']=$user['id_user'];
        $_SESSION['name']=$user['name'];
        $_SESSION['email']=$user['email'];
        $_SESSION['date_creation_account']=$user['date_creation_account'];
        $_SESSION['avatar']=$user['avatar'];
        $_SESSION['connected']='connected';
        $_SESSION['time']=time();
       /* header('location:'.$landing_page);
        exit();*/
    }

    public function create_account($query_insert, $query_get){
        $check=$this->check_values();
        if($this->check_all_values_equal($check)===true){
            //create account
            if($this->connexion->create_connexion()==='success'){
                $check_existence=$this->verify_email_exists($query_get, $this->account_information['email']);
                if(empty($check_existence)){
                    //hash password
                    $this->account_information['password']=$this->hash_password($this->account_information['password']);
                    //insert into DB
                    $this->connexion->change_data_database($query_insert, array_values($this->account_information));
                    return "account created";
                }else{
                    return "this email has an account";
                }
                
            }else{
                return http_response_code(404);
            }
            
        }else{
            //send error
            $this->send_errors_form();
        }
    }

    public function connect_account($query_get,$landing_page){
        if($this->verify_email($this->account_information['email'])==true){
            $user=$this->verify_email_exists($query_get,$this->account_information['email']);
            if(!empty($user)){
                if($this->check_password($this->account_information['password'], $user['password'])==true){
                    //create session
                    $this->create_session($query_get, $landing_page);
                    return 'connected';
                }else{
                    // incorrect password
                    return 'incorrect password';
                }
            }else{
                // inexistent account
                return 'inexistent account';
            }
        }else{
            return "invalid email";
        }
    }

    public function log_out($landing_page){
        session_destroy();
        header('location:'.$landing_page);
        exit();
    }

    public function update_account($query_insert,$values){
        $this->connexion->change_data_database($query_insert, $values);
    }

    public function get_all_users($query_get){
        return $this->connexion->get_all_data($query_get, null);   
    }

}