<?php
	$this->assign('title','sistema | estados');
	$this->assign('nav','estados');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/estados.js").wait(function(){
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
	<i class="icon-th-list"></i> estados
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="estadoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idstate">Idstate<% if (page.orderBy == 'Idstate') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Country">Country<% if (page.orderBy == 'Country') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_State">State<% if (page.orderBy == 'State') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Statecode">Statecode<% if (page.orderBy == 'Statecode') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idstate')) %>">
				<td><%= _.escape(item.get('idstate') || '') %></td>
				<td><%= _.escape(item.get('country') || '') %></td>
				<td><%= _.escape(item.get('state') || '') %></td>
				<td><%= _.escape(item.get('statecode') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="estadoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idstateInputContainer" class="control-group">
					<label class="control-label" for="idstate">Idstate</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idstate"><%= _.escape(item.get('idstate') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="countryInputContainer" class="control-group">
					<label class="control-label" for="country">Country</label>
					<div class="controls inline-inputs">
						<select id="country" name="country"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="stateInputContainer" class="control-group">
					<label class="control-label" for="state">State</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="state" placeholder="State" value="<%= _.escape(item.get('state') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="statecodeInputContainer" class="control-group">
					<label class="control-label" for="statecode">Statecode</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="statecode" placeholder="Statecode" value="<%= _.escape(item.get('statecode') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteestadoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteestadoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete estado</button>
						<span id="confirmDeleteestadoContainer" class="hide">
							<button id="cancelDeleteestadoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteestadoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="estadoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit estado
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="estadoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveestadoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="estadoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newestadoButton" class="btn btn-primary">Add estado</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
