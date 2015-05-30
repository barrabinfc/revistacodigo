<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * contatoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the contatoDAO to the contact datastore.
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
class contatoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idcontact"] = new FieldMap("Idcontact","contact","idcontact",true,FM_TYPE_INT,11,null,true);
			self::$FM["Institution"] = new FieldMap("Institution","contact","institution",false,FM_TYPE_INT,11,null,false);
			self::$FM["Iditem"] = new FieldMap("Iditem","contact","iditem",false,FM_TYPE_BIGINT,20,null,false);
			self::$FM["Idexposition"] = new FieldMap("Idexposition","contact","idexposition",false,FM_TYPE_INT,11,null,false);
			self::$FM["Idholder"] = new FieldMap("Idholder","contact","idholder",false,FM_TYPE_INT,11,null,false);
			self::$FM["Idcreator"] = new FieldMap("Idcreator","contact","idcreator",false,FM_TYPE_INT,11,null,false);
			self::$FM["User"] = new FieldMap("User","contact","user",false,FM_TYPE_INT,11,null,false);
			self::$FM["Contactname"] = new FieldMap("Contactname","contact","contactname",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Urla"] = new FieldMap("Urla","contact","urla",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Contactcall"] = new FieldMap("Contactcall","contact","contactcall",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Company"] = new FieldMap("Company","contact","company",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Uri"] = new FieldMap("Uri","contact","uri",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Identity"] = new FieldMap("Identity","contact","identity",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Federaltaxcode"] = new FieldMap("Federaltaxcode","contact","federaltaxcode",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Statetaxcode"] = new FieldMap("Statetaxcode","contact","statetaxcode",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Countytaxcode"] = new FieldMap("Countytaxcode","contact","countytaxcode",false,FM_TYPE_VARCHAR,45,null,false);
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
		}
		return self::$KM;
	}

}

?>