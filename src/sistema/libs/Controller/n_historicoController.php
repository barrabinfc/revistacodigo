<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/n_historico.php");

/**
 * n_historicoController is the controller class for the n_historico object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class n_historicoController extends AppBaseController
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
	 * Displays a list view of n_historico objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for n_historico records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new n_historicoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idhistory,Actor,Cost,Date,Description,Ispublic,Institution'
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

				$n_historicos = $this->Phreezer->Query('n_historico',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $n_historicos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $n_historicos->TotalResults;
				$output->totalPages = $n_historicos->TotalPages;
				$output->pageSize = $n_historicos->PageSize;
				$output->currentPage = $n_historicos->CurrentPage;
			}
			else
			{
				// return all results
				$n_historicos = $this->Phreezer->Query('n_historico',$criteria);
				$output->rows = $n_historicos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single n_historico record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$n_historico = $this->Phreezer->Get('n_historico',$pk);
			$this->RenderJSON($n_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new n_historico record and render response as JSON
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

			$n_historico = new n_historico($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $n_historico->Idhistory = $this->SafeGetVal($json, 'idhistory');

			$n_historico->Actor = $this->SafeGetVal($json, 'actor');
			$n_historico->Cost = $this->SafeGetVal($json, 'cost');
			$n_historico->Date = $this->SafeGetVal($json, 'date');
			$n_historico->Description = $this->SafeGetVal($json, 'description');
			$n_historico->Ispublic = $this->SafeGetVal($json, 'ispublic');
			$n_historico->Institution = $this->SafeGetVal($json, 'institution');

			$n_historico->Validate();
			$errors = $n_historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$n_historico->Save();
				$this->RenderJSON($n_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing n_historico record and render response as JSON
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
			$n_historico = $this->Phreezer->Get('n_historico',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $n_historico->Idhistory = $this->SafeGetVal($json, 'idhistory', $n_historico->Idhistory);

			$n_historico->Actor = $this->SafeGetVal($json, 'actor', $n_historico->Actor);
			$n_historico->Cost = $this->SafeGetVal($json, 'cost', $n_historico->Cost);
			$n_historico->Date = $this->SafeGetVal($json, 'date', $n_historico->Date);
			$n_historico->Description = $this->SafeGetVal($json, 'description', $n_historico->Description);
			$n_historico->Ispublic = $this->SafeGetVal($json, 'ispublic', $n_historico->Ispublic);
			$n_historico->Institution = $this->SafeGetVal($json, 'institution', $n_historico->Institution);

			$n_historico->Validate();
			$errors = $n_historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$n_historico->Save();
				$this->RenderJSON($n_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing n_historico record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$n_historico = $this->Phreezer->Get('n_historico',$pk);

			$n_historico->Delete();

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
