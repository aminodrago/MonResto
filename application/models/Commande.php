<?php
abstract class Application_Model_Commande extends Application_Model_Serie
{
protected $_suggestion;
    public function getSuggestion() { return $this->_suggestion; }
    public function setSuggestion($value) { $this->_suggestion = $value; }
	}
?>