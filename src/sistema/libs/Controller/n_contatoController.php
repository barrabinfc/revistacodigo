<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/n_contato.php");

/**
 * n_contatoController is the controller class for the n_contato object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class n_contatoController extends AppBaseController
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
	 * Displays a list view of n_contato objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for n_contato records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new n_contatoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Call_,Company,CountyTaxcode,FederalTaxcode,Identity,Name,StateTaxcode,Uri,Urla,Institution'
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

				$n_contatos = $this->Phreezer->Query('n_contato',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $n_contatos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $n_contatos->TotalResults;
				$output->totalPages = $n_contatos->TotalPages;
				$output->pageSize = $n_contatos->PageSize;
				$output->currentPage = $n_contatos->CurrentPage;
			}
			else
			{
				// return all results
				$n_contatos = $this->Phreezer->Query('n_contato',$criteria);
				$output->rows = $n_contatos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single n_contato record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$n_contato = $this->Phreezer->Get('n_contato',$pk);
			$this->RenderJSON($n_contato, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new n_contato record and render response as JSON
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

			$n_contato = new n_contato($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $n_contato->Id = $this->SafeGetVal($json, 'id');

			$n_contato->Call_ = $this->SafeGetVal($json, 'call_');
			$n_contato->Company = $this->SafeGetVal($json, 'company');
			$n_contato->CountyTaxcode = $this->SafeGetVal($json, 'countyTaxcode');
			$n_contato->FederalTaxcode = $this->SafeGetVal($json, 'federalTaxcode');
			$n_contato->Identity = $this->SafeGetVal($json, 'identity');
			$n_contato->Name = $this->SafeGetVal($json, 'name');
			$n_contato->StateTaxcode = $this->SafeGetVal($json, 'stateTaxcode');
			$n_contato->Uri = $this->SafeGetVal($json, 'uri');
			$n_contato->Urla = $this->SafeGetVal($json, 'urla');
			$n_contato->Institution = $this->SafeGetVal($json, 'institution');

			$n_contato->Validate();
			$errors = $n_contato->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$n_contato->Save();
				$this->RenderJSON($n_contato, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing n_contato record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('id');
			$n_contato = $this->Phreezer->Get('n_contato',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $n_contato->Id = $this->SafeGetVal($json, 'id', $n_contato->Id);

			$n_contato->Call_ = $this->SafeGetVal($json, 'call_', $n_contato->Call_);
			$n_contato->Company = $this->SafeGetVal($json, 'company', $n_contato->Company);
			$n_contato->CountyTaxcode = $this->SafeGetVal($json, 'countyTaxcode', $n_contato->CountyTaxcode);
			$n_contato->FederalTaxcode = $this->SafeGetVal($json, 'federalTaxcode', $n_contato->FederalTaxcode);
			$n_contato->Identity = $this->SafeGetVal($json, 'identity', $n_contato->Identity);
			$n_contato->Name = $this->SafeGetVal($json, 'name', $n_contato->Name);
			$n_contato->StateTaxcode = $this->SafeGetVal($json, 'stateTaxcode', $n_contato->StateTaxcode);
			$n_contato->Uri = $this->SafeGetVal($json, 'uri', $n_contato->Uri);
			$n_contato->Urla = $this->SafeGetVal($json, 'urla', $n_contato->Urla);
			$n_contato->Institution = $this->SafeGetVal($json, 'institution', $n_contato->Institution);

			$n_contato->Validate();
			$errors = $n_contato->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$n_contato->Save();
				$this->RenderJSON($n_contato, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing n_contato record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$n_contato = $this->Phreezer->Get('n_contato',$pk);

			$n_contato->Delete();

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
