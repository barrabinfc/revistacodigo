<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/dimensao_item.php");

/**
 * dimensao_itemController is the controller class for the dimensao_item object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class dimensao_itemController extends AppBaseController
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
	 * Displays a list view of dimensao_item objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for dimensao_item records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new dimensao_itemCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Item,Dimensiontype,Dimensionunit,Dimensionvalue'
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

				$dimensoes_items = $this->Phreezer->Query('dimensao_item',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $dimensoes_items->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $dimensoes_items->TotalResults;
				$output->totalPages = $dimensoes_items->TotalPages;
				$output->pageSize = $dimensoes_items->PageSize;
				$output->currentPage = $dimensoes_items->CurrentPage;
			}
			else
			{
				// return all results
				$dimensoes_items = $this->Phreezer->Query('dimensao_item',$criteria);
				$output->rows = $dimensoes_items->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single dimensao_item record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$dimensao_item = $this->Phreezer->Get('dimensao_item',$pk);
			$this->RenderJSON($dimensao_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new dimensao_item record and render response as JSON
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

			$dimensao_item = new dimensao_item($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $dimensao_item->Id = $this->SafeGetVal($json, 'id');

			$dimensao_item->Item = $this->SafeGetVal($json, 'item');
			$dimensao_item->Dimensiontype = $this->SafeGetVal($json, 'dimensiontype');
			$dimensao_item->Dimensionunit = $this->SafeGetVal($json, 'dimensionunit');
			$dimensao_item->Dimensionvalue = $this->SafeGetVal($json, 'dimensionvalue');

			$dimensao_item->Validate();
			$errors = $dimensao_item->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$dimensao_item->Save();
				$this->RenderJSON($dimensao_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing dimensao_item record and render response as JSON
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
			$dimensao_item = $this->Phreezer->Get('dimensao_item',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $dimensao_item->Id = $this->SafeGetVal($json, 'id', $dimensao_item->Id);

			$dimensao_item->Item = $this->SafeGetVal($json, 'item', $dimensao_item->Item);
			$dimensao_item->Dimensiontype = $this->SafeGetVal($json, 'dimensiontype', $dimensao_item->Dimensiontype);
			$dimensao_item->Dimensionunit = $this->SafeGetVal($json, 'dimensionunit', $dimensao_item->Dimensionunit);
			$dimensao_item->Dimensionvalue = $this->SafeGetVal($json, 'dimensionvalue', $dimensao_item->Dimensionvalue);

			$dimensao_item->Validate();
			$errors = $dimensao_item->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$dimensao_item->Save();
				$this->RenderJSON($dimensao_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing dimensao_item record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$dimensao_item = $this->Phreezer->Get('dimensao_item',$pk);

			$dimensao_item->Delete();

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
