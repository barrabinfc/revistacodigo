<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/criador_item.php");

/**
 * criador_itemController is the controller class for the criador_item object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class criador_itemController extends AppBaseController
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
	 * Displays a list view of criador_item objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for criador_item records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new criador_itemCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Iditemcreator,Item,Creator,Type,Location,Attributed'
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

				$criadores_items = $this->Phreezer->Query('criador_item',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $criadores_items->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $criadores_items->TotalResults;
				$output->totalPages = $criadores_items->TotalPages;
				$output->pageSize = $criadores_items->PageSize;
				$output->currentPage = $criadores_items->CurrentPage;
			}
			else
			{
				// return all results
				$criadores_items = $this->Phreezer->Query('criador_item',$criteria);
				$output->rows = $criadores_items->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single criador_item record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('iditemcreator');
			$criador_item = $this->Phreezer->Get('criador_item',$pk);
			$this->RenderJSON($criador_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new criador_item record and render response as JSON
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

			$criador_item = new criador_item($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $criador_item->Iditemcreator = $this->SafeGetVal($json, 'iditemcreator');

			$criador_item->Item = $this->SafeGetVal($json, 'item');
			$criador_item->Creator = $this->SafeGetVal($json, 'creator');
			$criador_item->Type = $this->SafeGetVal($json, 'type');
			$criador_item->Location = $this->SafeGetVal($json, 'location');
			$criador_item->Attributed = $this->SafeGetVal($json, 'attributed');

			$criador_item->Validate();
			$errors = $criador_item->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$criador_item->Save();
				$this->RenderJSON($criador_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing criador_item record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('iditemcreator');
			$criador_item = $this->Phreezer->Get('criador_item',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $criador_item->Iditemcreator = $this->SafeGetVal($json, 'iditemcreator', $criador_item->Iditemcreator);

			$criador_item->Item = $this->SafeGetVal($json, 'item', $criador_item->Item);
			$criador_item->Creator = $this->SafeGetVal($json, 'creator', $criador_item->Creator);
			$criador_item->Type = $this->SafeGetVal($json, 'type', $criador_item->Type);
			$criador_item->Location = $this->SafeGetVal($json, 'location', $criador_item->Location);
			$criador_item->Attributed = $this->SafeGetVal($json, 'attributed', $criador_item->Attributed);

			$criador_item->Validate();
			$errors = $criador_item->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$criador_item->Save();
				$this->RenderJSON($criador_item, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing criador_item record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('iditemcreator');
			$criador_item = $this->Phreezer->Get('criador_item',$pk);

			$criador_item->Delete();

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
