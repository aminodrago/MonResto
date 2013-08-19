<?php
abstract class Application_Model_Table extends Application_Model_RestoElement
{
protected $_nbplace;
    public function getNbplace() { return $this->_nbplace; }
    public function setNbplace($value) { $this->_nbplace = $value; }
	}
?>