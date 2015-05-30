<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/papel_usuario.php");

/**
 * papel_usuarioController is the controller class for the papel_usuario object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class papel_usuarioController extends AppBaseController
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
	 * Displays a list view of papel_usuario objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for papel_usuario records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new papel_usuarioCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Iduserrole,User,Role'
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

				$papeis_usuarios = $this->Phreezer->Query('papel_usuario',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $papeis_usuarios->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $papeis_usuarios->TotalResults;
				$output->totalPages = $papeis_usuarios->TotalPages;
				$output->pageSize = $papeis_usuarios->PageSize;
				$output->currentPage = $papeis_usuarios->CurrentPage;
			}
			else
			{
				// return all results
				$papeis_usuarios = $this->Phreezer->Query('papel_usuario',$criteria);
				$output->rows = $papeis_usuarios->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single papel_usuario record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('iduserrole');
			$papel_usuario = $this->Phreezer->Get('papel_usuario',$pk);
			$this->RenderJSON($papel_usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new papel_usuario record and render response as JSON
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

			$papel_usuario = new papel_usuario($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $papel_usuario->Iduserrole = $this->SafeGetVal($json, 'iduserrole');

			$papel_usuario->User = $this->SafeGetVal($json, 'user');
			$papel_usuario->Role = $this->SafeGetVal($json, 'role');

			$papel_usuario->Validate();
			$errors = $papel_usuario->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$papel_usuario->Save();
				$this->RenderJSON($papel_usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing papel_usuario record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('iduserrole');
			$papel_usuario = $this->Phreezer->Get('papel_usuario',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $papel_usuario->Iduserrole = $this->SafeGetVal($json, 'iduserrole', $papel_usuario->Iduserrole);

			$papel_usuario->User = $this->SafeGetVal($json, 'user', $papel_usuario->User);
			$papel_usuario->Role = $this->SafeGetVal($json, 'role', $papel_usuario->Role);

			$papel_usuario->Validate();
			$errors = $papel_usuario->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$papel_usuario->Save();
				$this->RenderJSON($papel_usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing papel_usuario record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('iduserrole');
			$papel_usuario = $this->Phreezer->Get('papel_usuario',$pk);

			$papel_usuario->Delete();

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
