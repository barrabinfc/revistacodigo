<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/exposicao_historico.php");

/**
 * exposicao_historicoController is the controller class for the exposicao_historico object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class exposicao_historicoController extends AppBaseController
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
	 * Displays a list view of exposicao_historico objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for exposicao_historico records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new exposicao_historicoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idhistory,Type,Idexposition,History'
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

				$exposicao_historicos = $this->Phreezer->Query('exposicao_historico',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $exposicao_historicos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $exposicao_historicos->TotalResults;
				$output->totalPages = $exposicao_historicos->TotalPages;
				$output->pageSize = $exposicao_historicos->PageSize;
				$output->currentPage = $exposicao_historicos->CurrentPage;
			}
			else
			{
				// return all results
				$exposicao_historicos = $this->Phreezer->Query('exposicao_historico',$criteria);
				$output->rows = $exposicao_historicos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single exposicao_historico record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$exposicao_historico = $this->Phreezer->Get('exposicao_historico',$pk);
			$this->RenderJSON($exposicao_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new exposicao_historico record and render response as JSON
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

			$exposicao_historico = new exposicao_historico($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $exposicao_historico->Idhistory = $this->SafeGetVal($json, 'idhistory');

			$exposicao_historico->Type = $this->SafeGetVal($json, 'type');
			$exposicao_historico->Idexposition = $this->SafeGetVal($json, 'idexposition');
			$exposicao_historico->History = $this->SafeGetVal($json, 'history');

			$exposicao_historico->Validate();
			$errors = $exposicao_historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$exposicao_historico->Save();
				$this->RenderJSON($exposicao_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing exposicao_historico record and render response as JSON
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
			$exposicao_historico = $this->Phreezer->Get('exposicao_historico',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $exposicao_historico->Idhistory = $this->SafeGetVal($json, 'idhistory', $exposicao_historico->Idhistory);

			$exposicao_historico->Type = $this->SafeGetVal($json, 'type', $exposicao_historico->Type);
			$exposicao_historico->Idexposition = $this->SafeGetVal($json, 'idexposition', $exposicao_historico->Idexposition);
			$exposicao_historico->History = $this->SafeGetVal($json, 'history', $exposicao_historico->History);

			$exposicao_historico->Validate();
			$errors = $exposicao_historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$exposicao_historico->Save();
				$this->RenderJSON($exposicao_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing exposicao_historico record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idhistory');
			$exposicao_historico = $this->Phreezer->Get('exposicao_historico',$pk);

			$exposicao_historico->Delete();

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
