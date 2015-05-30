<?php
	$this->assign('title','sistema | exposicao_historicos');
	$this->assign('nav','exposicao_historicos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/exposicao_historicos.js").wait(function(){
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
	<i class="icon-th-list"></i> exposicao_historicos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="exposicao_historicoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idhistory">Idhistory<% if (page.orderBy == 'Idhistory') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Type">Type<% if (page.orderBy == 'Type') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Idexposition">Idexposition<% if (page.orderBy == 'Idexposition') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_History">History<% if (page.orderBy == 'History') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idhistory')) %>">
				<td><%= _.escape(item.get('idhistory') || '') %></td>
				<td><%= _.escape(item.get('type') || '') %></td>
				<td><%= _.escape(item.get('idexposition') || '') %></td>
				<td><%= _.escape(item.get('history') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="exposicao_historicoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idhistoryInputContainer" class="control-group">
					<label class="control-label" for="idhistory">Idhistory</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idhistory"><%= _.escape(item.get('idhistory') || '') %></span>
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
				<div id="idexpositionInputContainer" class="control-group">
					<label class="control-label" for="idexposition">Idexposition</label>
					<div class="controls inline-inputs">
						<select id="idexposition" name="idexposition"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="historyInputContainer" class="control-group">
					<label class="control-label" for="history">History</label>
					<div class="controls inline-inputs">
						<select id="history" name="history"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteexposicao_historicoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteexposicao_historicoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete exposicao_historico</button>
						<span id="confirmDeleteexposicao_historicoContainer" class="hide">
							<button id="cancelDeleteexposicao_historicoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteexposicao_historicoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="exposicao_historicoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit exposicao_historico
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="exposicao_historicoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveexposicao_historicoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="exposicao_historicoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newexposicao_historicoButton" class="btn btn-primary">Add exposicao_historico</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
