<?php
	$this->assign('title','sistema | nome_criadores');
	$this->assign('nav','nome_criadores');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/nome_criadores.js").wait(function(){
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
	<i class="icon-th-list"></i> nome_criadores
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="nome_criadorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idcreatorname">Idcreatorname<% if (page.orderBy == 'Idcreatorname') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Creator">Creator<% if (page.orderBy == 'Creator') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Naname">Naname<% if (page.orderBy == 'Naname') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Type">Type<% if (page.orderBy == 'Type') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idcreatorname')) %>">
				<td><%= _.escape(item.get('idcreatorname') || '') %></td>
				<td><%= _.escape(item.get('creator') || '') %></td>
				<td><%= _.escape(item.get('naname') || '') %></td>
				<td><%= _.escape(item.get('type') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="nome_criadorModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idcreatornameInputContainer" class="control-group">
					<label class="control-label" for="idcreatorname">Idcreatorname</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idcreatorname"><%= _.escape(item.get('idcreatorname') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="creatorInputContainer" class="control-group">
					<label class="control-label" for="creator">Creator</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="creator" placeholder="Creator" value="<%= _.escape(item.get('creator') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nanameInputContainer" class="control-group">
					<label class="control-label" for="naname">Naname</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="naname" placeholder="Naname" value="<%= _.escape(item.get('naname') || '') %>">
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
		<form id="deletenome_criadorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletenome_criadorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete nome_criador</button>
						<span id="confirmDeletenome_criadorContainer" class="hide">
							<button id="cancelDeletenome_criadorButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletenome_criadorButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="nome_criadorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit nome_criador
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="nome_criadorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savenome_criadorButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="nome_criadorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newnome_criadorButton" class="btn btn-primary">Add nome_criador</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
