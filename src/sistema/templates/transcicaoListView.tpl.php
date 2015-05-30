<?php
	$this->assign('title','sistema | transcricoes');
	$this->assign('nav','transcricoes');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/transcricoes.js").wait(function(){
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
	<i class="icon-th-list"></i> transcricoes
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="transcicaoCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Idtranscription">Idtranscription<% if (page.orderBy == 'Idtranscription') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Iditem">Iditem<% if (page.orderBy == 'Iditem') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Idmedia">Idmedia<% if (page.orderBy == 'Idmedia') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Institution">Institution<% if (page.orderBy == 'Institution') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Transcription">Transcription<% if (page.orderBy == 'Transcription') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Notes">Notes<% if (page.orderBy == 'Notes') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Language">Language<% if (page.orderBy == 'Language') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idtranscription')) %>">
				<td><%= _.escape(item.get('idtranscription') || '') %></td>
				<td><%= _.escape(item.get('iditem') || '') %></td>
				<td><%= _.escape(item.get('idmedia') || '') %></td>
				<td><%= _.escape(item.get('institution') || '') %></td>
				<td><%= _.escape(item.get('transcription') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('notes') || '') %></td>
				<td><%= _.escape(item.get('language') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="transcicaoModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idtranscriptionInputContainer" class="control-group">
					<label class="control-label" for="idtranscription">Idtranscription</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idtranscription"><%= _.escape(item.get('idtranscription') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="iditemInputContainer" class="control-group">
					<label class="control-label" for="iditem">Iditem</label>
					<div class="controls inline-inputs">
						<select id="iditem" name="iditem"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idmediaInputContainer" class="control-group">
					<label class="control-label" for="idmedia">Idmedia</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="idmedia" placeholder="Idmedia" value="<%= _.escape(item.get('idmedia') || '') %>">
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
				<div id="transcriptionInputContainer" class="control-group">
					<label class="control-label" for="transcription">Transcription</label>
					<div class="controls inline-inputs">
						<textarea class="input-xlarge" id="transcription" rows="3"><%= _.escape(item.get('transcription') || '') %></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="notesInputContainer" class="control-group">
					<label class="control-label" for="notes">Notes</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="notes" placeholder="Notes" value="<%= _.escape(item.get('notes') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="languageInputContainer" class="control-group">
					<label class="control-label" for="language">Language</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="language" placeholder="Language" value="<%= _.escape(item.get('language') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletetranscicaoButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletetranscicaoButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete transcicao</button>
						<span id="confirmDeletetranscicaoContainer" class="hide">
							<button id="cancelDeletetranscicaoButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletetranscicaoButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="transcicaoDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit transcicao
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="transcicaoModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savetranscicaoButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="transcicaoCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newtranscicaoButton" class="btn btn-primary">Add transcicao</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
