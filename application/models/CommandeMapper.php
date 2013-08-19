<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommandeMapper
 *
 * @author bqlde
 */
class Application_Model_CommandeMapper extends Application_Model_ElementMapper  {
protected $_tablename = 'Application_Model_DbTable_Commande';

public function find($num)
    {
        $result = $this->getDbTable()->find($num);
        if(count($result) == 1) 
        {
            $commande = new Application_Model_Massif($result->current()->toArray());  
            return $commande;
        }
        else
            return null;
    }
}

?>
