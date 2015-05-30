<?php
/** @package    Sistema::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the expoisicao object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Sistema::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class expoisicaoReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `exposition` table
	public $CustomFieldExample;

	public $Idexposition;
	public $Institution;
	public $Location;
	public $Curator;
	public $Initialdate;
	public $Enddate;
	public $Description;
	public $Notes;
	public $Name;
	public $Exposubtype;
	public $Expotype;
	public $Iscarriedbyotherinstitution;
	public $Isinternational;
	public $Otherinfo;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`exposition`.`idexposition` as Idexposition
			,`exposition`.`institution` as Institution
			,`exposition`.`location` as Location
			,`exposition`.`curator` as Curator
			,`exposition`.`initialdate` as Initialdate
			,`exposition`.`enddate` as Enddate
			,`exposition`.`description` as Description
			,`exposition`.`notes` as Notes
			,`exposition`.`name` as Name
			,`exposition`.`exposubtype` as Exposubtype
			,`exposition`.`expotype` as Expotype
			,`exposition`.`iscarriedbyotherinstitution` as Iscarriedbyotherinstitution
			,`exposition`.`isinternational` as Isinternational
			,`exposition`.`otherinfo` as Otherinfo
		from `exposition`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `exposition`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>