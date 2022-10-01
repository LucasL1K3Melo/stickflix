<?php 

class PreviewProvider {
    
    private $con;
    private $username;

    public function __construct($con, $username){
        $this->con = $con;
        $this->con = $username;
    }

    public function createPreviewVideo(){
        echo "Hello preview!";
    }

}

?>