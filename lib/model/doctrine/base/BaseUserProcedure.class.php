<?php

/**
 * BaseUserProcedure
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $procedure_id
 * @property sfGuardUser $sfGuardUser
 * @property Procedure $Procedure
 * 
 * @method integer       getUserId()       Returns the current record's "user_id" value
 * @method integer       getProcedureId()  Returns the current record's "procedure_id" value
 * @method sfGuardUser   getSfGuardUser()  Returns the current record's "sfGuardUser" value
 * @method Procedure     getProcedure()    Returns the current record's "Procedure" value
 * @method UserProcedure setUserId()       Sets the current record's "user_id" value
 * @method UserProcedure setProcedureId()  Sets the current record's "procedure_id" value
 * @method UserProcedure setSfGuardUser()  Sets the current record's "sfGuardUser" value
 * @method UserProcedure setProcedure()    Sets the current record's "Procedure" value
 * 
 * @package    Huemul
 * @subpackage model
 * @author     Damian Suarez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserProcedure extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_procedure');
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('procedure_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_ALL);

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Procedure', array(
             'local' => 'procedure_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}