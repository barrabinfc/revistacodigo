<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/historico.php");

/**
 * historicoController is the controller class for the historico object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class historicoController extends AppBaseController
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
	 * Displays a list view of historico objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for historico records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new historicoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idhistory,Type,Description,Date,Actor,Item,Institution,Idexposition,Cost,Creator,Ispublic'
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

				$historicos = $this->Phreezer->Query('historico',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $historicos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $historicos->TotalResults;
				$output->totalPages = $historicos->TotalPages;
				$output->pageSize = $historicos->PageSize;
				$output->currentPage = $historicos->CurrentPage;
			}
			else
			{
				// return all results
				$historicos = $this->Phreezer->Query('historico',$criteria);
				$output->rows = $historicos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single historico record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$historico = $this->Phreezer->Get('historico',$pk);
			$this->RenderJSON($historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new historico record and render response as JSON
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

			$historico = new historico($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $historico->Idhistory = $this->SafeGetVal($json, 'idhistory');

			$historico->Type = $this->SafeGetVal($json, 'type');
			$historico->Description = $this->SafeGetVal($json, 'description');
			$historico->Date = $this->SafeGetVal($json, 'date');
			$historico->Actor = $this->SafeGetVal($json, 'actor');
			$historico->Item = $this->SafeGetVal($json, 'item');
			$historico->Institution = $this->SafeGetVal($json, 'institution');
			$historico->Idexposition = $this->SafeGetVal($json, 'idexposition');
			$historico->Cost = $this->SafeGetVal($json, 'cost');
			$historico->Creator = $this->SafeGetVal($json, 'creator');
			$historico->Ispublic = $this->SafeGetVal($json, 'ispublic');

			$historico->Validate();
			$errors = $historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$historico->Save();
				$this->RenderJSON($historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing historico record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$historico = $this->Phreezer->Get('historico',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $historico->Idhistory = $this->SafeGetVal($json, 'idhistory', $historico->Idhistory);

			$historico->Type = $this->SafeGetVal($json, 'type', $historico->Type);
			$historico->Description = $this->SafeGetVal($json, 'description', $historico->Description);
			$historico->Date = $this->SafeGetVal($json, 'date', $historico->Date);
			$historico->Actor = $this->SafeGetVal($json, 'actor', $historico->Actor);
			$historico->Item = $this->SafeGetVal($json, 'item', $historico->Item);
			$historico->Institution = $this->SafeGetVal($json, 'institution', $historico->Institution);
			$historico->Idexposition = $this->SafeGetVal($json, 'idexposition', $historico->Idexposition);
			$historico->Cost = $this->SafeGetVal($json, 'cost', $historico->Cost);
			$historico->Creator = $this->SafeGetVal($json, 'creator', $historico->Creator);
			$historico->Ispublic = $this->SafeGetVal($json, 'ispublic', $historico->Ispublic);

			$historico->Validate();
			$errors = $historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$historico->Save();
				$this->RenderJSON($historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing historico record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$historico = $this->Phreezer->Get('historico',$pk);

			$historico->Delete();

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
