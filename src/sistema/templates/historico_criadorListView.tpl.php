<?php
	$this->assign('title','sistema | historico_criadores');
	$this->assign('nav','historico_criadores');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/historico_criadores.js").wait(function(){
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
	<i class="icon-th-list"></i> historico_criadores
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="historico_criadorCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Type">Type<% if (page.orderBy == 'Type') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Creator">Creator<% if (page.orderBy == 'Creator') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_History">History<% if (page.orderBy == 'History') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('type') || '') %></td>
				<td><%= _.escape(item.get('creator') || '') %></td>
				<td><%= _.escape(item.get('history') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="historico_criadorModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
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
				<div id="historyInputContainer" class="control-group">
					<label class="control-label" for="history">History</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="history" placeholder="History" value="<%= _.escape(item.get('history') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletehistorico_criadorButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletehistorico_criadorButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete historico_criador</button>
						<span id="confirmDeletehistorico_criadorContainer" class="hide">
							<button id="cancelDeletehistorico_criadorButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletehistorico_criadorButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="historico_criadorDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit historico_criador
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="historico_criadorModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savehistorico_criadorButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="historico_criadorCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newhistorico_criadorButton" class="btn btn-primary">Add historico_criador</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
