<?php
abstract class Application_Model_Boiplamenu extends Application_Model_Resume
{
protected $_prix;
    public function getPrix() { return $this->_prix; }
    public function setPrix($value) { $this->_prix = $value; }
	}
?>