<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/descricao_item.php");

/**
 * descricao_itemController is the controller class for the descricao_item object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class descricao_itemController extends AppBaseController
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
	 * Displays a list view of descricao_item objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for descricao_item records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new descricao_itemCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('D,Tem,Nscriptiontype,Nscriptiondescription,Nscriptionlocation'
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

				$descricao_items = $this->Phreezer->Query('descricao_item',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $descricao_items->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $descricao_items->TotalResults;
				$output->totalPages = $descricao_items->TotalPages;
				$output->pageSize = $descricao_items->PageSize;
				$output->currentPage = $descricao_items->CurrentPage;
			}
			else
			{
				// return all results
				$descricao_items = $this->Phreezer->Query('descricao_item',$criteria);
				$output->rows = $descricao_items->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single descricao_item record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('d');
			$descricao_item = $this->Phreezer->Get('descricao_item',$pk);
			$this->RenderJSON($descricao_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new descricao_item record and render response as JSON
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

			$descricao_item = new descricao_item($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $descricao_item->D = $this->SafeGetVal($json, 'd');

			$descricao_item->Tem = $this->SafeGetVal($json, 'tem');
			$descricao_item->Nscriptiontype = $this->SafeGetVal($json, 'nscriptiontype');
			$descricao_item->Nscriptiondescription = $this->SafeGetVal($json, 'nscriptiondescription');
			$descricao_item->Nscriptionlocation = $this->SafeGetVal($json, 'nscriptionlocation');

			$descricao_item->Validate();
			$errors = $descricao_item->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$descricao_item->Save();
				$this->RenderJSON($descricao_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing descricao_item record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('d');
			$descricao_item = $this->Phreezer->Get('descricao_item',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $descricao_item->D = $this->SafeGetVal($json, 'd', $descricao_item->D);

			$descricao_item->Tem = $this->SafeGetVal($json, 'tem', $descricao_item->Tem);
			$descricao_item->Nscriptiontype = $this->SafeGetVal($json, 'nscriptiontype', $descricao_item->Nscriptiontype);
			$descricao_item->Nscriptiondescription = $this->SafeGetVal($json, 'nscriptiondescription', $descricao_item->Nscriptiondescription);
			$descricao_item->Nscriptionlocation = $this->SafeGetVal($json, 'nscriptionlocation', $descricao_item->Nscriptionlocation);

			$descricao_item->Validate();
			$errors = $descricao_item->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$descricao_item->Save();
				$this->RenderJSON($descricao_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing descricao_item record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('d');
			$descricao_item = $this->Phreezer->Get('descricao_item',$pk);

			$descricao_item->Delete();

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
