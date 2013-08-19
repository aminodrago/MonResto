<?php
abstract class Application_Model_Reservation extends Application_Model_BddElement
{
protected $_nbpersonne;
protected $_commentaire;
protected $_date;
protected $_heure;
    public function getNbpersonne() { return $this->_nbpersonne; }
    public function getCommentaire() { return $this->_commentaire; }
	public function getDate() { return $this->_date; }
	public function getHeure() { return $this->_heure; }
	public function setNbpersonne($value) { $this->_nbpersonne = $value; }
	public function setCommentaire($value) { $this->_commentaire = $value; }
	public function setDate($value) { $this->_date = $value; }
	public function setHeure($value) { $this->_heure = $value; }
	}
?>