<?php

/**
 * profile actions.
 *
 * @package    Huemul
 * @subpackage profile
 * @author     Damian Suarez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profileActions extends sfActions
{
  public function executeEdit(sfWebRequest $request)
  {
    //$user_id = $this->getUser()->getGuardUser()->getProfile()->getId();
    $user_id = $this->getUser()->getGuardUser()->getProfile()->getId();
    $this->forward404Unless($profile = Doctrine::getTable('Profile')->find(array($user_id)), sprintf('Object profile does not exist (%s).', $user_id));
    $this->form = new ProfileFrontendForm($profile);
  }

  public function executeEditMugshot(sfWebRequest $request)
  {
    //$user_id = $this->getUser()->getGuardUser()->getProfile()->getId();
    $user_id = $this->getUser()->getGuardUser()->getProfile()->getId();
    $this->forward404Unless($profile = Doctrine::getTable('Profile')->find(array($user_id)), sprintf('Object profile does not exist (%s).', $user_id));
    $this->form = new ProfileMugshotForm($profile);
  }





  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($profile = Doctrine::getTable('Profile')->find(array($request->getParameter('id'))), sprintf('Object profile does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfileFrontendForm($profile);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeUpdateMugshot(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($profile = Doctrine::getTable('Profile')->find(array($request->getParameter('id'))), sprintf('Object profile does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfileMugshotForm($profile);

    $this->processFormMugshot($request, $this->form);

    $this->setTemplate('editMusgshot');
  }



  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $profile = $form->save();
      $this->redirect('profile/edit?id='.$profile->getId());
    }
  }

  protected function processFormMugshot(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $profile = $form->save();
      $this->redirect('profile/editMugshot?id='.$profile->getId());
    }
  }

}