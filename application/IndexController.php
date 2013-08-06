<?php

class IndexController extends Zend_Controller_Action
{
     protected $_listActivite = array();
     protected $_listCategorie = array();
     protected $_listType= array();
     protected $_listMassif= array();
     protected $_listNiveau= array();
     protected $_listPeriode= array();
    
    public function init()
        {
            // Les catégories
            $categorieMapper = new Application_Model_CategorieMapper();
            $this->_listCategorie = $categorieMapper->fetchAll();
            $this->view->listCategorie = $this->_listCategorie;

            //les types
            $typeMapper = new Application_Model_TypeMapper();
            $this->_listType= $typeMapper->fetchAll();
            $this->view->listType =$this-> _listType;

            //les activites
            $activiteMapper = new Application_Model_ActiviteMapper();
            $this->_listActivite = $activiteMapper->fetchAll();
            $this->view->listActivite = $this->_listActivite;

            //les massifs
            $massifMapper = new Application_Model_MassifMapper();
            $this->_listMassif = $massifMapper->fetchAll();
            $this->view->listMassif = $this->_listMassif;

            //les niveaux
            $niveauMapper = new Application_Model_NiveauMapper();
            $this->_listNiveau = $niveauMapper->fetchAll();
            $this->view->listNiveau = $this->_listNiveau;

            //les periodes
            $periodeMapper = new Application_Model_PeriodeMapper();
            $this->_listPeriode = $periodeMapper->fetchAll();
            $this->view->listPeriode = $this->_listPeriode;
            /* Initialize action controller here */
        }

        
        
