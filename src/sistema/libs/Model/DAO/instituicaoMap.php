<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * instituicaoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the instituicaoDAO to the institution datastore.
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
class instituicaoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idinstitution"] = new FieldMap("Idinstitution","institution","idinstitution",true,FM_TYPE_INT,11,null,true);
			self::$FM["Name"] = new FieldMap("Name","institution","name",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Description"] = new FieldMap("Description","institution","description",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Uri"] = new FieldMap("Uri","institution","uri",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Otherinformation"] = new FieldMap("Otherinformation","institution","otherinformation",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Code"] = new FieldMap("Code","institution","code",false,FM_TYPE_VARCHAR,8,null,false);
			self::$FM["Timezone"] = new FieldMap("Timezone","institution","timezone",false,FM_TYPE_INT,11,null,false);
			self::$FM["Thumbnail"] = new FieldMap("Thumbnail","institution","thumbnail",false,FM_TYPE_BLOB,null,null,false);
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
			self::$KM["fk_city_institution1"] = new KeyMap("fk_city_institution1", "Idinstitution", "City", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_creator_institution1"] = new KeyMap("fk_creator_institution1", "Idinstitution", "Creator", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_datalog_institution1"] = new KeyMap("fk_datalog_institution1", "Idinstitution", "Datalog", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_documentation_institution1"] = new KeyMap("fk_documentation_institution1", "Idinstitution", "Documentation", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_exposition_institution1"] = new KeyMap("fk_exposition_institution1", "Idinstitution", "Exposition", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_fond_institution1"] = new KeyMap("fk_fond_institution1", "Idinstitution", "Fond", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_history_institution1"] = new KeyMap("fk_history_institution1", "Idinstitution", "History", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_holder_institution1"] = new KeyMap("fk_holder_institution1", "Idinstitution", "Holder", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["FK_4pu1mko6s7rh12iydqohhngj"] = new KeyMap("FK_4pu1mko6s7rh12iydqohhngj", "Idinstitution", "InstitutionLevel", "InstitutionIdinstitution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["FK_b8huwidanw431gu321kah8d3d"] = new KeyMap("FK_b8huwidanw431gu321kah8d3d", "Idinstitution", "InstitutionMedia", "InstitutionIdinstitution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_serie_institution1"] = new KeyMap("fk_serie_institution1", "Idinstitution", "Level", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_media_institution1"] = new KeyMap("fk_media_institution1", "Idinstitution", "Media", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["FK_q27ejta8y2arisfx6k2v8y01v"] = new KeyMap("FK_q27ejta8y2arisfx6k2v8y01v", "Idinstitution", "Ncontact", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["FK_360fxrl1q9vf3b3yu70b0lxl1"] = new KeyMap("FK_360fxrl1q9vf3b3yu70b0lxl1", "Idinstitution", "Nreference", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_reference_institution1"] = new KeyMap("fk_reference_institution1", "Idinstitution", "Reference", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_role_institution1"] = new KeyMap("fk_role_institution1", "Idinstitution", "Role", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_title_institution1"] = new KeyMap("fk_title_institution1", "Idinstitution", "Title", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_user_institution1"] = new KeyMap("fk_user_institution1", "Idinstitution", "User", "Institution", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_institution_timezone"] = new KeyMap("fk_institution_timezone", "Timezone", "Timezones", "Idtimezone", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>