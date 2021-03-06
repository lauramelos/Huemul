<?php

/**
 * BaseProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $sf_guard_user_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $profesion_id
 * @property string $registration
 * @property date $birth_date
 * @property enum $documment_type
 * @property string $documment
 * @property string $phone
 * @property string $movil
 * @property string $email
 * @property string $addres
 * @property string $country
 * @property sfGuardUser $User
 * @property Profession $Profession
 * 
 * @method integer     getSfGuardUserId()    Returns the current record's "sf_guard_user_id" value
 * @method string      getFirstName()        Returns the current record's "first_name" value
 * @method string      getLastName()         Returns the current record's "last_name" value
 * @method integer     getProfesionId()      Returns the current record's "profesion_id" value
 * @method string      getRegistration()     Returns the current record's "registration" value
 * @method date        getBirthDate()        Returns the current record's "birth_date" value
 * @method enum        getDocummentType()    Returns the current record's "documment_type" value
 * @method string      getDocumment()        Returns the current record's "documment" value
 * @method string      getPhone()            Returns the current record's "phone" value
 * @method string      getMovil()            Returns the current record's "movil" value
 * @method string      getEmail()            Returns the current record's "email" value
 * @method string      getAddres()           Returns the current record's "addres" value
 * @method string      getCountry()          Returns the current record's "country" value
 * @method sfGuardUser getUser()             Returns the current record's "User" value
 * @method Profession  getProfession()       Returns the current record's "Profession" value
 * @method Profile     setSfGuardUserId()    Sets the current record's "sf_guard_user_id" value
 * @method Profile     setFirstName()        Sets the current record's "first_name" value
 * @method Profile     setLastName()         Sets the current record's "last_name" value
 * @method Profile     setProfesionId()      Sets the current record's "profesion_id" value
 * @method Profile     setRegistration()     Sets the current record's "registration" value
 * @method Profile     setBirthDate()        Sets the current record's "birth_date" value
 * @method Profile     setDocummentType()    Sets the current record's "documment_type" value
 * @method Profile     setDocumment()        Sets the current record's "documment" value
 * @method Profile     setPhone()            Sets the current record's "phone" value
 * @method Profile     setMovil()            Sets the current record's "movil" value
 * @method Profile     setEmail()            Sets the current record's "email" value
 * @method Profile     setAddres()           Sets the current record's "addres" value
 * @method Profile     setCountry()          Sets the current record's "country" value
 * @method Profile     setUser()             Sets the current record's "User" value
 * @method Profile     setProfession()       Sets the current record's "Profession" value
 * 
 * @package    Huemul
 * @subpackage model
 * @author     Damian Suarez
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('profile');
        $this->hasColumn('sf_guard_user_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('first_name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('last_name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('profesion_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('registration', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('birth_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('documment_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'dni',
              1 => 'le',
             ),
             'default' => 'dni',
             ));
        $this->hasColumn('documment', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             ));
        $this->hasColumn('phone', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('movil', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('email', 'string', 60, array(
             'type' => 'string',
             'length' => 60,
             ));
        $this->hasColumn('addres', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('country', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_ALL);

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Profession', array(
             'local' => 'profesion_id',
             'foreign' => 'id'));

        $jcroppable0 = new Doctrine_Template_JCroppable(array(
             'images' => 
             array(
              0 => 'mugshot',
             ),
             ));
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $geographical0 = new Doctrine_Template_Geographical(array(
             ));
        $this->actAs($jcroppable0);
        $this->actAs($timestampable0);
        $this->actAs($geographical0);
    }
}