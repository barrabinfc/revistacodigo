<?php
	$this->assign('title','sistema | midia_referencias');
	$this->assign('nav','midia_referencias');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/midia_referencias.js").wait(function(){
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
	<i class="icon-th-list"></i> midia_referencias
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="midia_referenciaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_ReferenceIdreference">Reference Idreference<% if (page.orderBy == 'ReferenceIdreference') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_MediasIdmedia">Medias Idmedia<% if (page.orderBy == 'MediasIdmedia') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('referenceIdreference')) %>">
				<td><%= _.escape(item.get('referenceIdreference') || '') %></td>
				<td><%= _.escape(item.get('mediasIdmedia') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="midia_referenciaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="referenceIdreferenceInputContainer" class="control-group">
					<label class="control-label" for="referenceIdreference">Reference Idreference</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="referenceIdreference" placeholder="Reference Idreference" value="<%= _.escape(item.get('referenceIdreference') || '') %>">
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
		<form id="deletemidia_referenciaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletemidia_referenciaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete midia_referencia</button>
						<span id="confirmDeletemidia_referenciaContainer" class="hide">
							<button id="cancelDeletemidia_referenciaButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletemidia_referenciaButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="midia_referenciaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit midia_referencia
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="midia_referenciaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savemidia_referenciaButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="midia_referenciaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newmidia_referenciaButton" class="btn btn-primary">Add midia_referencia</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
