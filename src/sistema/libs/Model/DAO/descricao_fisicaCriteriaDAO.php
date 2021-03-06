<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * descricao_fisicaCriteria allows custom querying for the descricao_fisica object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Sistema::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class descricao_fisicaCriteriaDAO extends Criteria
{

	public $Id_Equals;
	public $Id_NotEquals;
	public $Id_IsLike;
	public $Id_IsNotLike;
	public $Id_BeginsWith;
	public $Id_EndsWith;
	public $Id_GreaterThan;
	public $Id_GreaterThanOrEqual;
	public $Id_LessThan;
	public $Id_LessThanOrEqual;
	public $Id_In;
	public $Id_IsNotEmpty;
	public $Id_IsEmpty;
	public $Id_BitwiseOr;
	public $Id_BitwiseAnd;
	public $Item_Equals;
	public $Item_NotEquals;
	public $Item_IsLike;
	public $Item_IsNotLike;
	public $Item_BeginsWith;
	public $Item_EndsWith;
	public $Item_GreaterThan;
	public $Item_GreaterThanOrEqual;
	public $Item_LessThan;
	public $Item_LessThanOrEqual;
	public $Item_In;
	public $Item_IsNotEmpty;
	public $Item_IsEmpty;
	public $Item_BitwiseOr;
	public $Item_BitwiseAnd;
	public $Apexiso_Equals;
	public $Apexiso_NotEquals;
	public $Apexiso_IsLike;
	public $Apexiso_IsNotLike;
	public $Apexiso_BeginsWith;
	public $Apexiso_EndsWith;
	public $Apexiso_GreaterThan;
	public $Apexiso_GreaterThanOrEqual;
	public $Apexiso_LessThan;
	public $Apexiso_LessThanOrEqual;
	public $Apexiso_In;
	public $Apexiso_IsNotEmpty;
	public $Apexiso_IsEmpty;
	public $Apexiso_BitwiseOr;
	public $Apexiso_BitwiseAnd;
	public $Arabicpagenumbering_Equals;
	public $Arabicpagenumbering_NotEquals;
	public $Arabicpagenumbering_IsLike;
	public $Arabicpagenumbering_IsNotLike;
	public $Arabicpagenumbering_BeginsWith;
	public $Arabicpagenumbering_EndsWith;
	public $Arabicpagenumbering_GreaterThan;
	public $Arabicpagenumbering_GreaterThanOrEqual;
	public $Arabicpagenumbering_LessThan;
	public $Arabicpagenumbering_LessThanOrEqual;
	public $Arabicpagenumbering_In;
	public $Arabicpagenumbering_IsNotEmpty;
	public $Arabicpagenumbering_IsEmpty;
	public $Arabicpagenumbering_BitwiseOr;
	public $Arabicpagenumbering_BitwiseAnd;
	public $Asaiso_Equals;
	public $Asaiso_NotEquals;
	public $Asaiso_IsLike;
	public $Asaiso_IsNotLike;
	public $Asaiso_BeginsWith;
	public $Asaiso_EndsWith;
	public $Asaiso_GreaterThan;
	public $Asaiso_GreaterThanOrEqual;
	public $Asaiso_LessThan;
	public $Asaiso_LessThanOrEqual;
	public $Asaiso_In;
	public $Asaiso_IsNotEmpty;
	public $Asaiso_IsEmpty;
	public $Asaiso_BitwiseOr;
	public $Asaiso_BitwiseAnd;
	public $Boundtype_Equals;
	public $Boundtype_NotEquals;
	public $Boundtype_IsLike;
	public $Boundtype_IsNotLike;
	public $Boundtype_BeginsWith;
	public $Boundtype_EndsWith;
	public $Boundtype_GreaterThan;
	public $Boundtype_GreaterThanOrEqual;
	public $Boundtype_LessThan;
	public $Boundtype_LessThanOrEqual;
	public $Boundtype_In;
	public $Boundtype_IsNotEmpty;
	public $Boundtype_IsEmpty;
	public $Boundtype_BitwiseOr;
	public $Boundtype_BitwiseAnd;
	public $Color_Equals;
	public $Color_NotEquals;
	public $Color_IsLike;
	public $Color_IsNotLike;
	public $Color_BeginsWith;
	public $Color_EndsWith;
	public $Color_GreaterThan;
	public $Color_GreaterThanOrEqual;
	public $Color_LessThan;
	public $Color_LessThanOrEqual;
	public $Color_In;
	public $Color_IsNotEmpty;
	public $Color_IsEmpty;
	public $Color_BitwiseOr;
	public $Color_BitwiseAnd;
	public $Colorsystem_Equals;
	public $Colorsystem_NotEquals;
	public $Colorsystem_IsLike;
	public $Colorsystem_IsNotLike;
	public $Colorsystem_BeginsWith;
	public $Colorsystem_EndsWith;
	public $Colorsystem_GreaterThan;
	public $Colorsystem_GreaterThanOrEqual;
	public $Colorsystem_LessThan;
	public $Colorsystem_LessThanOrEqual;
	public $Colorsystem_In;
	public $Colorsystem_IsNotEmpty;
	public $Colorsystem_IsEmpty;
	public $Colorsystem_BitwiseOr;
	public $Colorsystem_BitwiseAnd;
	public $Columnnumber_Equals;
	public $Columnnumber_NotEquals;
	public $Columnnumber_IsLike;
	public $Columnnumber_IsNotLike;
	public $Columnnumber_BeginsWith;
	public $Columnnumber_EndsWith;
	public $Columnnumber_GreaterThan;
	public $Columnnumber_GreaterThanOrEqual;
	public $Columnnumber_LessThan;
	public $Columnnumber_LessThanOrEqual;
	public $Columnnumber_In;
	public $Columnnumber_IsNotEmpty;
	public $Columnnumber_IsEmpty;
	public $Columnnumber_BitwiseOr;
	public $Columnnumber_BitwiseAnd;
	public $Compressionmethod_Equals;
	public $Compressionmethod_NotEquals;
	public $Compressionmethod_IsLike;
	public $Compressionmethod_IsNotLike;
	public $Compressionmethod_BeginsWith;
	public $Compressionmethod_EndsWith;
	public $Compressionmethod_GreaterThan;
	public $Compressionmethod_GreaterThanOrEqual;
	public $Compressionmethod_LessThan;
	public $Compressionmethod_LessThanOrEqual;
	public $Compressionmethod_In;
	public $Compressionmethod_IsNotEmpty;
	public $Compressionmethod_IsEmpty;
	public $Compressionmethod_BitwiseOr;
	public $Compressionmethod_BitwiseAnd;
	public $Contentcolor_Equals;
	public $Contentcolor_NotEquals;
	public $Contentcolor_IsLike;
	public $Contentcolor_IsNotLike;
	public $Contentcolor_BeginsWith;
	public $Contentcolor_EndsWith;
	public $Contentcolor_GreaterThan;
	public $Contentcolor_GreaterThanOrEqual;
	public $Contentcolor_LessThan;
	public $Contentcolor_LessThanOrEqual;
	public $Contentcolor_In;
	public $Contentcolor_IsNotEmpty;
	public $Contentcolor_IsEmpty;
	public $Contentcolor_BitwiseOr;
	public $Contentcolor_BitwiseAnd;
	public $Contentextent_Equals;
	public $Contentextent_NotEquals;
	public $Contentextent_IsLike;
	public $Contentextent_IsNotLike;
	public $Contentextent_BeginsWith;
	public $Contentextent_EndsWith;
	public $Contentextent_GreaterThan;
	public $Contentextent_GreaterThanOrEqual;
	public $Contentextent_LessThan;
	public $Contentextent_LessThanOrEqual;
	public $Contentextent_In;
	public $Contentextent_IsNotEmpty;
	public $Contentextent_IsEmpty;
	public $Contentextent_BitwiseOr;
	public $Contentextent_BitwiseAnd;
	public $Contentfinishing_Equals;
	public $Contentfinishing_NotEquals;
	public $Contentfinishing_IsLike;
	public $Contentfinishing_IsNotLike;
	public $Contentfinishing_BeginsWith;
	public $Contentfinishing_EndsWith;
	public $Contentfinishing_GreaterThan;
	public $Contentfinishing_GreaterThanOrEqual;
	public $Contentfinishing_LessThan;
	public $Contentfinishing_LessThanOrEqual;
	public $Contentfinishing_In;
	public $Contentfinishing_IsNotEmpty;
	public $Contentfinishing_IsEmpty;
	public $Contentfinishing_BitwiseOr;
	public $Contentfinishing_BitwiseAnd;
	public $Contentsubstract_Equals;
	public $Contentsubstract_NotEquals;
	public $Contentsubstract_IsLike;
	public $Contentsubstract_IsNotLike;
	public $Contentsubstract_BeginsWith;
	public $Contentsubstract_EndsWith;
	public $Contentsubstract_GreaterThan;
	public $Contentsubstract_GreaterThanOrEqual;
	public $Contentsubstract_LessThan;
	public $Contentsubstract_LessThanOrEqual;
	public $Contentsubstract_In;
	public $Contentsubstract_IsNotEmpty;
	public $Contentsubstract_IsEmpty;
	public $Contentsubstract_BitwiseOr;
	public $Contentsubstract_BitwiseAnd;
	public $Contenttype_Equals;
	public $Contenttype_NotEquals;
	public $Contenttype_IsLike;
	public $Contenttype_IsNotLike;
	public $Contenttype_BeginsWith;
	public $Contenttype_EndsWith;
	public $Contenttype_GreaterThan;
	public $Contenttype_GreaterThanOrEqual;
	public $Contenttype_LessThan;
	public $Contenttype_LessThanOrEqual;
	public $Contenttype_In;
	public $Contenttype_IsNotEmpty;
	public $Contenttype_IsEmpty;
	public $Contenttype_BitwiseOr;
	public $Contenttype_BitwiseAnd;
	public $Covercolor_Equals;
	public $Covercolor_NotEquals;
	public $Covercolor_IsLike;
	public $Covercolor_IsNotLike;
	public $Covercolor_BeginsWith;
	public $Covercolor_EndsWith;
	public $Covercolor_GreaterThan;
	public $Covercolor_GreaterThanOrEqual;
	public $Covercolor_LessThan;
	public $Covercolor_LessThanOrEqual;
	public $Covercolor_In;
	public $Covercolor_IsNotEmpty;
	public $Covercolor_IsEmpty;
	public $Covercolor_BitwiseOr;
	public $Covercolor_BitwiseAnd;
	public $Coverfinishing_Equals;
	public $Coverfinishing_NotEquals;
	public $Coverfinishing_IsLike;
	public $Coverfinishing_IsNotLike;
	public $Coverfinishing_BeginsWith;
	public $Coverfinishing_EndsWith;
	public $Coverfinishing_GreaterThan;
	public $Coverfinishing_GreaterThanOrEqual;
	public $Coverfinishing_LessThan;
	public $Coverfinishing_LessThanOrEqual;
	public $Coverfinishing_In;
	public $Coverfinishing_IsNotEmpty;
	public $Coverfinishing_IsEmpty;
	public $Coverfinishing_BitwiseOr;
	public $Coverfinishing_BitwiseAnd;
	public $Coversubstract_Equals;
	public $Coversubstract_NotEquals;
	public $Coversubstract_IsLike;
	public $Coversubstract_IsNotLike;
	public $Coversubstract_BeginsWith;
	public $Coversubstract_EndsWith;
	public $Coversubstract_GreaterThan;
	public $Coversubstract_GreaterThanOrEqual;
	public $Coversubstract_LessThan;
	public $Coversubstract_LessThanOrEqual;
	public $Coversubstract_In;
	public $Coversubstract_IsNotEmpty;
	public $Coversubstract_IsEmpty;
	public $Coversubstract_BitwiseOr;
	public $Coversubstract_BitwiseAnd;
	public $Defaultapplication_Equals;
	public $Defaultapplication_NotEquals;
	public $Defaultapplication_IsLike;
	public $Defaultapplication_IsNotLike;
	public $Defaultapplication_BeginsWith;
	public $Defaultapplication_EndsWith;
	public $Defaultapplication_GreaterThan;
	public $Defaultapplication_GreaterThanOrEqual;
	public $Defaultapplication_LessThan;
	public $Defaultapplication_LessThanOrEqual;
	public $Defaultapplication_In;
	public $Defaultapplication_IsNotEmpty;
	public $Defaultapplication_IsEmpty;
	public $Defaultapplication_BitwiseOr;
	public $Defaultapplication_BitwiseAnd;
	public $Dustjacketcolor_Equals;
	public $Dustjacketcolor_NotEquals;
	public $Dustjacketcolor_IsLike;
	public $Dustjacketcolor_IsNotLike;
	public $Dustjacketcolor_BeginsWith;
	public $Dustjacketcolor_EndsWith;
	public $Dustjacketcolor_GreaterThan;
	public $Dustjacketcolor_GreaterThanOrEqual;
	public $Dustjacketcolor_LessThan;
	public $Dustjacketcolor_LessThanOrEqual;
	public $Dustjacketcolor_In;
	public $Dustjacketcolor_IsNotEmpty;
	public $Dustjacketcolor_IsEmpty;
	public $Dustjacketcolor_BitwiseOr;
	public $Dustjacketcolor_BitwiseAnd;
	public $Dustjacketfinishing_Equals;
	public $Dustjacketfinishing_NotEquals;
	public $Dustjacketfinishing_IsLike;
	public $Dustjacketfinishing_IsNotLike;
	public $Dustjacketfinishing_BeginsWith;
	public $Dustjacketfinishing_EndsWith;
	public $Dustjacketfinishing_GreaterThan;
	public $Dustjacketfinishing_GreaterThanOrEqual;
	public $Dustjacketfinishing_LessThan;
	public $Dustjacketfinishing_LessThanOrEqual;
	public $Dustjacketfinishing_In;
	public $Dustjacketfinishing_IsNotEmpty;
	public $Dustjacketfinishing_IsEmpty;
	public $Dustjacketfinishing_BitwiseOr;
	public $Dustjacketfinishing_BitwiseAnd;
	public $Dustjacketsubstract_Equals;
	public $Dustjacketsubstract_NotEquals;
	public $Dustjacketsubstract_IsLike;
	public $Dustjacketsubstract_IsNotLike;
	public $Dustjacketsubstract_BeginsWith;
	public $Dustjacketsubstract_EndsWith;
	public $Dustjacketsubstract_GreaterThan;
	public $Dustjacketsubstract_GreaterThanOrEqual;
	public $Dustjacketsubstract_LessThan;
	public $Dustjacketsubstract_LessThanOrEqual;
	public $Dustjacketsubstract_In;
	public $Dustjacketsubstract_IsNotEmpty;
	public $Dustjacketsubstract_IsEmpty;
	public $Dustjacketsubstract_BitwiseOr;
	public $Dustjacketsubstract_BitwiseAnd;
	public $Endpaper_Equals;
	public $Endpaper_NotEquals;
	public $Endpaper_IsLike;
	public $Endpaper_IsNotLike;
	public $Endpaper_BeginsWith;
	public $Endpaper_EndsWith;
	public $Endpaper_GreaterThan;
	public $Endpaper_GreaterThanOrEqual;
	public $Endpaper_LessThan;
	public $Endpaper_LessThanOrEqual;
	public $Endpaper_In;
	public $Endpaper_IsNotEmpty;
	public $Endpaper_IsEmpty;
	public $Endpaper_BitwiseOr;
	public $Endpaper_BitwiseAnd;
	public $Exif_Equals;
	public $Exif_NotEquals;
	public $Exif_IsLike;
	public $Exif_IsNotLike;
	public $Exif_BeginsWith;
	public $Exif_EndsWith;
	public $Exif_GreaterThan;
	public $Exif_GreaterThanOrEqual;
	public $Exif_LessThan;
	public $Exif_LessThanOrEqual;
	public $Exif_In;
	public $Exif_IsNotEmpty;
	public $Exif_IsEmpty;
	public $Exif_BitwiseOr;
	public $Exif_BitwiseAnd;
	public $Format_Equals;
	public $Format_NotEquals;
	public $Format_IsLike;
	public $Format_IsNotLike;
	public $Format_BeginsWith;
	public $Format_EndsWith;
	public $Format_GreaterThan;
	public $Format_GreaterThanOrEqual;
	public $Format_LessThan;
	public $Format_LessThanOrEqual;
	public $Format_In;
	public $Format_IsNotEmpty;
	public $Format_IsEmpty;
	public $Format_BitwiseOr;
	public $Format_BitwiseAnd;
	public $Framerate_Equals;
	public $Framerate_NotEquals;
	public $Framerate_IsLike;
	public $Framerate_IsNotLike;
	public $Framerate_BeginsWith;
	public $Framerate_EndsWith;
	public $Framerate_GreaterThan;
	public $Framerate_GreaterThanOrEqual;
	public $Framerate_LessThan;
	public $Framerate_LessThanOrEqual;
	public $Framerate_In;
	public $Framerate_IsNotEmpty;
	public $Framerate_IsEmpty;
	public $Framerate_BitwiseOr;
	public $Framerate_BitwiseAnd;
	public $Hasdustjacket_Equals;
	public $Hasdustjacket_NotEquals;
	public $Hasdustjacket_IsLike;
	public $Hasdustjacket_IsNotLike;
	public $Hasdustjacket_BeginsWith;
	public $Hasdustjacket_EndsWith;
	public $Hasdustjacket_GreaterThan;
	public $Hasdustjacket_GreaterThanOrEqual;
	public $Hasdustjacket_LessThan;
	public $Hasdustjacket_LessThanOrEqual;
	public $Hasdustjacket_In;
	public $Hasdustjacket_IsNotEmpty;
	public $Hasdustjacket_IsEmpty;
	public $Hasdustjacket_BitwiseOr;
	public $Hasdustjacket_BitwiseAnd;
	public $Hassound_Equals;
	public $Hassound_NotEquals;
	public $Hassound_IsLike;
	public $Hassound_IsNotLike;
	public $Hassound_BeginsWith;
	public $Hassound_EndsWith;
	public $Hassound_GreaterThan;
	public $Hassound_GreaterThanOrEqual;
	public $Hassound_LessThan;
	public $Hassound_LessThanOrEqual;
	public $Hassound_In;
	public $Hassound_IsNotEmpty;
	public $Hassound_IsEmpty;
	public $Hassound_BitwiseOr;
	public $Hassound_BitwiseAnd;
	public $Hasspecialfold_Equals;
	public $Hasspecialfold_NotEquals;
	public $Hasspecialfold_IsLike;
	public $Hasspecialfold_IsNotLike;
	public $Hasspecialfold_BeginsWith;
	public $Hasspecialfold_EndsWith;
	public $Hasspecialfold_GreaterThan;
	public $Hasspecialfold_GreaterThanOrEqual;
	public $Hasspecialfold_LessThan;
	public $Hasspecialfold_LessThanOrEqual;
	public $Hasspecialfold_In;
	public $Hasspecialfold_IsNotEmpty;
	public $Hasspecialfold_IsEmpty;
	public $Hasspecialfold_BitwiseOr;
	public $Hasspecialfold_BitwiseAnd;
	public $Iscompressed_Equals;
	public $Iscompressed_NotEquals;
	public $Iscompressed_IsLike;
	public $Iscompressed_IsNotLike;
	public $Iscompressed_BeginsWith;
	public $Iscompressed_EndsWith;
	public $Iscompressed_GreaterThan;
	public $Iscompressed_GreaterThanOrEqual;
	public $Iscompressed_LessThan;
	public $Iscompressed_LessThanOrEqual;
	public $Iscompressed_In;
	public $Iscompressed_IsNotEmpty;
	public $Iscompressed_IsEmpty;
	public $Iscompressed_BitwiseOr;
	public $Iscompressed_BitwiseAnd;
	public $Lengthtxt_Equals;
	public $Lengthtxt_NotEquals;
	public $Lengthtxt_IsLike;
	public $Lengthtxt_IsNotLike;
	public $Lengthtxt_BeginsWith;
	public $Lengthtxt_EndsWith;
	public $Lengthtxt_GreaterThan;
	public $Lengthtxt_GreaterThanOrEqual;
	public $Lengthtxt_LessThan;
	public $Lengthtxt_LessThanOrEqual;
	public $Lengthtxt_In;
	public $Lengthtxt_IsNotEmpty;
	public $Lengthtxt_IsEmpty;
	public $Lengthtxt_BitwiseOr;
	public $Lengthtxt_BitwiseAnd;
	public $Master_Equals;
	public $Master_NotEquals;
	public $Master_IsLike;
	public $Master_IsNotLike;
	public $Master_BeginsWith;
	public $Master_EndsWith;
	public $Master_GreaterThan;
	public $Master_GreaterThanOrEqual;
	public $Master_LessThan;
	public $Master_LessThanOrEqual;
	public $Master_In;
	public $Master_IsNotEmpty;
	public $Master_IsEmpty;
	public $Master_BitwiseOr;
	public $Master_BitwiseAnd;
	public $Media_Equals;
	public $Media_NotEquals;
	public $Media_IsLike;
	public $Media_IsNotLike;
	public $Media_BeginsWith;
	public $Media_EndsWith;
	public $Media_GreaterThan;
	public $Media_GreaterThanOrEqual;
	public $Media_LessThan;
	public $Media_LessThanOrEqual;
	public $Media_In;
	public $Media_IsNotEmpty;
	public $Media_IsEmpty;
	public $Media_BitwiseOr;
	public $Media_BitwiseAnd;
	public $Mediasupport_Equals;
	public $Mediasupport_NotEquals;
	public $Mediasupport_IsLike;
	public $Mediasupport_IsNotLike;
	public $Mediasupport_BeginsWith;
	public $Mediasupport_EndsWith;
	public $Mediasupport_GreaterThan;
	public $Mediasupport_GreaterThanOrEqual;
	public $Mediasupport_LessThan;
	public $Mediasupport_LessThanOrEqual;
	public $Mediasupport_In;
	public $Mediasupport_IsNotEmpty;
	public $Mediasupport_IsEmpty;
	public $Mediasupport_BitwiseOr;
	public $Mediasupport_BitwiseAnd;
	public $Movements_Equals;
	public $Movements_NotEquals;
	public $Movements_IsLike;
	public $Movements_IsNotLike;
	public $Movements_BeginsWith;
	public $Movements_EndsWith;
	public $Movements_GreaterThan;
	public $Movements_GreaterThanOrEqual;
	public $Movements_LessThan;
	public $Movements_LessThanOrEqual;
	public $Movements_In;
	public $Movements_IsNotEmpty;
	public $Movements_IsEmpty;
	public $Movements_BitwiseOr;
	public $Movements_BitwiseAnd;
	public $Other_Equals;
	public $Other_NotEquals;
	public $Other_IsLike;
	public $Other_IsNotLike;
	public $Other_BeginsWith;
	public $Other_EndsWith;
	public $Other_GreaterThan;
	public $Other_GreaterThanOrEqual;
	public $Other_LessThan;
	public $Other_LessThanOrEqual;
	public $Other_In;
	public $Other_IsNotEmpty;
	public $Other_IsEmpty;
	public $Other_BitwiseOr;
	public $Other_BitwiseAnd;
	public $Projectionmode_Equals;
	public $Projectionmode_NotEquals;
	public $Projectionmode_IsLike;
	public $Projectionmode_IsNotLike;
	public $Projectionmode_BeginsWith;
	public $Projectionmode_EndsWith;
	public $Projectionmode_GreaterThan;
	public $Projectionmode_GreaterThanOrEqual;
	public $Projectionmode_LessThan;
	public $Projectionmode_LessThanOrEqual;
	public $Projectionmode_In;
	public $Projectionmode_IsNotEmpty;
	public $Projectionmode_IsEmpty;
	public $Projectionmode_BitwiseOr;
	public $Projectionmode_BitwiseAnd;
	public $Romanpage_Equals;
	public $Romanpage_NotEquals;
	public $Romanpage_IsLike;
	public $Romanpage_IsNotLike;
	public $Romanpage_BeginsWith;
	public $Romanpage_EndsWith;
	public $Romanpage_GreaterThan;
	public $Romanpage_GreaterThanOrEqual;
	public $Romanpage_LessThan;
	public $Romanpage_LessThanOrEqual;
	public $Romanpage_In;
	public $Romanpage_IsNotEmpty;
	public $Romanpage_IsEmpty;
	public $Romanpage_BitwiseOr;
	public $Romanpage_BitwiseAnd;
	public $Sizetxt_Equals;
	public $Sizetxt_NotEquals;
	public $Sizetxt_IsLike;
	public $Sizetxt_IsNotLike;
	public $Sizetxt_BeginsWith;
	public $Sizetxt_EndsWith;
	public $Sizetxt_GreaterThan;
	public $Sizetxt_GreaterThanOrEqual;
	public $Sizetxt_LessThan;
	public $Sizetxt_LessThanOrEqual;
	public $Sizetxt_In;
	public $Sizetxt_IsNotEmpty;
	public $Sizetxt_IsEmpty;
	public $Sizetxt_BitwiseOr;
	public $Sizetxt_BitwiseAnd;
	public $Soundsystem_Equals;
	public $Soundsystem_NotEquals;
	public $Soundsystem_IsLike;
	public $Soundsystem_IsNotLike;
	public $Soundsystem_BeginsWith;
	public $Soundsystem_EndsWith;
	public $Soundsystem_GreaterThan;
	public $Soundsystem_GreaterThanOrEqual;
	public $Soundsystem_LessThan;
	public $Soundsystem_LessThanOrEqual;
	public $Soundsystem_In;
	public $Soundsystem_IsNotEmpty;
	public $Soundsystem_IsEmpty;
	public $Soundsystem_BitwiseOr;
	public $Soundsystem_BitwiseAnd;
	public $Specialfold_Equals;
	public $Specialfold_NotEquals;
	public $Specialfold_IsLike;
	public $Specialfold_IsNotLike;
	public $Specialfold_BeginsWith;
	public $Specialfold_EndsWith;
	public $Specialfold_GreaterThan;
	public $Specialfold_GreaterThanOrEqual;
	public $Specialfold_LessThan;
	public $Specialfold_LessThanOrEqual;
	public $Specialfold_In;
	public $Specialfold_IsNotEmpty;
	public $Specialfold_IsEmpty;
	public $Specialfold_BitwiseOr;
	public $Specialfold_BitwiseAnd;
	public $Specialpagenumebring_Equals;
	public $Specialpagenumebring_NotEquals;
	public $Specialpagenumebring_IsLike;
	public $Specialpagenumebring_IsNotLike;
	public $Specialpagenumebring_BeginsWith;
	public $Specialpagenumebring_EndsWith;
	public $Specialpagenumebring_GreaterThan;
	public $Specialpagenumebring_GreaterThanOrEqual;
	public $Specialpagenumebring_LessThan;
	public $Specialpagenumebring_LessThanOrEqual;
	public $Specialpagenumebring_In;
	public $Specialpagenumebring_IsNotEmpty;
	public $Specialpagenumebring_IsEmpty;
	public $Specialpagenumebring_BitwiseOr;
	public $Specialpagenumebring_BitwiseAnd;
	public $Technique_Equals;
	public $Technique_NotEquals;
	public $Technique_IsLike;
	public $Technique_IsNotLike;
	public $Technique_BeginsWith;
	public $Technique_EndsWith;
	public $Technique_GreaterThan;
	public $Technique_GreaterThanOrEqual;
	public $Technique_LessThan;
	public $Technique_LessThanOrEqual;
	public $Technique_In;
	public $Technique_IsNotEmpty;
	public $Technique_IsEmpty;
	public $Technique_BitwiseOr;
	public $Technique_BitwiseAnd;
	public $Timecode_Equals;
	public $Timecode_NotEquals;
	public $Timecode_IsLike;
	public $Timecode_IsNotLike;
	public $Timecode_BeginsWith;
	public $Timecode_EndsWith;
	public $Timecode_GreaterThan;
	public $Timecode_GreaterThanOrEqual;
	public $Timecode_LessThan;
	public $Timecode_LessThanOrEqual;
	public $Timecode_In;
	public $Timecode_IsNotEmpty;
	public $Timecode_IsEmpty;
	public $Timecode_BitwiseOr;
	public $Timecode_BitwiseAnd;
	public $Tinting_Equals;
	public $Tinting_NotEquals;
	public $Tinting_IsLike;
	public $Tinting_IsNotLike;
	public $Tinting_BeginsWith;
	public $Tinting_EndsWith;
	public $Tinting_GreaterThan;
	public $Tinting_GreaterThanOrEqual;
	public $Tinting_LessThan;
	public $Tinting_LessThanOrEqual;
	public $Tinting_In;
	public $Tinting_IsNotEmpty;
	public $Tinting_IsEmpty;
	public $Tinting_BitwiseOr;
	public $Tinting_BitwiseAnd;
	public $Titlepage_Equals;
	public $Titlepage_NotEquals;
	public $Titlepage_IsLike;
	public $Titlepage_IsNotLike;
	public $Titlepage_BeginsWith;
	public $Titlepage_EndsWith;
	public $Titlepage_GreaterThan;
	public $Titlepage_GreaterThanOrEqual;
	public $Titlepage_LessThan;
	public $Titlepage_LessThanOrEqual;
	public $Titlepage_In;
	public $Titlepage_IsNotEmpty;
	public $Titlepage_IsEmpty;
	public $Titlepage_BitwiseOr;
	public $Titlepage_BitwiseAnd;
	public $Totaltime_Equals;
	public $Totaltime_NotEquals;
	public $Totaltime_IsLike;
	public $Totaltime_IsNotLike;
	public $Totaltime_BeginsWith;
	public $Totaltime_EndsWith;
	public $Totaltime_GreaterThan;
	public $Totaltime_GreaterThanOrEqual;
	public $Totaltime_LessThan;
	public $Totaltime_LessThanOrEqual;
	public $Totaltime_In;
	public $Totaltime_IsNotEmpty;
	public $Totaltime_IsEmpty;
	public $Totaltime_BitwiseOr;
	public $Totaltime_BitwiseAnd;
	public $Type_Equals;
	public $Type_NotEquals;
	public $Type_IsLike;
	public $Type_IsNotLike;
	public $Type_BeginsWith;
	public $Type_EndsWith;
	public $Type_GreaterThan;
	public $Type_GreaterThanOrEqual;
	public $Type_LessThan;
	public $Type_LessThanOrEqual;
	public $Type_In;
	public $Type_IsNotEmpty;
	public $Type_IsEmpty;
	public $Type_BitwiseOr;
	public $Type_BitwiseAnd;
	public $Writingformat_Equals;
	public $Writingformat_NotEquals;
	public $Writingformat_IsLike;
	public $Writingformat_IsNotLike;
	public $Writingformat_BeginsWith;
	public $Writingformat_EndsWith;
	public $Writingformat_GreaterThan;
	public $Writingformat_GreaterThanOrEqual;
	public $Writingformat_LessThan;
	public $Writingformat_LessThanOrEqual;
	public $Writingformat_In;
	public $Writingformat_IsNotEmpty;
	public $Writingformat_IsEmpty;
	public $Writingformat_BitwiseOr;
	public $Writingformat_BitwiseAnd;

}

?>