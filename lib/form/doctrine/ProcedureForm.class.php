<?php

/**
 * Procedure form.
 *
 * @package    Huemul
 * @subpackage form
 * @author     Damian Suarez
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProcedureForm extends BaseProcedureForm
{
  public function configure()
  {
    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['revisions_count'],
      $this['users_list'],
      $this['cadastral_data_id']
    );

    
    $this->embedRelation('CadastralData');

    $this->widgetSchema->setLabels(array(
      'Formu'  => 'Formulario',
      'CadastralData'  => 'Datos Catastrales'
    ));
   // $this->widgetSchema['formu_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formu'), 'add_empty' => false), array('disabled' => 'true'));
  }
}