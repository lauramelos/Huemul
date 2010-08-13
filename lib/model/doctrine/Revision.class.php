<?php

/**
 * Revision
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    Huemul
 * @subpackage model
 * @author     Damian Suarez
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
 */
class Revision extends BaseRevision {
  public function isLastRevision() {
    // last revision
    $last = $this->getProcedure()->getLastRevision();
    return $last === $this ? true : false;
  }

  public function setFilename() {
    if (!is_null($this->getFile())) {
      $ext = explode('.', $this->getFile());
      $ext = $ext[1];
      $this->setFile($this->getNumber().'.'.$this->getProcedureId().'.'.$ext);
    }
  }

  public function getFilename() {
    if (!is_null($this->getFile())) {

    }
  }

  public function getPrevious() {
    $q = Doctrine_Query::create()
            ->from('Revision r')
            ->where('r.procedure_id = ?', $this->get('procedure_id'))
            ->orderBy('r.number Desc');

    return $q->fetchOne();
  }

  /*
   * El numero de revision siempre se incrementa automaticamente.
  */
  
  public function save(Doctrine_Connection $conn = null) {
    if ($this->isNew()) {
      $singleton = sfContext::getInstance();
      $this->setCreatorId($singleton->getUser()->getGuardUser()->getId());

      // control de revision padre 'A Revisar'
      $parent_rev = $this->getParent();

      if($parent_rev) {
        // es 'A revisar ?'
        if($parent_rev->getRevisionStateId() == 5 && !$parent_rev->getBlock())
        {
         $parent_rev->setBlock(true);
         $parent_rev->save();
        }
        elseif ($parent_rev->getRevisionStateId() == 5 && $parent_rev->getBlock()) {
          return false;
        }
      }

      $previous_rev = $this->getPrevious();
      if($previous_rev) {
        $this->setNumber($previous_rev->getNumber() + 1);
        if ($previous_rev->getRevisionStateId()==4) return false;
        /*$state = $previous_rev->getRevisionStateId();
        // seteamos el estado de la revision actual en funcion del estado de la revision anterior
        if($state == 1) $this->setRevisionStateId(5);
        elseif($state == 7) $this->setRevisionStateId(5);
        // block previous revision
       $previous_rev->setBlock(true);
        $previous_rev->save();*/
      }

      // revisions count
      $procedure = $this->getProcedure();
      $procedure->setRevisionsCount($procedure->getRevisions()->count() + 1);
      $procedure->save();
    }

    parent::save($conn);
  }

  public function delete(Doctrine_Connection $conn = null) {
    parent::delete($conn);
    $procedure = $this->getProcedure();
    $procedure->setRevisionsCount($procedure->getRevisions()->count());
    $procedure->save();
    $lastRevision = $procedure->getLastRevision();
    $lastRevision->setBlock(false);
    $lastRevision->save();
  }

  public function getComunication() {
    $q = Doctrine_Query::create()
            ->from('ComunicationRevision cr')
            ->where('cr.revision_id = ?', $this->get('id'));

    return $q->execute();
  }

  public function getItemsGroups() {
    $q = Doctrine_Query::create()
            ->select('Count(ri.id) as count, *')
            ->from('RevisionItem ri')
            ->leftJoin('ri.Item i')
            ->where('ri.revision_id = ?', $this->get('id'))
            ->groupBy('i.group_id');

    $request = $q->execute();

    return $request;
  }

  public function getGroups() {
    $q = Doctrine_Query::create()
            ->from('Item i')
            ->leftJoin('i.RevisionItem ri')
            ->leftJoin('i.Group g')
            ->where('ri.revision_id = ?', $this->get('id'))
            ->groupBy('i.group_id');

    $request = $q->execute();

    return $request;
  }


  /*
   * nos devuelve la cantidad de items OK para un grupo determinado
  */
  public function getItemsGroupOK($group_id) {

    $q = Doctrine_Query::create()
            ->select('Count(ri.id) as count, *')
            ->from('RevisionItem ri')
            ->leftJoin('ri.Item i')
            ->where('ri.revision_id = ?', $this->get('id'))
            ->andWhere('ri.state = ?', 'ok')
            ->andWhere('i.group_id = ?', $group_id)
            ->groupBy('ri.state');

    $request = $q->fetchOne();

    return $request;
  }

  public function getItemsGroupError($group_id) {
    $q = Doctrine_Query::create()
            ->select('Count(ri.id) as count, *')
            ->from('RevisionItem ri')
            ->leftJoin('ri.Item i')
            ->where('ri.revision_id = ?', $this->get('id'))
            ->andWhere('ri.state = ?', 'error')
            ->andWhere('i.group_id = ?', $group_id)
            ->groupBy('ri.state');

    $request = $q->fetchOne();

    return $request;
  }

  public function getItemsGroupNC($group_id) {
    $q = Doctrine_Query::create()
            ->select('Count(ri.id) as count, *')
            ->from('RevisionItem ri')
            ->leftJoin('ri.Item i')
            ->where('ri.revision_id = ?', $this->get('id'))
            ->andWhere('ri.state = ?', 'nc')
            ->andWhere('i.group_id = ?', $group_id)
            ->groupBy('ri.state');

    $request = $q->fetchOne();

    return $request;
  }

  public function getItemsGroupSC($group_id) {
    $q = Doctrine_Query::create()
            ->select('Count(ri.id) as count, *')
            ->from('RevisionItem ri')
            ->leftJoin('ri.Item i')
            ->where('ri.revision_id = ?', $this->get('id'))
            ->andWhere('ri.state = ?', 'sc')
            ->andWhere('i.group_id = ?', $group_id)
            ->groupBy('ri.state');

    $request = $q->fetchOne();

    return $request;
  }

  public function getGroupState($group_id) {
     $cierre = Doctrine::getTable('item')->findOneByGroupIdAndTitle($group_id, 'Cierre parcial');
     
     if ($cierre==''){
     $item = $cierre->get('id');
     $revision = Doctrine::getTable('RevisionItem')->findOneByItemIdAndRevisionId($item,  $this->get('id'));
     return $revision->getState();
     }
     else {
      $q = Doctrine_Query::create()
              ->select('Count(ri.id) as count, ri.state')
              ->from('RevisionItem ri')
              ->leftJoin('ri.Item i')
              ->where('ri.revision_id = ?', $this->get('id'))
              ->andWhere('i.group_id = ?', $group_id)
              ->groupBy('ri.state');

      $request = $q->execute();

      $state_error = false;
      $state_nc = false;
      $state_ok = false;
      $state_sc = false;
      foreach ($request as $value) {
        if ($value->state == 'error') {
          $state_error = true;
        }
        if ($value->state == 'sc') {
          $state_sc = true;
        }
        if ($value->state == 'nc') {
          $state_nc = true;
        }
        if ($value->state == 'ok') {
          $state_ok = true;
        }
      }

      return ($state_error) ? 'error' : ($state_sc ? 'sc' : 'ok');
     }
  }

  public function getParent(){
    return Doctrine::getTable('Revision')->find($this->getParentId());
  }

}

