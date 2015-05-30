<?php
	$this->assign('title','sistema | dimensoes_items');
	$this->assign('nav','dimensoes_items');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/dimensoes_items.js").wait(function(){
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
	<i class="icon-th-list"></i> dimensoes_items
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="dimensao_itemCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Item">Item<% if (page.orderBy == 'Item') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Dimensiontype">Dimensiontype<% if (page.orderBy == 'Dimensiontype') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Dimensionunit">Dimensionunit<% if (page.orderBy == 'Dimensionunit') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Dimensionvalue">Dimensionvalue<% if (page.orderBy == 'Dimensionvalue') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('item') || '') %></td>
				<td><%= _.escape(item.get('dimensiontype') || '') %></td>
				<td><%= _.escape(item.get('dimensionunit') || '') %></td>
				<td><%= _.escape(item.get('dimensionvalue') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="dimensao_itemModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
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
				<div id="dimensiontypeInputContainer" class="control-group">
					<label class="control-label" for="dimensiontype">Dimensiontype</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dimensiontype" placeholder="Dimensiontype" value="<%= _.escape(item.get('dimensiontype') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dimensionunitInputContainer" class="control-group">
					<label class="control-label" for="dimensionunit">Dimensionunit</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dimensionunit" placeholder="Dimensionunit" value="<%= _.escape(item.get('dimensionunit') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dimensionvalueInputContainer" class="control-group">
					<label class="control-label" for="dimensionvalue">Dimensionvalue</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dimensionvalue" placeholder="Dimensionvalue" value="<%= _.escape(item.get('dimensionvalue') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletedimensao_itemButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletedimensao_itemButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete dimensao_item</button>
						<span id="confirmDeletedimensao_itemContainer" class="hide">
							<button id="cancelDeletedimensao_itemButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletedimensao_itemButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="dimensao_itemDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit dimensao_item
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="dimensao_itemModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savedimensao_itemButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="dimensao_itemCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newdimensao_itemButton" class="btn btn-primary">Add dimensao_item</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
