<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/usuario.php");

/**
 * usuarioController is the controller class for the usuario object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class usuarioController extends AppBaseController
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
	 * Displays a list view of usuario objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for usuario records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new usuarioCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Iduser,Institution,Fullname,Username,Password,Notes,Code,Timezone,Lastlogin,Status,Admin'
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

				$usuarios = $this->Phreezer->Query('usuario',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $usuarios->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $usuarios->TotalResults;
				$output->totalPages = $usuarios->TotalPages;
				$output->pageSize = $usuarios->PageSize;
				$output->currentPage = $usuarios->CurrentPage;
			}
			else
			{
				// return all results
				$usuarios = $this->Phreezer->Query('usuario',$criteria);
				$output->rows = $usuarios->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single usuario record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('iduser');
			$usuario = $this->Phreezer->Get('usuario',$pk);
			$this->RenderJSON($usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new usuario record and render response as JSON
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

			$usuario = new usuario($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $usuario->Iduser = $this->SafeGetVal($json, 'iduser');

			$usuario->Institution = $this->SafeGetVal($json, 'institution');
			$usuario->Fullname = $this->SafeGetVal($json, 'fullname');
			$usuario->Username = $this->SafeGetVal($json, 'username');
			$usuario->Password = $this->SafeGetVal($json, 'password');
			$usuario->Notes = $this->SafeGetVal($json, 'notes');
			$usuario->Code = $this->SafeGetVal($json, 'code');
			$usuario->Timezone = $this->SafeGetVal($json, 'timezone');
			$usuario->Lastlogin = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'lastlogin')));
			$usuario->Status = $this->SafeGetVal($json, 'status');
			$usuario->Admin = $this->SafeGetVal($json, 'admin');

			$usuario->Validate();
			$errors = $usuario->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$usuario->Save();
				$this->RenderJSON($usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing usuario record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('iduser');
			$usuario = $this->Phreezer->Get('usuario',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $usuario->Iduser = $this->SafeGetVal($json, 'iduser', $usuario->Iduser);

			$usuario->Institution = $this->SafeGetVal($json, 'institution', $usuario->Institution);
			$usuario->Fullname = $this->SafeGetVal($json, 'fullname', $usuario->Fullname);
			$usuario->Username = $this->SafeGetVal($json, 'username', $usuario->Username);
			$usuario->Password = $this->SafeGetVal($json, 'password', $usuario->Password);
			$usuario->Notes = $this->SafeGetVal($json, 'notes', $usuario->Notes);
			$usuario->Code = $this->SafeGetVal($json, 'code', $usuario->Code);
			$usuario->Timezone = $this->SafeGetVal($json, 'timezone', $usuario->Timezone);
			$usuario->Lastlogin = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'lastlogin', $usuario->Lastlogin)));
			$usuario->Status = $this->SafeGetVal($json, 'status', $usuario->Status);
			$usuario->Admin = $this->SafeGetVal($json, 'admin', $usuario->Admin);

			$usuario->Validate();
			$errors = $usuario->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$usuario->Save();
				$this->RenderJSON($usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing usuario record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('iduser');
			$usuario = $this->Phreezer->Get('usuario',$pk);

			$usuario->Delete();

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
