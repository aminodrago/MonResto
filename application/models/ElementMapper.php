<?php
/**
 * Description of ElementMapper
 *
 * @author bqlde
 */
abstract class Application_Model_ElementMapper 
{
    protected $_tablename;
    protected $_dbTable;
 
    /***************************************************************************
     *	setDbTable()
     * create isntance of Zend_Db_Table
     * 
     * @param string|Zend_Db_Table_Abstract $dbTable
     * @return Application_Model_SeanceMapper 
     **************************************************************************/
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) 
            $dbTable = new $dbTable();

        if (!$dbTable instanceof Zend_Db_Table_Abstract) 
            throw new Exception('Invalid table data gateway provided');
        
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    /***************************************************************************
     *	getDbTable()
     * return instance of Zend_Db_Table. Create a new one if null
     * 
     * @return Application_Model_DbTable_Sortie 
     **************************************************************************/
    public function getDbTable()
    {
        if (null === $this->_dbTable) 
            $this->setDbTable($this->_tablename);
        
        return $this->_dbTable;
    }
}

?>
