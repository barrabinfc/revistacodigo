/**
 * View logic for midias
 */

/**
 * application logic specific to the midia listing page
 */
var page = {

	midias: new model.midiaCollection(),
	collectionView: null,
	midia: null,
	modelView: null,
	isInitialized: false,
	isInitializing: false,

	fetchParams: { filter: '', orderBy: '', orderDesc: '', page: 1 },
	fetchInProgress: false,
	dialogIsOpen: false,

	/**
	 *
	 */
	init: function() {
		// ensure initialization only occurs once
		if (page.isInitialized || page.isInitializing) return;
		page.isInitializing = true;

		if (!$.isReady && console) console.warn('page was initialized before dom is ready.  views may not render properly.');

		// make the new button clickable
		$("#newmidiaButton").click(function(e) {
			e.preventDefault();
			page.showDetailDialog();
		});

		// let the page know when the dialog is open
		$('#midiaDetailDialog').on('show',function() {
			page.dialogIsOpen = true;
		});

		// when the model dialog is closed, let page know and reset the model view
		$('#midiaDetailDialog').on('hidden',function() {
			$('#modelAlert').html('');
			page.dialogIsOpen = false;
		});

		// save the model when the save button is clicked
		$("#savemidiaButton").click(function(e) {
			e.preventDefault();
			page.updateModel();
		});

		// initialize the collection view
		this.collectionView = new view.CollectionView({
			el: $("#midiaCollectionContainer"),
			templateEl: $("#midiaCollectionTemplate"),
			collection: page.midias
		});

		// initialize the search filter
		$('#filter').change(function(obj) {
			page.fetchParams.filter = $('#filter').val();
			page.fetchParams.page = 1;
			page.fetchmidias(page.fetchParams);
		});
		
		// make the rows clickable ('rendered' is a custom event, not a standard backbone event)
		this.collectionView.on('rendered',function(){

			// attach click handler to the table rows for editing
			$('table.collection tbody tr').click(function(e) {
				e.preventDefault();
				var m = page.midias.get(this.id);
				page.showDetailDialog(m);
			});

			// make the headers clickable for sorting
 			$('table.collection thead tr th').click(function(e) {
 				e.preventDefault();
				var prop = this.id.replace('header_','');

				// toggle the ascending/descending before we change the sort prop
				page.fetchParams.orderDesc = (prop == page.fetchParams.orderBy && !page.fetchParams.orderDesc) ? '1' : '';
				page.fetchParams.orderBy = prop;
				page.fetchParams.page = 1;
 				page.fetchmidias(page.fetchParams);
 			});

			// attach click handlers to the pagination controls
			$('.pageButton').click(function(e) {
				e.preventDefault();
				page.fetchParams.page = this.id.substr(5);
				page.fetchmidias(page.fetchParams);
			});
			
			page.isInitialized = true;
			page.isInitializing = false;
		});

		// backbone docs recommend bootstrapping data on initial page load, but we live by our own rules!
		this.fetchmidias({ page: 1 });

		// initialize the model view
		this.modelView = new view.ModelView({
			el: $("#midiaModelContainer")
		});

		// tell the model view where it's template is located
		this.modelView.templateEl = $("#midiaModelTemplate");

		if (model.longPollDuration > 0)	{
			setInterval(function () {

				if (!page.dialogIsOpen)	{
					page.fetchmidias(page.fetchParams,true);
				}

			}, model.longPollDuration);
		}
	},

	/**
	 * Fetch the collection data from the server
	 * @param object params passed through to collection.fetch
	 * @param bool true to hide the loading animation
	 */
	fetchmidias: function(params, hideLoader) {
		// persist the params so that paging/sorting/filtering will play together nicely
		page.fetchParams = params;

		if (page.fetchInProgress) {
			if (console) console.log('supressing fetch because it is already in progress');
		}

		page.fetchInProgress = true;

		if (!hideLoader) app.showProgress('loader');

		page.midias.fetch({

			data: params,

			success: function() {

				if (page.midias.collectionHasChanged) {
					// TODO: add any logic necessary if the collection has changed
					// the sync event will trigger the view to re-render
				}

				app.hideProgress('loader');
				page.fetchInProgress = false;
			},

			error: function(m, r) {
				app.appendAlert(app.getErrorMessage(r), 'alert-error',0,'collectionAlert');
				app.hideProgress('loader');
				page.fetchInProgress = false;
			}

		});
	},

	/**
	 * show the dialog for editing a model
	 * @param model
	 */
	showDetailDialog: function(m) {

		// show the modal dialog
		$('#midiaDetailDialog').modal({ show: true });

		// if a model was specified then that means a user is editing an existing record
		// if not, then the user is creating a new record
		page.midia = m ? m : new model.midiaModel();

		page.modelView.model = page.midia;

		if (page.midia.id == null || page.midia.id == '') {
			// this is a new record, there is no need to contact the server
			page.renderModelView(false);
		} else {
			app.showProgress('modelLoader');

			// fetch the model from the server so we are not updating stale data
			page.midia.fetch({

				success: function() {
					// data returned from the server.  render the model view
					page.renderModelView(true);
				},

				error: function(m, r) {
					app.appendAlert(app.getErrorMessage(r), 'alert-error',0,'modelAlert');
					app.hideProgress('modelLoader');
				}

			});
		}

	},

	/**
	 * Render the model template in the popup
	 * @param bool show the delete button
	 */
	renderModelView: function(showDeleteButton)	{
		page.modelView.render();

		app.hideProgress('modelLoader');

		// initialize any special controls
		try {
			$('.date-picker')
				.datepicker()
				.on('changeDate', function(ev){
					$('.date-picker').datepicker('hide');
				});
		} catch (error) {
			// this happens if the datepicker input.value isn't a valid date
			if (console) console.log('datepicker error: '+error.message);
		}
		
		$('.timepicker-default').timepicker({ defaultTime: 'value' });

		// populate the dropdown options for item
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var itemValues = new model.itemCollection();
		itemValues.fetch({
			success: function(c){
				var dd = $('#item');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('iditem'),
						item.get('inventoryid'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.midia.get('item') == item.get('iditem')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for storage
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var storageValues = new model.armazenamentoCollection();
		storageValues.fetch({
			success: function(c){
				var dd = $('#storage');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('idstorage'),
						item.get('host'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.midia.get('storage') == item.get('idstorage')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});

		// populate the dropdown options for institution
		// TODO: load only the selected value, then fetch all options when the drop-down is clicked
		var institutionValues = new model.instituicaoCollection();
		institutionValues.fetch({
			success: function(c){
				var dd = $('#institution');
				dd.append('<option value=""></option>');
				c.forEach(function(item,index) {
					dd.append(app.getOptionHtml(
						item.get('idinstitution'),
						item.get('name'), // TODO: change fieldname if the dropdown doesn't show the desired column
						page.midia.get('institution') == item.get('idinstitution')
					));
				});
				
				if (!app.browserSucks()) {
					dd.combobox();
					$('div.combobox-container + span.help-inline').hide(); // TODO: hack because combobox is making the inline help div have a height
				}

			},
			error: function(collection,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
			}
		});


		if (showDeleteButton) {
			// attach click handlers to the delete buttons

			$('#deletemidiaButton').click(function(e) {
				e.preventDefault();
				$('#confirmDeletemidiaContainer').show('fast');
			});

			$('#cancelDeletemidiaButton').click(function(e) {
				e.preventDefault();
				$('#confirmDeletemidiaContainer').hide('fast');
			});

			$('#confirmDeletemidiaButton').click(function(e) {
				e.preventDefault();
				page.deleteModel();
			});

		} else {
			// no point in initializing the click handlers if we don't show the button
			$('#deletemidiaButtonContainer').hide();
		}
	},

	/**
	 * update the model that is currently displayed in the dialog
	 */
	updateModel: function() {
		// reset any previous errors
		$('#modelAlert').html('');
		$('.control-group').removeClass('error');
		$('.help-inline').html('');

		// if this is new then on success we need to add it to the collection
		var isNew = page.midia.isNew();

		app.showProgress('modelLoader');

		page.midia.save({

			'item': $('select#item').val(),
			'idhistory': $('input#idhistory').val(),
			'storage': $('select#storage').val(),
			'iddocumentation': $('input#iddocumentation').val(),
			'institution': $('select#institution').val(),
			'idreference': $('input#idreference').val(),
			'mediatype': $('input#mediatype').val(),
			'mediaurl': $('input#mediaurl').val(),
			'digitizationdate': $('input#digitizationdate').val(),
			'digitizationresponsable': $('input#digitizationresponsable').val(),
			'polarity': $('input#polarity').val(),
			'colorspace': $('input#colorspace').val(),
			'iccprofile': $('input#iccprofile').val(),
			'xresolution': $('input#xresolution').val(),
			'yresolution': $('input#yresolution').val(),
			'thumbnail': $('input#thumbnail').val(),
			'digitizationequipment': $('input#digitizationequipment').val(),
			'format': $('input#format').val(),
			'ispublic': $('input#ispublic').val(),
			'ordername': $('input#ordername').val(),
			'sent': $('input#sent').val(),
			'exif': $('textarea#exif').val(),
			'textual': $('textarea#textual').val(),
			'sizemedia': $('input#sizemedia').val(),
			'nameoriginal': $('input#nameoriginal').val(),
			'mainmedia': $('input#mainmedia').val(),
			'mediadir': $('input#mediadir').val(),
			'thumbnaildir': $('input#thumbnaildir').val(),
			'thumbnailurl': $('input#thumbnailurl').val()
		}, {
			wait: true,
			success: function(){
				$('#midiaDetailDialog').modal('hide');
				setTimeout("app.appendAlert('midia was sucessfully " + (isNew ? "inserted" : "updated") + "','alert-success',3000,'collectionAlert')",500);
				app.hideProgress('modelLoader');

				// if the collection was initally new then we need to add it to the collection now
				if (isNew) { page.midias.add(page.midia) }

				if (model.reloadCollectionOnModelUpdate) {
					// re-fetch and render the collection after the model has been updated
					page.fetchmidias(page.fetchParams,true);
				}
		},
			error: function(model,response,scope){

				app.hideProgress('modelLoader');

				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');

				try {
					var json = $.parseJSON(response.responseText);

					if (json.errors) {
						$.each(json.errors, function(key, value) {
							$('#'+key+'InputContainer').addClass('error');
							$('#'+key+'InputContainer span.help-inline').html(value);
							$('#'+key+'InputContainer span.help-inline').show();
						});
					}
				} catch (e2) {
					if (console) console.log('error parsing server response: '+e2.message);
				}
			}
		});
	},

	/**
	 * delete the model that is currently displayed in the dialog
	 */
	deleteModel: function()	{
		// reset any previous errors
		$('#modelAlert').html('');

		app.showProgress('modelLoader');

		page.midia.destroy({
			wait: true,
			success: function(){
				$('#midiaDetailDialog').modal('hide');
				setTimeout("app.appendAlert('The midia record was deleted','alert-success',3000,'collectionAlert')",500);
				app.hideProgress('modelLoader');

				if (model.reloadCollectionOnModelUpdate) {
					// re-fetch and render the collection after the model has been updated
					page.fetchmidias(page.fetchParams,true);
				}
			},
			error: function(model,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
				app.hideProgress('modelLoader');
			}
		});
	}
};

