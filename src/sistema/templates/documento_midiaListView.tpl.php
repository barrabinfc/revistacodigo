<?php
	$this->assign('title','sistema | documentos_midias');
	$this->assign('nav','documentos_midias');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/documentos_midias.js").wait(function(){
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
	<i class="icon-th-list"></i> documentos_midias
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="documento_midiaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_DocumentationIddocumentation">Documentation Iddocumentation<% if (page.orderBy == 'DocumentationIddocumentation') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_MediasIdmedia">Medias Idmedia<% if (page.orderBy == 'MediasIdmedia') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('documentationIddocumentation')) %>">
				<td><%= _.escape(item.get('documentationIddocumentation') || '') %></td>
				<td><%= _.escape(item.get('mediasIdmedia') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="documento_midiaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="documentationIddocumentationInputContainer" class="control-group">
					<label class="control-label" for="documentationIddocumentation">Documentation Iddocumentation</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="documentationIddocumentation" placeholder="Documentation Iddocumentation" value="<%= _.escape(item.get('documentationIddocumentation') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="mediasIdmediaInputContainer" class="control-group">
					<label class="control-label" for="mediasIdmedia">Medias Idmedia</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="mediasIdmedia" placeholder="Medias Idmedia" value="<%= _.escape(item.get('mediasIdmedia') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletedocumento_midiaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletedocumento_midiaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete documento_midia</button>
						<span id="confirmDeletedocumento_midiaContainer" class="hide">
							<button id="cancelDeletedocumento_midiaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletedocumento_midiaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="documento_midiaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit documento_midia
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="documento_midiaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savedocumento_midiaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="documento_midiaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newdocumento_midiaButton" class="btn btn-primary">Add documento_midia</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