    public function indexAction()
        {
            $this->view->form = new Application_Form_Tri($this->_listActivite,$this->_listCategorie, $this->_listType );
            if ($this->getRequest()->isPost()) 
            {
                $formData = $this->getRequest()->getPost();
                $this->view->form->populate($formData);
            }
           $sortieMapper = new Application_Model_SortieMapper();
           $listSortie = $sortieMapper->fetchAll($this->getRequest()->getParams());
           $this->view->sortie = $listSortie;
        }
   
        
    // la fonction pour ajouter une sortie
            public function ajoutersortieAction()
            {
            $form = new Application_Form_Sort($this->_listActivite,$this->_listCategorie,$this->_listType,$this->_listMassif, $this->_listNiveau,$this->_listPeriode);
            $form->envoyer->setLabel('Ajouter');
            $this->view->form = $form;

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $date = $form->getValue('date');
                    $duree = $form->getValue('duree');
                                $activite_id = $form->getValue('activite_id');
                                $type_id = $form->getValue('type_id');
                                $categorie_id = $form->getValue('categorie_id');
                                $massif_id = $form->getValue('massif_id');
                                $niveau_id = $form->getValue('niveau_id');
                                $periode_id = $form->getValue('periode_id');
                                $nb_inscrits = $form->getValue('nb_inscrits');
                                $nb_inscrites = $form->getValue('nb_inscrites');
                                $nb_participants = $form->getValue('nb_participants');
                                $nb_participantes = $form->getValue('nb_participantes');
                                $statut = $form->getValue('statut');
                    $sortie = new Application_Model_DbTable_Sortie();
                    $sortie->ajouterSort($date, $duree, $activite_id, $type_id, $categorie_id, $massif_id, $niveau_id, $periode_id, $nb_inscrits, $nb_inscrites, $nb_participants, $nb_participantes, $statut);

                    $this->_helper->redirector('index');
                } else {
                    $form->populate($formData);
                }
            }
        }
    
 
  //la fonction pour modifier une sortie  
    public function modifiersortieAction()
    {
        $form = new Application_Form_Sort($this->_listActivite,$this->_listCategorie,$this->_listType,$this->_listMassif, $this->_listNiveau,$this->_listPeriode);
        $form->envoyer->setLabel('Sauvegarder');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $date = $form->getValue('date');
                $duree = $form->getValue('duree');
                            $activite_id = $form->getValue('activite_id');
                            $type_id = $form->getValue('type_id');
                            $categorie_id = $form->getValue('categorie_id');
                            $massif_id = $form->getValue('massif_id');
                            $niveau_id = $form->getValue('niveau_id');
                            $periode_id = $form->getValue('periode_id');
                            $nb_inscrits = $form->getValue('nb_inscrits');
                            $nb_inscrites = $form->getValue('nb_inscrites');
                            $nb_participants = $form->getValue('nb_participants');
                            $nb_participantes = $form->getValue('nb_participantes');
                            $statut = $form->getValue('statut');
                $sortie = new Application_Model_DbTable_Sortie();
                $sortie->modifierSort($id, $date, $duree, $activite_id, $type_id, $categorie_id, $massif_id, $niveau_id, $periode_id, $nb_inscrits, $nb_inscrites, $nb_participants, $nb_participantes, $statut);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $sortie = new Application_Model_DbTable_Sortie();
                $form->populate($sortie->obtenirSort($id));
            }   
    }
    }

    
        // La fonction pour supprimer une sortie
            public function supprimersortieAction()
            {
                $id = $this->getRequest()->getParam('id');
                $sortie = new Application_Model_DbTable_Sortie();
                $sortie->supprimerSort($id);
                $this->_helper->redirector('index');
            }

    
    
            public function gerermassifAction()
            {
            }


            public function gereractiviteAction()
            {   
            }


            //la fonction pour ajouter un massif
            public function ajoutermassifAction()
                {
                 $form = new Application_Form_Mass();
                    $form->envoyer->setLabel('Ajouter');
                    $this->view->form = $form;

                    if ($this->getRequest()->isPost()) {
                        $formData = $this->getRequest()->getPost();
                        if ($form->isValid($formData)) {
                            $libele = $form->getValue('libele');
                            $massif = new Application_Model_DbTable_Massif();
                            $massif->ajouterMass($libele);

                            $this->_helper->redirector('gerermassif');
                        } else {
                            $form->populate($formData);
                        }
                    }   
                }
    
    
               // la fontion pour modifier un massif   
                public function modifiermassifAction()
                    {
                        $form = new Application_Form_Mass();
                        $form->envoyer->setLabel('Sauvegarder');
                        $this->view->form = $form;

                        if ($this->getRequest()->isPost()) {
                            $formData = $this->getRequest()->getPost();
                            if ($form->isValid($formData)) {
                                $id = $form->getValue('id');
                                $libele = $form->getValue('libele');
                                $massif = new Application_Model_DbTable_Massif();
                                $massif->modifierMass($id, $libele);

                                $this->_helper->redirector('index');
                            } else {
                                $form->populate($formData);
                            }
                        } else {
                            $id = $this->_getParam('id', 0);
                            if ($id > 0) {
                                $massif = new Application_Model_DbTable_Massif();
                                $form->populate($massif->obtenirMass($id));
                            }   
                    }
                    }

   
                    
                    // la fonction pour supprimer un massif
                    public function supprimermassifAction()
                        {
                                $id = $this->getRequest()->getParam('id');
                                $massif = new Application_Model_DbTable_Massif();
                                $massif->supprimerMass($id);
                                $this->_helper->redirector('index');
                            }
        
  
                            // la fontion pour ajouter une activité
                        public function ajouteractiviteAction()
                            {
                             $form = new Application_Form_Activ();
                                $form->envoyer->setLabel('Ajouter');
                                $this->view->form = $form;

                                if ($this->getRequest()->isPost()) {
                                    $formData = $this->getRequest()->getPost();
                                    if ($form->isValid($formData)) {
                                        $code = $form->getValue('code');
                                        $libele = $form->getValue('libele');
                                        $activite = new Application_Model_DbTable_Activite();
                                        $activite->ajouterActiv($code, $libele);

                                        $this->_helper->redirector('index');
                                    } else {
                                        $form->populate($formData);
                                    }
                                }   
                            }
    
  
                            // la fonction pour modifier une activité
        public function modifieractiviteAction()
            {
               $form = new Application_Form_Activ();
                $form->envoyer->setLabel('Sauvegarder');
                $this->view->form = $form;

                if ($this->getRequest()->isPost()) {
                    $formData = $this->getRequest()->getPost();
                    if ($form->isValid($formData)) {
                        $id = $form->getValue('id');
                        $code = $form->getValue('code');
                        $libele = $form->getValue('libele');
                        $activite = new Application_Model_DbTable_Activite();
                        $activite->modifierActiv($id, $code, $libele);

                        $this->_helper->redirector('gereractivite');
                    } else {
                        $form->populate($formData);
                    }
                } else {
                    $id = $this->_getParam('id', 0);
                    if ($id > 0) {
                        $activite = new Application_Model_DbTable_Activite();
                        $form->populate($activite->obtenirActiv($id));
                    }   
            }  
            }
    
    

                    /**
                     * pour suupprimer une activité
                     */
                    public function supprimeractiviteAction()
                        {
                            $id = $this->getRequest()->getParam('id');
                            $activite = new Application_Model_DbTable_Activite();
                            $activite->supprimerActiv($id);
                            $this->_helper->redirector('index');
                        }
    
        
                // pour exporter en csv les sorties   
               public function csvAction()
               {
                  $this->prepareCsv('sortie.csv');

                   $sortieMapper = new Application_Model_SortieMapper();
                   $listSortie = $sortieMapper->fetchAll($this->getRequest()->getParams());
                   foreach ($listSortie as $sortie)
                   {
                      echo $sortie->getDate().';'.$sortie->getDuree().';'.$this->_listActivite[$sortie->getActiviteId()]->getCode().';'.$this->_listType[$sortie->getTypeId()]->getLibele().';'.$this->_listCategorie[$sortie->getCategorieId()]->getLibele().';'.$sortie->getNbInscrits().';'.$sortie->getNbInscrites().';'.$sortie->getNbParticipants().';'.$this->_listMassif[$sortie->getMassifId()]->getLibele().';'.$sortie->getNbParticipantes().';'.$sortie->getStatut()."\n";
                   }

               }
               

                        public function csvmassifAction()
                        {
                            $this->prepareCsv('massif.csv');

                             $massifMapper = new Application_Model_MassifMapper();
                             $listMassif = $massifMapper->fetchAll();
                             foreach ($listMassif as $massif)
                             {
                                echo $massif->getLibele()."\n";
                             }
                         }
   
                    /**
                     * prépare l'entete du fichier csv
                     * 
                     * @param string $nom nom du fichier
                     */
                    public function csvactiviteAction()
                   {
                       $this->prepareCsv('activite.csv');

                        $activiteMapper = new Application_Model_ActiviteMapper();
                        $listActivite = $activiteMapper->fetchAll();
                        foreach ($listActivite as $activite)
                        {
                           echo $activite->getCode().';'.$activite->getLibele()."\n";
                        }
                    }
   
                    
                protected function prepareCsv($nom)
                  {
                      // desactiver le rendu sinon çà ne marche pas
                      Zend_Layout::resetMvcInstance();       
                      $this->_helper->viewRenderer->setNoRender(true);

                      // header fichier csv
                      $response = $this->getResponse();
                      $response->setHttpResponseCode(200);
                      $response->setHeader('Content-Type', 'text/csv', true);

                      // forcer téléchergement
                      $response->setHeader('Content-Disposition', 'attachment' . '; filename="'.$nom.'"', true);
                      $response->setHeader('Content-Length', 1000, true);
                      $response->setHeader('Content-Transfer-Encoding', 'binary', true);
                      $response->setHeader('Expires', 0, true);
                      $response->setHeader('Cache-control', 'private, must-revalidate', true);
                      $response->setHeader("Pragma", "public", true);
                      $response->sendHeaders(); // envoie header        
                  }
              }