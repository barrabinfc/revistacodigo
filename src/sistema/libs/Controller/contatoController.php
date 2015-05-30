<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/contato.php");

/**
 * contatoController is the controller class for the contato object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class contatoController extends AppBaseController
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
	 * Displays a list view of contato objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for contato records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new contatoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idcontact,Institution,Iditem,Idexposition,Idholder,Idcreator,User,Contactname,Urla,Contactcall,Company,Uri,Identity,Federaltaxcode,Statetaxcode,Countytaxcode'
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

				$contatos = $this->Phreezer->Query('contato',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $contatos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $contatos->TotalResults;
				$output->totalPages = $contatos->TotalPages;
				$output->pageSize = $contatos->PageSize;
				$output->currentPage = $contatos->CurrentPage;
			}
			else
			{
				// return all results
				$contatos = $this->Phreezer->Query('contato',$criteria);
				$output->rows = $contatos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single contato record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idcontact');
			$contato = $this->Phreezer->Get('contato',$pk);
			$this->RenderJSON($contato, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new contato record and render response as JSON
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

			$contato = new contato($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $contato->Idcontact = $this->SafeGetVal($json, 'idcontact');

			$contato->Institution = $this->SafeGetVal($json, 'institution');
			$contato->Iditem = $this->SafeGetVal($json, 'iditem');
			$contato->Idexposition = $this->SafeGetVal($json, 'idexposition');
			$contato->Idholder = $this->SafeGetVal($json, 'idholder');
			$contato->Idcreator = $this->SafeGetVal($json, 'idcreator');
			$contato->User = $this->SafeGetVal($json, 'user');
			$contato->Contactname = $this->SafeGetVal($json, 'contactname');
			$contato->Urla = $this->SafeGetVal($json, 'urla');
			$contato->Contactcall = $this->SafeGetVal($json, 'contactcall');
			$contato->Company = $this->SafeGetVal($json, 'company');
			$contato->Uri = $this->SafeGetVal($json, 'uri');
			$contato->Identity = $this->SafeGetVal($json, 'identity');
			$contato->Federaltaxcode = $this->SafeGetVal($json, 'federaltaxcode');
			$contato->Statetaxcode = $this->SafeGetVal($json, 'statetaxcode');
			$contato->Countytaxcode = $this->SafeGetVal($json, 'countytaxcode');

			$contato->Validate();
			$errors = $contato->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$contato->Save();
				$this->RenderJSON($contato, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing contato record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idcontact');
			$contato = $this->Phreezer->Get('contato',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $contato->Idcontact = $this->SafeGetVal($json, 'idcontact', $contato->Idcontact);

			$contato->Institution = $this->SafeGetVal($json, 'institution', $contato->Institution);
			$contato->Iditem = $this->SafeGetVal($json, 'iditem', $contato->Iditem);
			$contato->Idexposition = $this->SafeGetVal($json, 'idexposition', $contato->Idexposition);
			$contato->Idholder = $this->SafeGetVal($json, 'idholder', $contato->Idholder);
			$contato->Idcreator = $this->SafeGetVal($json, 'idcreator', $contato->Idcreator);
			$contato->User = $this->SafeGetVal($json, 'user', $contato->User);
			$contato->Contactname = $this->SafeGetVal($json, 'contactname', $contato->Contactname);
			$contato->Urla = $this->SafeGetVal($json, 'urla', $contato->Urla);
			$contato->Contactcall = $this->SafeGetVal($json, 'contactcall', $contato->Contactcall);
			$contato->Company = $this->SafeGetVal($json, 'company', $contato->Company);
			$contato->Uri = $this->SafeGetVal($json, 'uri', $contato->Uri);
			$contato->Identity = $this->SafeGetVal($json, 'identity', $contato->Identity);
			$contato->Federaltaxcode = $this->SafeGetVal($json, 'federaltaxcode', $contato->Federaltaxcode);
			$contato->Statetaxcode = $this->SafeGetVal($json, 'statetaxcode', $contato->Statetaxcode);
			$contato->Countytaxcode = $this->SafeGetVal($json, 'countytaxcode', $contato->Countytaxcode);

			$contato->Validate();
			$errors = $contato->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$contato->Save();
				$this->RenderJSON($contato, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing contato record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idcontact');
			$contato = $this->Phreezer->Get('contato',$pk);

			$contato->Delete();

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
