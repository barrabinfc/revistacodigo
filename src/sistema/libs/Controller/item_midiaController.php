<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/item_midia.php");

/**
 * item_midiaController is the controller class for the item_midia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class item_midiaController extends AppBaseController
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
	 * Displays a list view of item_midia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for item_midia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new item_midiaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('ItemIditem,MediasIdmedia,Id'
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

				$item_midias = $this->Phreezer->Query('item_midia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $item_midias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $item_midias->TotalResults;
				$output->totalPages = $item_midias->TotalPages;
				$output->pageSize = $item_midias->PageSize;
				$output->currentPage = $item_midias->CurrentPage;
			}
			else
			{
				// return all results
				$item_midias = $this->Phreezer->Query('item_midia',$criteria);
				$output->rows = $item_midias->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single item_midia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$item_midia = $this->Phreezer->Get('item_midia',$pk);
			$this->RenderJSON($item_midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new item_midia record and render response as JSON
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

			$item_midia = new item_midia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			$item_midia->ItemIditem = $this->SafeGetVal($json, 'itemIditem');
			$item_midia->MediasIdmedia = $this->SafeGetVal($json, 'mediasIdmedia');
			// this is an auto-increment.  uncomment if updating is allowed
			// $item_midia->Id = $this->SafeGetVal($json, 'id');


			$item_midia->Validate();
			$errors = $item_midia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$item_midia->Save();
				$this->RenderJSON($item_midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing item_midia record and render response as JSON
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
			$item_midia = $this->Phreezer->Get('item_midia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			$item_midia->ItemIditem = $this->SafeGetVal($json, 'itemIditem', $item_midia->ItemIditem);
			$item_midia->MediasIdmedia = $this->SafeGetVal($json, 'mediasIdmedia', $item_midia->MediasIdmedia);
			// this is a primary key.  uncomment if updating is allowed
			// $item_midia->Id = $this->SafeGetVal($json, 'id', $item_midia->Id);


			$item_midia->Validate();
			$errors = $item_midia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$item_midia->Save();
				$this->RenderJSON($item_midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing item_midia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$item_midia = $this->Phreezer->Get('item_midia',$pk);

			$item_midia->Delete();

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
