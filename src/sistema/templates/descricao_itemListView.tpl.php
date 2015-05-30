<?php
	$this->assign('title','sistema | descricao_items');
	$this->assign('nav','descricao_items');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/descricao_items.js").wait(function(){
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
	<i class="icon-th-list"></i> descricao_items
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="descricao_itemCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_D">D<% if (page.orderBy == 'D') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Tem">Tem<% if (page.orderBy == 'Tem') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nscriptiontype">Nscriptiontype<% if (page.orderBy == 'Nscriptiontype') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nscriptiondescription">Nscriptiondescription<% if (page.orderBy == 'Nscriptiondescription') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nscriptionlocation">Nscriptionlocation<% if (page.orderBy == 'Nscriptionlocation') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('d')) %>">
				<td><%= _.escape(item.get('d') || '') %></td>
				<td><%= _.escape(item.get('tem') || '') %></td>
				<td><%= _.escape(item.get('nscriptiontype') || '') %></td>
				<td><%= _.escape(item.get('nscriptiondescription') || '') %></td>
				<td><%= _.escape(item.get('nscriptionlocation') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="descricao_itemModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="dInputContainer" class="control-group">
					<label class="control-label" for="d">D</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="d"><%= _.escape(item.get('d') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="temInputContainer" class="control-group">
					<label class="control-label" for="tem">Tem</label>
					<div class="controls inline-inputs">
						<select id="tem" name="tem"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nscriptiontypeInputContainer" class="control-group">
					<label class="control-label" for="nscriptiontype">Nscriptiontype</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nscriptiontype" placeholder="Nscriptiontype" value="<%= _.escape(item.get('nscriptiontype') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nscriptiondescriptionInputContainer" class="control-group">
					<label class="control-label" for="nscriptiondescription">Nscriptiondescription</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nscriptiondescription" placeholder="Nscriptiondescription" value="<%= _.escape(item.get('nscriptiondescription') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nscriptionlocationInputContainer" class="control-group">
					<label class="control-label" for="nscriptionlocation">Nscriptionlocation</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nscriptionlocation" placeholder="Nscriptionlocation" value="<%= _.escape(item.get('nscriptionlocation') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletedescricao_itemButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletedescricao_itemButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete descricao_item</button>
						<span id="confirmDeletedescricao_itemContainer" class="hide">
							<button id="cancelDeletedescricao_itemButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletedescricao_itemButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="descricao_itemDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit descricao_item
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="descricao_itemModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savedescricao_itemButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="descricao_itemCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newdescricao_itemButton" class="btn btn-primary">Add descricao_item</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
