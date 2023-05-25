<?php

class Conexion{

    function __construct(){
        require_once(__DIR__.'/classEnv.php');

        
        $vars = new DotEnv(__DIR__ . '/../.env');
        $this->envVars = $vars->listVars();

        // ENTORNO DE DESARROLLO
        $this->nameServer = lowercase($this->envVars['ENV']);
        
        $this->host_prod = $this->envVars['HOST_PROD'];
        $this->database = $this->envVars['DATABASE'];
        $this->host_dev = $this->envVars['HOST_DEV'];
        $this->user = $this->envVars['USER'];
        $this->pass = $this->envVars['PASS'];
        $this->user_dev = $this->envVars['USER_DEV'];
        $this->pass_dev = $this->envVars['PASS_DEV'];
        $this->character = $this->envVars['CHARACTER'];
    }

    private function servidor($nameServer) {
        
        if($nameServer == 'prod'){
            return array($this->host_prod, $this->database,$this->user,$this->pass);
        }
            
        if($nameServer == 'dev'){
            return array($this->host_dev, $this->database,$this->user_dev,$this->pass_dev);
        }

    }

    public function conectar() {


        try{
            $serverDB = $this->servidor($this->nameServer);
            $dbname =$serverDB[1];
            $host = $serverDB[0];
 
            $dsn = "mysql:host=$host;dbname=$dbname";
            $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $user =  $serverDB[2];
            $password =  $serverDB[3];

            $dbh = new PDO($dsn, $user, $password);

            return $dbh;

        } 
        catch (PDOException $e){

            echo $e->getMessage();

        }

    }

    
}
