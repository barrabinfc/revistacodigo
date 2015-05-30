<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/armazenamento.php");

/**
 * armazenamentoController is the controller class for the armazenamento object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class armazenamentoController extends AppBaseController
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
	 * Displays a list view of armazenamento objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for armazenamento records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new armazenamentoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idstorage,Host,Local,Username,Password,Folder,Urlftp,Urlhttp,Ipaddress,Full,Usedspace,Diskcapacity,Institution,Defaultstorage,Port,Status'
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

				$armazenamentos = $this->Phreezer->Query('armazenamento',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $armazenamentos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $armazenamentos->TotalResults;
				$output->totalPages = $armazenamentos->TotalPages;
				$output->pageSize = $armazenamentos->PageSize;
				$output->currentPage = $armazenamentos->CurrentPage;
			}
			else
			{
				// return all results
				$armazenamentos = $this->Phreezer->Query('armazenamento',$criteria);
				$output->rows = $armazenamentos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single armazenamento record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idstorage');
			$armazenamento = $this->Phreezer->Get('armazenamento',$pk);
			$this->RenderJSON($armazenamento, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new armazenamento record and render response as JSON
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

			$armazenamento = new armazenamento($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $armazenamento->Idstorage = $this->SafeGetVal($json, 'idstorage');

			$armazenamento->Host = $this->SafeGetVal($json, 'host');
			$armazenamento->Local = $this->SafeGetVal($json, 'local');
			$armazenamento->Username = $this->SafeGetVal($json, 'username');
			$armazenamento->Password = $this->SafeGetVal($json, 'password');
			$armazenamento->Folder = $this->SafeGetVal($json, 'folder');
			$armazenamento->Urlftp = $this->SafeGetVal($json, 'urlftp');
			$armazenamento->Urlhttp = $this->SafeGetVal($json, 'urlhttp');
			$armazenamento->Ipaddress = $this->SafeGetVal($json, 'ipaddress');
			$armazenamento->Full = $this->SafeGetVal($json, 'full');
			$armazenamento->Usedspace = $this->SafeGetVal($json, 'usedspace');
			$armazenamento->Diskcapacity = $this->SafeGetVal($json, 'diskcapacity');
			$armazenamento->Institution = $this->SafeGetVal($json, 'institution');
			$armazenamento->Defaultstorage = $this->SafeGetVal($json, 'defaultstorage');
			$armazenamento->Port = $this->SafeGetVal($json, 'port');
			$armazenamento->Status = $this->SafeGetVal($json, 'status');

			$armazenamento->Validate();
			$errors = $armazenamento->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$armazenamento->Save();
				$this->RenderJSON($armazenamento, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing armazenamento record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idstorage');
			$armazenamento = $this->Phreezer->Get('armazenamento',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $armazenamento->Idstorage = $this->SafeGetVal($json, 'idstorage', $armazenamento->Idstorage);

			$armazenamento->Host = $this->SafeGetVal($json, 'host', $armazenamento->Host);
			$armazenamento->Local = $this->SafeGetVal($json, 'local', $armazenamento->Local);
			$armazenamento->Username = $this->SafeGetVal($json, 'username', $armazenamento->Username);
			$armazenamento->Password = $this->SafeGetVal($json, 'password', $armazenamento->Password);
			$armazenamento->Folder = $this->SafeGetVal($json, 'folder', $armazenamento->Folder);
			$armazenamento->Urlftp = $this->SafeGetVal($json, 'urlftp', $armazenamento->Urlftp);
			$armazenamento->Urlhttp = $this->SafeGetVal($json, 'urlhttp', $armazenamento->Urlhttp);
			$armazenamento->Ipaddress = $this->SafeGetVal($json, 'ipaddress', $armazenamento->Ipaddress);
			$armazenamento->Full = $this->SafeGetVal($json, 'full', $armazenamento->Full);
			$armazenamento->Usedspace = $this->SafeGetVal($json, 'usedspace', $armazenamento->Usedspace);
			$armazenamento->Diskcapacity = $this->SafeGetVal($json, 'diskcapacity', $armazenamento->Diskcapacity);
			$armazenamento->Institution = $this->SafeGetVal($json, 'institution', $armazenamento->Institution);
			$armazenamento->Defaultstorage = $this->SafeGetVal($json, 'defaultstorage', $armazenamento->Defaultstorage);
			$armazenamento->Port = $this->SafeGetVal($json, 'port', $armazenamento->Port);
			$armazenamento->Status = $this->SafeGetVal($json, 'status', $armazenamento->Status);

			$armazenamento->Validate();
			$errors = $armazenamento->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$armazenamento->Save();
				$this->RenderJSON($armazenamento, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing armazenamento record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idstorage');
			$armazenamento = $this->Phreezer->Get('armazenamento',$pk);

			$armazenamento->Delete();

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
