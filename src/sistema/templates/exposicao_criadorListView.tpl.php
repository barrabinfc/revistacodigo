<?php
	$this->assign('title','sistema | exposicao_criadores');
	$this->assign('nav','exposicao_criadores');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/exposicao_criadores.js").wait(function(){
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
	<i class="icon-th-list"></i> exposicao_criadores
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="exposicao_criadorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Attributed">Attributed<% if (page.orderBy == 'Attributed') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Location">Location<% if (page.orderBy == 'Location') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Type">Type<% if (page.orderBy == 'Type') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Creator">Creator<% if (page.orderBy == 'Creator') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Exposition">Exposition<% if (page.orderBy == 'Exposition') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('attributed') || '') %></td>
				<td><%= _.escape(item.get('location') || '') %></td>
				<td><%= _.escape(item.get('type') || '') %></td>
				<td><%= _.escape(item.get('creator') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('exposition') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="exposicao_criadorModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="attributedInputContainer" class="control-group">
					<label class="control-label" for="attributed">Attributed</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="attributed" placeholder="Attributed" value="<%= _.escape(item.get('attributed') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="locationInputContainer" class="control-group">
					<label class="control-label" for="location">Location</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="location" placeholder="Location" value="<%= _.escape(item.get('location') || '') %>">
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
				<div id="creatorInputContainer" class="control-group">
					<label class="control-label" for="creator">Creator</label>
					<div class="controls inline-inputs">
						<select id="creator" name="creator"></select>
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
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteexposicao_criadorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteexposicao_criadorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete exposicao_criador</button>
						<span id="confirmDeleteexposicao_criadorContainer" class="hide">
							<button id="cancelDeleteexposicao_criadorButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteexposicao_criadorButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="exposicao_criadorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit exposicao_criador
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="exposicao_criadorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveexposicao_criadorButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="exposicao_criadorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newexposicao_criadorButton" class="btn btn-primary">Add exposicao_criador</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
