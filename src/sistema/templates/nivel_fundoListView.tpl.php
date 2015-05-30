<?php
	$this->assign('title','sistema | niveis_fundos');
	$this->assign('nav','niveis_fundos');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/niveis_fundos.js").wait(function(){
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
	<i class="icon-th-list"></i> niveis_fundos
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="nivel_fundoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_FondIdfond">Fond Idfond<% if (page.orderBy == 'FondIdfond') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_LevelsIdlevel">Levels Idlevel<% if (page.orderBy == 'LevelsIdlevel') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('fondIdfond')) %>">
				<td><%= _.escape(item.get('fondIdfond') || '') %></td>
				<td><%= _.escape(item.get('levelsIdlevel') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="nivel_fundoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="fondIdfondInputContainer" class="control-group">
					<label class="control-label" for="fondIdfond">Fond Idfond</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="fondIdfond" placeholder="Fond Idfond" value="<%= _.escape(item.get('fondIdfond') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="levelsIdlevelInputContainer" class="control-group">
					<label class="control-label" for="levelsIdlevel">Levels Idlevel</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="levelsIdlevel" placeholder="Levels Idlevel" value="<%= _.escape(item.get('levelsIdlevel') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletenivel_fundoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletenivel_fundoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete nivel_fundo</button>
						<span id="confirmDeletenivel_fundoContainer" class="hide">
							<button id="cancelDeletenivel_fundoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletenivel_fundoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="nivel_fundoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit nivel_fundo
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="nivel_fundoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savenivel_fundoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="nivel_fundoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newnivel_fundoButton" class="btn btn-primary">Add nivel_fundo</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
