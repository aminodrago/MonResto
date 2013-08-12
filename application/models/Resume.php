<?php
abstract class Application_Model_Resume extends Application_Model_Monresto
{
protected $_designation;
    public function getDesignation() { return $this->_designation; }
    public function setDesignation($value) { $this->_designation = $value; }
	}
?>