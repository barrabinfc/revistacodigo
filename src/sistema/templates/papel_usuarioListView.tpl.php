<?php
	$this->assign('title','sistema | papeis_usuarios');
	$this->assign('nav','papeis_usuarios');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/papeis_usuarios.js").wait(function(){
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
	<i class="icon-th-list"></i> papeis_usuarios
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="papel_usuarioCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Iduserrole">Iduserrole<% if (page.orderBy == 'Iduserrole') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_User">User<% if (page.orderBy == 'User') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Role">Role<% if (page.orderBy == 'Role') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('iduserrole')) %>">
				<td><%= _.escape(item.get('iduserrole') || '') %></td>
				<td><%= _.escape(item.get('user') || '') %></td>
				<td><%= _.escape(item.get('role') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="papel_usuarioModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="iduserroleInputContainer" class="control-group">
					<label class="control-label" for="iduserrole">Iduserrole</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="iduserrole"><%= _.escape(item.get('iduserrole') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="userInputContainer" class="control-group">
					<label class="control-label" for="user">User</label>
					<div class="controls inline-inputs">
						<select id="user" name="user"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="roleInputContainer" class="control-group">
					<label class="control-label" for="role">Role</label>
					<div class="controls inline-inputs">
						<select id="role" name="role"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletepapel_usuarioButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletepapel_usuarioButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete papel_usuario</button>
						<span id="confirmDeletepapel_usuarioContainer" class="hide">
							<button id="cancelDeletepapel_usuarioButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletepapel_usuarioButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="papel_usuarioDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit papel_usuario
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="papel_usuarioModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savepapel_usuarioButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="papel_usuarioCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newpapel_usuarioButton" class="btn btn-primary">Add papel_usuario</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
