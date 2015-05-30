<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/criador.php");

/**
 * criadorController is the controller class for the criador object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class criadorController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of criador objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for criador records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new criadorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idcreator,Institution,Type,Name,Notes,Birthdate,Deathdate,Nationality,Maincontact'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$criadores = $this->Phreezer->Query('criador',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $criadores->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $criadores->TotalResults;
				$output->totalPages = $criadores->TotalPages;
				$output->pageSize = $criadores->PageSize;
				$output->currentPage = $criadores->CurrentPage;
			}
			else
			{
				// return all results
				$criadores = $this->Phreezer->Query('criador',$criteria);
				$output->rows = $criadores->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single criador record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idcreator');
			$criador = $this->Phreezer->Get('criador',$pk);
			$this->RenderJSON($criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new criador record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$criador = new criador($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $criador->Idcreator = $this->SafeGetVal($json, 'idcreator');

			$criador->Institution = $this->SafeGetVal($json, 'institution');
			$criador->Type = $this->SafeGetVal($json, 'type');
			$criador->Name = $this->SafeGetVal($json, 'name');
			$criador->Notes = $this->SafeGetVal($json, 'notes');
			$criador->Birthdate = $this->SafeGetVal($json, 'birthdate');
			$criador->Deathdate = $this->SafeGetVal($json, 'deathdate');
			$criador->Nationality = $this->SafeGetVal($json, 'nationality');
			$criador->Maincontact = $this->SafeGetVal($json, 'maincontact');

			$criador->Validate();
			$errors = $criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$criador->Save();
				$this->RenderJSON($criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing criador record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idcreator');
			$criador = $this->Phreezer->Get('criador',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $criador->Idcreator = $this->SafeGetVal($json, 'idcreator', $criador->Idcreator);

			$criador->Institution = $this->SafeGetVal($json, 'institution', $criador->Institution);
			$criador->Type = $this->SafeGetVal($json, 'type', $criador->Type);
			$criador->Name = $this->SafeGetVal($json, 'name', $criador->Name);
			$criador->Notes = $this->SafeGetVal($json, 'notes', $criador->Notes);
			$criador->Birthdate = $this->SafeGetVal($json, 'birthdate', $criador->Birthdate);
			$criador->Deathdate = $this->SafeGetVal($json, 'deathdate', $criador->Deathdate);
			$criador->Nationality = $this->SafeGetVal($json, 'nationality', $criador->Nationality);
			$criador->Maincontact = $this->SafeGetVal($json, 'maincontact', $criador->Maincontact);

			$criador->Validate();
			$errors = $criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$criador->Save();
				$this->RenderJSON($criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing criador record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idcreator');
			$criador = $this->Phreezer->Get('criador',$pk);

			$criador->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
