<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/expoisicao.php");

/**
 * expoisicaoController is the controller class for the expoisicao object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class expoisicaoController extends AppBaseController
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
	 * Displays a list view of expoisicao objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for expoisicao records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new expoisicaoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idexposition,Institution,Location,Curator,Initialdate,Enddate,Description,Notes,Name,Exposubtype,Expotype,Iscarriedbyotherinstitution,Isinternational,Otherinfo'
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

				$exposicoes = $this->Phreezer->Query('expoisicao',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $exposicoes->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $exposicoes->TotalResults;
				$output->totalPages = $exposicoes->TotalPages;
				$output->pageSize = $exposicoes->PageSize;
				$output->currentPage = $exposicoes->CurrentPage;
			}
			else
			{
				// return all results
				$exposicoes = $this->Phreezer->Query('expoisicao',$criteria);
				$output->rows = $exposicoes->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single expoisicao record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idexposition');
			$expoisicao = $this->Phreezer->Get('expoisicao',$pk);
			$this->RenderJSON($expoisicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new expoisicao record and render response as JSON
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

			$expoisicao = new expoisicao($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $expoisicao->Idexposition = $this->SafeGetVal($json, 'idexposition');

			$expoisicao->Institution = $this->SafeGetVal($json, 'institution');
			$expoisicao->Location = $this->SafeGetVal($json, 'location');
			$expoisicao->Curator = $this->SafeGetVal($json, 'curator');
			$expoisicao->Initialdate = $this->SafeGetVal($json, 'initialdate');
			$expoisicao->Enddate = $this->SafeGetVal($json, 'enddate');
			$expoisicao->Description = $this->SafeGetVal($json, 'description');
			$expoisicao->Notes = $this->SafeGetVal($json, 'notes');
			$expoisicao->Name = $this->SafeGetVal($json, 'name');
			$expoisicao->Exposubtype = $this->SafeGetVal($json, 'exposubtype');
			$expoisicao->Expotype = $this->SafeGetVal($json, 'expotype');
			$expoisicao->Iscarriedbyotherinstitution = $this->SafeGetVal($json, 'iscarriedbyotherinstitution');
			$expoisicao->Isinternational = $this->SafeGetVal($json, 'isinternational');
			$expoisicao->Otherinfo = $this->SafeGetVal($json, 'otherinfo');

			$expoisicao->Validate();
			$errors = $expoisicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$expoisicao->Save();
				$this->RenderJSON($expoisicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing expoisicao record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idexposition');
			$expoisicao = $this->Phreezer->Get('expoisicao',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $expoisicao->Idexposition = $this->SafeGetVal($json, 'idexposition', $expoisicao->Idexposition);

			$expoisicao->Institution = $this->SafeGetVal($json, 'institution', $expoisicao->Institution);
			$expoisicao->Location = $this->SafeGetVal($json, 'location', $expoisicao->Location);
			$expoisicao->Curator = $this->SafeGetVal($json, 'curator', $expoisicao->Curator);
			$expoisicao->Initialdate = $this->SafeGetVal($json, 'initialdate', $expoisicao->Initialdate);
			$expoisicao->Enddate = $this->SafeGetVal($json, 'enddate', $expoisicao->Enddate);
			$expoisicao->Description = $this->SafeGetVal($json, 'description', $expoisicao->Description);
			$expoisicao->Notes = $this->SafeGetVal($json, 'notes', $expoisicao->Notes);
			$expoisicao->Name = $this->SafeGetVal($json, 'name', $expoisicao->Name);
			$expoisicao->Exposubtype = $this->SafeGetVal($json, 'exposubtype', $expoisicao->Exposubtype);
			$expoisicao->Expotype = $this->SafeGetVal($json, 'expotype', $expoisicao->Expotype);
			$expoisicao->Iscarriedbyotherinstitution = $this->SafeGetVal($json, 'iscarriedbyotherinstitution', $expoisicao->Iscarriedbyotherinstitution);
			$expoisicao->Isinternational = $this->SafeGetVal($json, 'isinternational', $expoisicao->Isinternational);
			$expoisicao->Otherinfo = $this->SafeGetVal($json, 'otherinfo', $expoisicao->Otherinfo);

			$expoisicao->Validate();
			$errors = $expoisicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$expoisicao->Save();
				$this->RenderJSON($expoisicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing expoisicao record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idexposition');
			$expoisicao = $this->Phreezer->Get('expoisicao',$pk);

			$expoisicao->Delete();

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
