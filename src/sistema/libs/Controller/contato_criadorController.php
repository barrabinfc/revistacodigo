<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/contato_criador.php");

/**
 * contato_criadorController is the controller class for the contato_criador object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class contato_criadorController extends AppBaseController
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
	 * Displays a list view of contato_criador objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for contato_criador records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new contato_criadorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Type,Contact,Creator'
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

				$contatos_criadores = $this->Phreezer->Query('contato_criador',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $contatos_criadores->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $contatos_criadores->TotalResults;
				$output->totalPages = $contatos_criadores->TotalPages;
				$output->pageSize = $contatos_criadores->PageSize;
				$output->currentPage = $contatos_criadores->CurrentPage;
			}
			else
			{
				// return all results
				$contatos_criadores = $this->Phreezer->Query('contato_criador',$criteria);
				$output->rows = $contatos_criadores->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single contato_criador record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$contato_criador = $this->Phreezer->Get('contato_criador',$pk);
			$this->RenderJSON($contato_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new contato_criador record and render response as JSON
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

			$contato_criador = new contato_criador($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $contato_criador->Id = $this->SafeGetVal($json, 'id');

			$contato_criador->Type = $this->SafeGetVal($json, 'type');
			$contato_criador->Contact = $this->SafeGetVal($json, 'contact');
			$contato_criador->Creator = $this->SafeGetVal($json, 'creator');

			$contato_criador->Validate();
			$errors = $contato_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$contato_criador->Save();
				$this->RenderJSON($contato_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing contato_criador record and render response as JSON
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
			$contato_criador = $this->Phreezer->Get('contato_criador',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $contato_criador->Id = $this->SafeGetVal($json, 'id', $contato_criador->Id);

			$contato_criador->Type = $this->SafeGetVal($json, 'type', $contato_criador->Type);
			$contato_criador->Contact = $this->SafeGetVal($json, 'contact', $contato_criador->Contact);
			$contato_criador->Creator = $this->SafeGetVal($json, 'creator', $contato_criador->Creator);

			$contato_criador->Validate();
			$errors = $contato_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$contato_criador->Save();
				$this->RenderJSON($contato_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing contato_criador record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$contato_criador = $this->Phreezer->Get('contato_criador',$pk);

			$contato_criador->Delete();

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
