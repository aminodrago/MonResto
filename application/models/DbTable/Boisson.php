<?php

class Application_Model_DbTable_Type extends Zend_Db_Table_Abstract
{
	protected $_name = 'boisson';
	protected $_primary = 'id';
	
 
// pour obtenir une boisson dépuis la Bd
public function obtenirBoiss($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }
 // pour ajouter une boisson 
 public function ajouterBoiss($designation,$prix,$id_type_boisson)
    {
        $data = array(
            'designation' => $designation,
            'prix' => $prix,
            'id_type_boisson' => $id_type_boisson,
        );
        $this->insert($data);
    }
 // pour modifier une boisson
    public function modifierBoiss($id,$designation,$prix,$id_type_boisson)
    {
       $data = array(
            'designation' => $designation,
            'prix' => $prix,
            'id_type_boisson' => $id_type_boisson,
        );
        $this->update($data, 'id = '. (int)$id);
    }
    // pour supprimer une boisson
    public function supprimerBoiss($id)
    {
        $this->delete('id =' . (int)$id);
    }

}
 ?>
    