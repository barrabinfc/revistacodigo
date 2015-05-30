<?php
	$this->assign('title','sistema | authorities');
	$this->assign('nav','authorities');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/authorities.js").wait(function(){
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
	<i class="icon-th-list"></i> authorities
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="autoridadeCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idauthority">Idauthority<% if (page.orderBy == 'Idauthority') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Audisplay">Audisplay<% if (page.orderBy == 'Audisplay') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Aulist">Aulist<% if (page.orderBy == 'Aulist') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Auinsert">Auinsert<% if (page.orderBy == 'Auinsert') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Auupdate">Auupdate<% if (page.orderBy == 'Auupdate') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Auread">Auread<% if (page.orderBy == 'Auread') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Audelete">Audelete<% if (page.orderBy == 'Audelete') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Auexecute">Auexecute<% if (page.orderBy == 'Auexecute') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Auexport">Auexport<% if (page.orderBy == 'Auexport') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Module">Module<% if (page.orderBy == 'Module') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Institution">Institution<% if (page.orderBy == 'Institution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idauthority')) %>">
				<td><%= _.escape(item.get('idauthority') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('audisplay') || '') %></td>
				<td><%= _.escape(item.get('aulist') || '') %></td>
				<td><%= _.escape(item.get('auinsert') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('auupdate') || '') %></td>
				<td><%= _.escape(item.get('auread') || '') %></td>
				<td><%= _.escape(item.get('audelete') || '') %></td>
				<td><%= _.escape(item.get('auexecute') || '') %></td>
				<td><%= _.escape(item.get('auexport') || '') %></td>
				<td><%= _.escape(item.get('module') || '') %></td>
				<td><%= _.escape(item.get('institution') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="autoridadeModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idauthorityInputContainer" class="control-group">
					<label class="control-label" for="idauthority">Idauthority</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idauthority"><%= _.escape(item.get('idauthority') || '') %></span>
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
				<div id="audisplayInputContainer" class="control-group">
					<label class="control-label" for="audisplay">Audisplay</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="audisplay" placeholder="Audisplay" value="<%= _.escape(item.get('audisplay') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="aulistInputContainer" class="control-group">
					<label class="control-label" for="aulist">Aulist</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="aulist" placeholder="Aulist" value="<%= _.escape(item.get('aulist') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="auinsertInputContainer" class="control-group">
					<label class="control-label" for="auinsert">Auinsert</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="auinsert" placeholder="Auinsert" value="<%= _.escape(item.get('auinsert') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="auupdateInputContainer" class="control-group">
					<label class="control-label" for="auupdate">Auupdate</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="auupdate" placeholder="Auupdate" value="<%= _.escape(item.get('auupdate') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="aureadInputContainer" class="control-group">
					<label class="control-label" for="auread">Auread</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="auread" placeholder="Auread" value="<%= _.escape(item.get('auread') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="audeleteInputContainer" class="control-group">
					<label class="control-label" for="audelete">Audelete</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="audelete" placeholder="Audelete" value="<%= _.escape(item.get('audelete') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="auexecuteInputContainer" class="control-group">
					<label class="control-label" for="auexecute">Auexecute</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="auexecute" placeholder="Auexecute" value="<%= _.escape(item.get('auexecute') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="auexportInputContainer" class="control-group">
					<label class="control-label" for="auexport">Auexport</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="auexport" placeholder="Auexport" value="<%= _.escape(item.get('auexport') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="moduleInputContainer" class="control-group">
					<label class="control-label" for="module">Module</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="module" placeholder="Module" value="<%= _.escape(item.get('module') || '') %>">
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
		<form id="deleteautoridadeButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteautoridadeButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete autoridade</button>
						<span id="confirmDeleteautoridadeContainer" class="hide">
							<button id="cancelDeleteautoridadeButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteautoridadeButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="autoridadeDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit autoridade
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="autoridadeModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveautoridadeButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="autoridadeCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newautoridadeButton" class="btn btn-primary">Add autoridade</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
