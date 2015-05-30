<?php
	$this->assign('title','sistema | cidades');
	$this->assign('nav','cidades');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/cidades.js").wait(function(){
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
	<i class="icon-th-list"></i> cidades
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="cidadeCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idcity">Idcity<% if (page.orderBy == 'Idcity') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_State">State<% if (page.orderBy == 'State') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Institution">Institution<% if (page.orderBy == 'Institution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Citypublic">Citypublic<% if (page.orderBy == 'Citypublic') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_City">City<% if (page.orderBy == 'City') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Citycode">Citycode<% if (page.orderBy == 'Citycode') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idcity')) %>">
				<td><%= _.escape(item.get('idcity') || '') %></td>
				<td><%= _.escape(item.get('state') || '') %></td>
				<td><%= _.escape(item.get('institution') || '') %></td>
				<td><%= _.escape(item.get('citypublic') || '') %></td>
				<td><%= _.escape(item.get('city') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('citycode') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="cidadeModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idcityInputContainer" class="control-group">
					<label class="control-label" for="idcity">Idcity</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idcity"><%= _.escape(item.get('idcity') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="stateInputContainer" class="control-group">
					<label class="control-label" for="state">State</label>
					<div class="controls inline-inputs">
						<select id="state" name="state"></select>
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
				<div id="citypublicInputContainer" class="control-group">
					<label class="control-label" for="citypublic">Citypublic</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="citypublic" placeholder="Citypublic" value="<%= _.escape(item.get('citypublic') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="cityInputContainer" class="control-group">
					<label class="control-label" for="city">City</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="city" placeholder="City" value="<%= _.escape(item.get('city') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="citycodeInputContainer" class="control-group">
					<label class="control-label" for="citycode">Citycode</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="citycode" placeholder="Citycode" value="<%= _.escape(item.get('citycode') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletecidadeButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletecidadeButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete cidade</button>
						<span id="confirmDeletecidadeContainer" class="hide">
							<button id="cancelDeletecidadeButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletecidadeButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="cidadeDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit cidade
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="cidadeModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savecidadeButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="cidadeCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newcidadeButton" class="btn btn-primary">Add cidade</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
