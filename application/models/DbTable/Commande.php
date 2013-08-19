<?php
/**
 * 
 */
class Application_Model_DbTable_Type extends Zend_Db_Table_Abstract
{
	protected $_name = 'commande';
	protected $_primary = 'num';
 // pour obtenir une commande dépuis la Bd
public function obtenirComm($num)
    {
        $num = (int)$num;
        $row = $this->fetchRow('num = ' . $num);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $num");
        }
        return $row->toArray();
    }
// pour ajouter une commande 
 public function ajouterComm($num_table,$suggestion)
    {
        $data = array(
            'num_table' => $num_table,
            'suggestion' => $suggestion,
        );
        $this->insert($data);
    }
 // pour modifier une commande
    public function modifierComm($num,$num_table,$suggestion)
    {
       $data = array(
            'num_table' => $num_table,
            'suggestion' => $suggestion,
        );
        $this->update($data, 'num = '. (int)$num);
    }
// pour supprimer une commande
    public function supprimerComm($num)
    {
        $this->delete('num =' . (int)$num);
    }
}