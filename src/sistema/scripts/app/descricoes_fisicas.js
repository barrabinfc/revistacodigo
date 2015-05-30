/**
 * View logic for descricoes_fisicas
 */

/**
 * application logic specific to the descricao_fisica listing page
 */
var page = {

	descricoes_fisicas: new model.descricao_fisicaCollection(),
	collectionView: null,
	descricao_fisica: null,
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
		$("#newdescricao_fisicaButton").click(function(e) {
			e.preventDefault();
			page.showDetailDialog();
		});

		// let the page know when the dialog is open
		$('#descricao_fisicaDetailDialog').on('show',function() {
			page.dialogIsOpen = true;
		});

		// when the model dialog is closed, let page know and reset the model view
		$('#descricao_fisicaDetailDialog').on('hidden',function() {
			$('#modelAlert').html('');
			page.dialogIsOpen = false;
		});

		// save the model when the save button is clicked
		$("#savedescricao_fisicaButton").click(function(e) {
			e.preventDefault();
			page.updateModel();
		});

		// initialize the collection view
		this.collectionView = new view.CollectionView({
			el: $("#descricao_fisicaCollectionContainer"),
			templateEl: $("#descricao_fisicaCollectionTemplate"),
			collection: page.descricoes_fisicas
		});

		// initialize the search filter
		$('#filter').change(function(obj) {
			page.fetchParams.filter = $('#filter').val();
			page.fetchParams.page = 1;
			page.fetchdescricoes_fisicas(page.fetchParams);
		});
		
		// make the rows clickable ('rendered' is a custom event, not a standard backbone event)
		this.collectionView.on('rendered',function(){

			// attach click handler to the table rows for editing
			$('table.collection tbody tr').click(function(e) {
				e.preventDefault();
				var m = page.descricoes_fisicas.get(this.id);
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
 				page.fetchdescricoes_fisicas(page.fetchParams);
 			});

			// attach click handlers to the pagination controls
			$('.pageButton').click(function(e) {
				e.preventDefault();
				page.fetchParams.page = this.id.substr(5);
				page.fetchdescricoes_fisicas(page.fetchParams);
			});
			
			page.isInitialized = true;
			page.isInitializing = false;
		});

		// backbone docs recommend bootstrapping data on initial page load, but we live by our own rules!
		this.fetchdescricoes_fisicas({ page: 1 });

		// initialize the model view
		this.modelView = new view.ModelView({
			el: $("#descricao_fisicaModelContainer")
		});

		// tell the model view where it's template is located
		this.modelView.templateEl = $("#descricao_fisicaModelTemplate");

		if (model.longPollDuration > 0)	{
			setInterval(function () {

				if (!page.dialogIsOpen)	{
					page.fetchdescricoes_fisicas(page.fetchParams,true);
				}

			}, model.longPollDuration);
		}
	},

	/**
	 * Fetch the collection data from the server
	 * @param object params passed through to collection.fetch
	 * @param bool true to hide the loading animation
	 */
	fetchdescricoes_fisicas: function(params, hideLoader) {
		// persist the params so that paging/sorting/filtering will play together nicely
		page.fetchParams = params;

		if (page.fetchInProgress) {
			if (console) console.log('supressing fetch because it is already in progress');
		}

		page.fetchInProgress = true;

		if (!hideLoader) app.showProgress('loader');

		page.descricoes_fisicas.fetch({

			data: params,

			success: function() {

				if (page.descricoes_fisicas.collectionHasChanged) {
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
		$('#descricao_fisicaDetailDialog').modal({ show: true });

		// if a model was specified then that means a user is editing an existing record
		// if not, then the user is creating a new record
		page.descricao_fisica = m ? m : new model.descricao_fisicaModel();

		page.modelView.model = page.descricao_fisica;

		if (page.descricao_fisica.id == null || page.descricao_fisica.id == '') {
			// this is a new record, there is no need to contact the server
			page.renderModelView(false);
		} else {
			app.showProgress('modelLoader');

			// fetch the model from the server so we are not updating stale data
			page.descricao_fisica.fetch({

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
						page.descricao_fisica.get('item') == item.get('iditem')
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

			$('#deletedescricao_fisicaButton').click(function(e) {
				e.preventDefault();
				$('#confirmDeletedescricao_fisicaContainer').show('fast');
			});

			$('#cancelDeletedescricao_fisicaButton').click(function(e) {
				e.preventDefault();
				$('#confirmDeletedescricao_fisicaContainer').hide('fast');
			});

			$('#confirmDeletedescricao_fisicaButton').click(function(e) {
				e.preventDefault();
				page.deleteModel();
			});

		} else {
			// no point in initializing the click handlers if we don't show the button
			$('#deletedescricao_fisicaButtonContainer').hide();
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
		var isNew = page.descricao_fisica.isNew();

		app.showProgress('modelLoader');

		page.descricao_fisica.save({

			'item': $('select#item').val(),
			'apexiso': $('input#apexiso').val(),
			'arabicpagenumbering': $('input#arabicpagenumbering').val(),
			'asaiso': $('input#asaiso').val(),
			'boundtype': $('input#boundtype').val(),
			'color': $('input#color').val(),
			'colorsystem': $('input#colorsystem').val(),
			'columnnumber': $('input#columnnumber').val(),
			'compressionmethod': $('input#compressionmethod').val(),
			'contentcolor': $('input#contentcolor').val(),
			'contentextent': $('input#contentextent').val(),
			'contentfinishing': $('input#contentfinishing').val(),
			'contentsubstract': $('input#contentsubstract').val(),
			'contenttype': $('input#contenttype').val(),
			'covercolor': $('input#covercolor').val(),
			'coverfinishing': $('input#coverfinishing').val(),
			'coversubstract': $('input#coversubstract').val(),
			'defaultapplication': $('input#defaultapplication').val(),
			'dustjacketcolor': $('input#dustjacketcolor').val(),
			'dustjacketfinishing': $('input#dustjacketfinishing').val(),
			'dustjacketsubstract': $('input#dustjacketsubstract').val(),
			'endpaper': $('input#endpaper').val(),
			'exif': $('input#exif').val(),
			'format': $('input#format').val(),
			'framerate': $('input#framerate').val(),
			'hasdustjacket': $('input#hasdustjacket').val(),
			'hassound': $('input#hassound').val(),
			'hasspecialfold': $('input#hasspecialfold').val(),
			'iscompressed': $('input#iscompressed').val(),
			'lengthtxt': $('input#lengthtxt').val(),
			'master': $('input#master').val(),
			'media': $('input#media').val(),
			'mediasupport': $('input#mediasupport').val(),
			'movements': $('input#movements').val(),
			'other': $('input#other').val(),
			'projectionmode': $('input#projectionmode').val(),
			'romanpage': $('input#romanpage').val(),
			'sizetxt': $('input#sizetxt').val(),
			'soundsystem': $('input#soundsystem').val(),
			'specialfold': $('input#specialfold').val(),
			'specialpagenumebring': $('input#specialpagenumebring').val(),
			'technique': $('input#technique').val(),
			'timecode': $('input#timecode').val(),
			'tinting': $('input#tinting').val(),
			'titlepage': $('input#titlepage').val(),
			'totaltime': $('input#totaltime').val(),
			'type': $('input#type').val(),
			'writingformat': $('input#writingformat').val()
		}, {
			wait: true,
			success: function(){
				$('#descricao_fisicaDetailDialog').modal('hide');
				setTimeout("app.appendAlert('descricao_fisica was sucessfully " + (isNew ? "inserted" : "updated") + "','alert-success',3000,'collectionAlert')",500);
				app.hideProgress('modelLoader');

				// if the collection was initally new then we need to add it to the collection now
				if (isNew) { page.descricoes_fisicas.add(page.descricao_fisica) }

				if (model.reloadCollectionOnModelUpdate) {
					// re-fetch and render the collection after the model has been updated
					page.fetchdescricoes_fisicas(page.fetchParams,true);
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

		page.descricao_fisica.destroy({
			wait: true,
			success: function(){
				$('#descricao_fisicaDetailDialog').modal('hide');
				setTimeout("app.appendAlert('The descricao_fisica record was deleted','alert-success',3000,'collectionAlert')",500);
				app.hideProgress('modelLoader');

				if (model.reloadCollectionOnModelUpdate) {
					// re-fetch and render the collection after the model has been updated
					page.fetchdescricoes_fisicas(page.fetchParams,true);
				}
			},
			error: function(model,response,scope) {
				app.appendAlert(app.getErrorMessage(response), 'alert-error',0,'modelAlert');
				app.hideProgress('modelLoader');
			}
		});
	}
};

