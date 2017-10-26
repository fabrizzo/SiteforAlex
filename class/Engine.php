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
                $this->_setError("File is not Found"); //Ошибку на экран
                $this->_page_file = "main"; //Открываем главную страницу
				
            }
	        else file_get_contents( $this->_page_file . ".php");	
        }
         //Если в GET запросе нет переменной page, то открываем главную
      
		else $this->_page_file = "mainpage";
		
	
    }

    
    private function _setError($error) {
        $this->_error = $error;
    }

    
    public function getError() {
        return $this->_error;
    }

    /**
     * Возвращает текст открытой страницы
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