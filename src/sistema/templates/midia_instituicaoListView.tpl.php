<?php
	$this->assign('title','sistema | midia_instituicoes');
	$this->assign('nav','midia_instituicoes');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/midia_instituicoes.js").wait(function(){
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
	<i class="icon-th-list"></i> midia_instituicoes
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="midia_instituicaoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_InstitutionIdinstitution">Institution Idinstitution<% if (page.orderBy == 'InstitutionIdinstitution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_MediasIdmedia">Medias Idmedia<% if (page.orderBy == 'MediasIdmedia') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('institutionIdinstitution')) %>">
				<td><%= _.escape(item.get('institutionIdinstitution') || '') %></td>
				<td><%= _.escape(item.get('mediasIdmedia') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="midia_instituicaoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="institutionIdinstitutionInputContainer" class="control-group">
					<label class="control-label" for="institutionIdinstitution">Institution Idinstitution</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="institutionIdinstitution" placeholder="Institution Idinstitution" value="<%= _.escape(item.get('institutionIdinstitution') || '') %>">
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
		<form id="deletemidia_instituicaoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletemidia_instituicaoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete midia_instituicao</button>
						<span id="confirmDeletemidia_instituicaoContainer" class="hide">
							<button id="cancelDeletemidia_instituicaoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletemidia_instituicaoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="midia_instituicaoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit midia_instituicao
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="midia_instituicaoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savemidia_instituicaoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="midia_instituicaoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newmidia_instituicaoButton" class="btn btn-primary">Add midia_instituicao</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
