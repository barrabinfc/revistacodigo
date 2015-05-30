<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/nome_criador.php");

/**
 * nome_criadorController is the controller class for the nome_criador object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class nome_criadorController extends AppBaseController
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
	 * Displays a list view of nome_criador objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for nome_criador records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new nome_criadorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idcreatorname,Creator,Naname,Type'
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

				$nome_criadores = $this->Phreezer->Query('nome_criador',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $nome_criadores->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $nome_criadores->TotalResults;
				$output->totalPages = $nome_criadores->TotalPages;
				$output->pageSize = $nome_criadores->PageSize;
				$output->currentPage = $nome_criadores->CurrentPage;
			}
			else
			{
				// return all results
				$nome_criadores = $this->Phreezer->Query('nome_criador',$criteria);
				$output->rows = $nome_criadores->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single nome_criador record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idcreatorname');
			$nome_criador = $this->Phreezer->Get('nome_criador',$pk);
			$this->RenderJSON($nome_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new nome_criador record and render response as JSON
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

			$nome_criador = new nome_criador($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $nome_criador->Idcreatorname = $this->SafeGetVal($json, 'idcreatorname');

			$nome_criador->Creator = $this->SafeGetVal($json, 'creator');
			$nome_criador->Naname = $this->SafeGetVal($json, 'naname');
			$nome_criador->Type = $this->SafeGetVal($json, 'type');

			$nome_criador->Validate();
			$errors = $nome_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$nome_criador->Save();
				$this->RenderJSON($nome_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing nome_criador record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idcreatorname');
			$nome_criador = $this->Phreezer->Get('nome_criador',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $nome_criador->Idcreatorname = $this->SafeGetVal($json, 'idcreatorname', $nome_criador->Idcreatorname);

			$nome_criador->Creator = $this->SafeGetVal($json, 'creator', $nome_criador->Creator);
			$nome_criador->Naname = $this->SafeGetVal($json, 'naname', $nome_criador->Naname);
			$nome_criador->Type = $this->SafeGetVal($json, 'type', $nome_criador->Type);

			$nome_criador->Validate();
			$errors = $nome_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$nome_criador->Save();
				$this->RenderJSON($nome_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing nome_criador record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idcreatorname');
			$nome_criador = $this->Phreezer->Get('nome_criador',$pk);

			$nome_criador->Delete();

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
