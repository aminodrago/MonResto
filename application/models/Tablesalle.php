<?php
abstract class Application_Model_Tablesalle extends Application_Model_Serie
{
protected $_description;
    public function getDescription() { return $this->_description; }
    public function setDescription($value) { $this->_description = $value; }
	}
?>