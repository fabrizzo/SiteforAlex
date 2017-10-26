<?php

class Engine {

    private $_page_file = null;
    private $_error = null;

    public function __construct() 
	{
        if (isset($_GET["page"])) 
		{   $this->_page_file = $_GET["page"]; 
            $this->_page_file = str_replace(".", null, $_GET["page"]);
            $this->_page_file = str_replace("/", null, $_GET["page"]);
            $this->_page_file = str_replace("\\", null, $_GET["page"]);
            if (!file_exists( $this->_page_file . ".php")) 
			{
                $this->_setError("File is not Found"); //������ �� �����
                $this->_page_file = "main"; //��������� ������� ��������
				
            }
	        else file_get_contents( $this->_page_file . ".php");	
        }
         //���� � GET ������� ��� ���������� page, �� ��������� �������
      
		else $this->_page_file = "mainpage";
		
	
    }

    
    private function _setError($error) {
        $this->_error = $error;
    }

    
    public function getError() {
        return $this->_error;
    }

    /**
     * ���������� ����� �������� ��������
     */
    public function getContentPage() {
        return file_get_contents($this->_page_file . ".php");
    }

    public function getTitle() {
        switch ($this->_page_file) {
            case "main":
                return "Mine Page of Simple Dvij";
                break;
               default:
                break;
        }
    }

}
?>