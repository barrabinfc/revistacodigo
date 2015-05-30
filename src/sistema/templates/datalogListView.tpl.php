<?php
	$this->assign('title','sistema | datalogs');
	$this->assign('nav','datalogs');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/datalogs.js").wait(function(){
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
	<i class="icon-th-list"></i> datalogs
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="datalogCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Iddatalog">Iddatalog<% if (page.orderBy == 'Iddatalog') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Xml">Xml<% if (page.orderBy == 'Xml') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Institution">Institution<% if (page.orderBy == 'Institution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('iddatalog')) %>">
				<td><%= _.escape(item.get('iddatalog') || '') %></td>
				<td><%= _.escape(item.get('xml') || '') %></td>
				<td><%= _.escape(item.get('institution') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="datalogModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="iddatalogInputContainer" class="control-group">
					<label class="control-label" for="iddatalog">Iddatalog</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="iddatalog"><%= _.escape(item.get('iddatalog') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="xmlInputContainer" class="control-group">
					<label class="control-label" for="xml">Xml</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="xml" placeholder="Xml" value="<%= _.escape(item.get('xml') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="institutionInputContainer" class="control-group">
					<label class="control-label" for="institution">Institution</label>
					<div class="controls inline-inputs">
						<select id="institution" name="institution"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletedatalogButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletedatalogButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete datalog</button>
						<span id="confirmDeletedatalogContainer" class="hide">
							<button id="cancelDeletedatalogButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletedatalogButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="datalogDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit datalog
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="datalogModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savedatalogButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="datalogCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newdatalogButton" class="btn btn-primary">Add datalog</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
