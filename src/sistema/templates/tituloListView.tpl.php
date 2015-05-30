<?php
	$this->assign('title','sistema | titulos');
	$this->assign('nav','titulos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/titulos.js").wait(function(){
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
	<i class="icon-th-list"></i> titulos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="tituloCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idtitle">Idtitle<% if (page.orderBy == 'Idtitle') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Value">Value<% if (page.orderBy == 'Value') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Item">Item<% if (page.orderBy == 'Item') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Institution">Institution<% if (page.orderBy == 'Institution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Defaulttitle">Defaulttitle<% if (page.orderBy == 'Defaulttitle') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idtitle')) %>">
				<td><%= _.escape(item.get('idtitle') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('value') || '') %></td>
				<td><%= _.escape(item.get('item') || '') %></td>
				<td><%= _.escape(item.get('institution') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('defaulttitle') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="tituloModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idtitleInputContainer" class="control-group">
					<label class="control-label" for="idtitle">Idtitle</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idtitle"><%= _.escape(item.get('idtitle') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nameInputContainer" class="control-group">
					<label class="control-label" for="name">Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="name" placeholder="Name" value="<%= _.escape(item.get('name') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="valueInputContainer" class="control-group">
					<label class="control-label" for="value">Value</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="value" placeholder="Value" value="<%= _.escape(item.get('value') || '') %>">
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
				<div id="institutionInputContainer" class="control-group">
					<label class="control-label" for="institution">Institution</label>
					<div class="controls inline-inputs">
						<select id="institution" name="institution"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="defaulttitleInputContainer" class="control-group">
					<label class="control-label" for="defaulttitle">Defaulttitle</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="defaulttitle" placeholder="Defaulttitle" value="<%= _.escape(item.get('defaulttitle') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletetituloButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletetituloButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete titulo</button>
						<span id="confirmDeletetituloContainer" class="hide">
							<button id="cancelDeletetituloButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletetituloButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="tituloDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit titulo
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="tituloModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savetituloButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="tituloCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newtituloButton" class="btn btn-primary">Add titulo</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
