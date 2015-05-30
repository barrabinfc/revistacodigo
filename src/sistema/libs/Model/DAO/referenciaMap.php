<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * referenciaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the referenciaDAO to the reference datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Sistema::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class referenciaMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Idreference"] = new FieldMap("Idreference","reference","idreference",true,FM_TYPE_BIGINT,20,null,true);
			self::$FM["Item"] = new FieldMap("Item","reference","item",false,FM_TYPE_BIGINT,20,null,false);
			self::$FM["Institution"] = new FieldMap("Institution","reference","institution",false,FM_TYPE_INT,11,null,false);
			self::$FM["Creator"] = new FieldMap("Creator","reference","creator",false,FM_TYPE_INT,11,null,false);
			self::$FM["Referencetype"] = new FieldMap("Referencetype","reference","referencetype",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Referencetitle"] = new FieldMap("Referencetitle","reference","referencetitle",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Referencedescription"] = new FieldMap("Referencedescription","reference","referencedescription",false,FM_TYPE_VARCHAR,500,null,false);
			self::$FM["Referenceauthor"] = new FieldMap("Referenceauthor","reference","referenceauthor",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Referencetext"] = new FieldMap("Referencetext","reference","referencetext",false,FM_TYPE_TEXT,null,null,false);
			self::$FM["Otherinformations"] = new FieldMap("Otherinformations","reference","otherinformations",false,FM_TYPE_TEXT,null,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["fk_reference_institution1"] = new KeyMap("fk_reference_institution1", "Institution", "Institution", "Idinstitution", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>