<?php
	$this->assign('title','sistema | creator_award_honours');
	$this->assign('nav','creator_award_honours');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/creator_award_honours.js").wait(function(){
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
	<i class="icon-th-list"></i> creator_award_honours
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="creator_award_honourCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Description">Description<% if (page.orderBy == 'Description') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Grantedby">Grantedby<% if (page.orderBy == 'Grantedby') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Title">Title<% if (page.orderBy == 'Title') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Type">Type<% if (page.orderBy == 'Type') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Creator">Creator<% if (page.orderBy == 'Creator') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('description') || '') %></td>
				<td><%= _.escape(item.get('grantedby') || '') %></td>
				<td><%= _.escape(item.get('title') || '') %></td>
				<td><%= _.escape(item.get('type') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('creator') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="creator_award_honourModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="descriptionInputContainer" class="control-group">
					<label class="control-label" for="description">Description</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="description" placeholder="Description" value="<%= _.escape(item.get('description') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="grantedbyInputContainer" class="control-group">
					<label class="control-label" for="grantedby">Grantedby</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="grantedby" placeholder="Grantedby" value="<%= _.escape(item.get('grantedby') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="titleInputContainer" class="control-group">
					<label class="control-label" for="title">Title</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="title" placeholder="Title" value="<%= _.escape(item.get('title') || '') %>">
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
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletecreator_award_honourButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletecreator_award_honourButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete creator_award_honour</button>
						<span id="confirmDeletecreator_award_honourContainer" class="hide">
							<button id="cancelDeletecreator_award_honourButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletecreator_award_honourButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="creator_award_honourDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit creator_award_honour
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="creator_award_honourModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savecreator_award_honourButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="creator_award_honourCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newcreator_award_honourButton" class="btn btn-primary">Add creator_award_honour</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
