<?php

class conexao
{

    /*
        Altere as variaveis a seguir caso necessario
    */


	
    private $db_host = 'localhost'; // servidor
    private $db_user = 'root'; // usuario do banco
    private $db_pass = ''; // senha do usuario do banco
    private $db_name = 'ina'; // nome do banco

	
	/*  
	private $db_host = 'sql204.2host.me'; // servidor
    private $db_user = '3hstm_25021928'; // usuario do banco
    private $db_pass = 'policarp'; // senha do usuario do banco
    private $db_name = '3hstm_25021928_pci'; // nome do banco
*/
	
	
	
	
    private $con = false;

   
    public function connect() // estabelece conexao
    {
      
            $myconn = @mysqli_connect($this->db_host,$this->db_user,$this->db_pass);			
            if($myconn)
            {
                $seldb = @mysqli_select_db($myconn,$this->db_name);
                if($seldb)
                {
                    $this->con = true;
                    return $myconn;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
       
    }

   
    public function disconnect() // fecha conexao
    {
    if($this->con)
    {
        if(@mysqli_close())
        {
                        $this->con = false;
            return true;
        }
        else
        {
            return false;
        }
    }
    }
      
}

?>