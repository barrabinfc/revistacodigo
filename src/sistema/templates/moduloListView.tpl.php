<?php
	$this->assign('title','sistema | modulos');
	$this->assign('nav','modulos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/modulos.js").wait(function(){
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
	<i class="icon-th-list"></i> modulos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="moduloCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idmodule">Idmodule<% if (page.orderBy == 'Idmodule') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Moname">Moname<% if (page.orderBy == 'Moname') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Mokeyname">Mokeyname<% if (page.orderBy == 'Mokeyname') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Institution">Institution<% if (page.orderBy == 'Institution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idmodule')) %>">
				<td><%= _.escape(item.get('idmodule') || '') %></td>
				<td><%= _.escape(item.get('moname') || '') %></td>
				<td><%= _.escape(item.get('mokeyname') || '') %></td>
				<td><%= _.escape(item.get('institution') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="moduloModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idmoduleInputContainer" class="control-group">
					<label class="control-label" for="idmodule">Idmodule</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idmodule"><%= _.escape(item.get('idmodule') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="monameInputContainer" class="control-group">
					<label class="control-label" for="moname">Moname</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="moname" placeholder="Moname" value="<%= _.escape(item.get('moname') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="mokeynameInputContainer" class="control-group">
					<label class="control-label" for="mokeyname">Mokeyname</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="mokeyname" placeholder="Mokeyname" value="<%= _.escape(item.get('mokeyname') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="institutionInputContainer" class="control-group">
					<label class="control-label" for="institution">Institution</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="institution" placeholder="Institution" value="<%= _.escape(item.get('institution') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletemoduloButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletemoduloButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete modulo</button>
						<span id="confirmDeletemoduloContainer" class="hide">
							<button id="cancelDeletemoduloButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletemoduloButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="moduloDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit modulo
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="moduloModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savemoduloButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="moduloCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newmoduloButton" class="btn btn-primary">Add modulo</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
