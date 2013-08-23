<?php
/**
 * BddElement est une classe abstraite elle me sert à généraliser des classes
 */
abstract class Application_Model_BddElement
{
    protected $_id;
    public function getId() { return $this->_id; }
    public function setId($value) { $this->_id = $value; }
}
?>