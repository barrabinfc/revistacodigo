<?php
	$this->assign('title','sistema | expo_items');
	$this->assign('nav','expo_items');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/expo_items.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> expo_items
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="expo_itemCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idexpoitem">Idexpoitem<% if (page.orderBy == 'Idexpoitem') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Item">Item<% if (page.orderBy == 'Item') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Exposition">Exposition<% if (page.orderBy == 'Exposition') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Type">Type<% if (page.orderBy == 'Type') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idexpoitem')) %>">
				<td><%= _.escape(item.get('idexpoitem') || '') %></td>
				<td><%= _.escape(item.get('item') || '') %></td>
				<td><%= _.escape(item.get('exposition') || '') %></td>
				<td><%= _.escape(item.get('type') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="expo_itemModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idexpoitemInputContainer" class="control-group">
					<label class="control-label" for="idexpoitem">Idexpoitem</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idexpoitem"><%= _.escape(item.get('idexpoitem') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="itemInputContainer" class="control-group">
					<label class="control-label" for="item">Item</label>
					<div class="controls inline-inputs">
						<select id="item" name="item"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="expositionInputContainer" class="control-group">
					<label class="control-label" for="exposition">Exposition</label>
					<div class="controls inline-inputs">
						<select id="exposition" name="exposition"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="typeInputContainer" class="control-group">
					<label class="control-label" for="type">Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="type" placeholder="Type" value="<%= _.escape(item.get('type') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteexpo_itemButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteexpo_itemButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete expo_item</button>
						<span id="confirmDeleteexpo_itemContainer" class="hide">
							<button id="cancelDeleteexpo_itemButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteexpo_itemButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="expo_itemDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit expo_item
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="expo_itemModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveexpo_itemButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="expo_itemCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newexpo_itemButton" class="btn btn-primary">Add expo_item</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
