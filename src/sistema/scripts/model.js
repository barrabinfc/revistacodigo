/**
 * backbone model definitions for sistema
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 0;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * endereco Backbone Model
 */
model.enderecoModel = Backbone.Model.extend({
	urlRoot: 'api/endereco',
	idAttribute: 'idaddress',
	idaddress: '',
	city: '',
	contact: '',
	street: '',
	number: '',
	complement: '',
	zipcode: '',
	otherinformation: '',
	defaults: {
		'idaddress': null,
		'city': '',
		'contact': '',
		'street': '',
		'number': '',
		'complement': '',
		'zipcode': '',
		'otherinformation': ''
	}
});

/**
 * endereco Backbone Collection
 */
model.enderecoCollection = model.AbstractCollection.extend({
	url: 'api/enderecos',
	model: model.enderecoModel
});

/**
 * autoridade Backbone Model
 */
model.autoridadeModel = Backbone.Model.extend({
	urlRoot: 'api/autoridade',
	idAttribute: 'idauthority',
	idauthority: '',
	name: '',
	audisplay: '',
	aulist: '',
	auinsert: '',
	auupdate: '',
	auread: '',
	audelete: '',
	auexecute: '',
	auexport: '',
	module: '',
	institution: '',
	defaults: {
		'idauthority': null,
		'name': '',
		'audisplay': '',
		'aulist': '',
		'auinsert': '',
		'auupdate': '',
		'auread': '',
		'audelete': '',
		'auexecute': '',
		'auexport': '',
		'module': '',
		'institution': ''
	}
});

/**
 * autoridade Backbone Collection
 */
model.autoridadeCollection = model.AbstractCollection.extend({
	url: 'api/authorities',
	model: model.autoridadeModel
});

/**
 * autorole Backbone Model
 */
model.autoroleModel = Backbone.Model.extend({
	urlRoot: 'api/autorole',
	idAttribute: 'dautorole',
	dautorole: '',
	dauthority: '',
	drole: '',
	defaults: {
		'dautorole': null,
		'dauthority': '',
		'drole': ''
	}
});

/**
 * autorole Backbone Collection
 */
model.autoroleCollection = model.AbstractCollection.extend({
	url: 'api/autoroles',
	model: model.autoroleModel
});

/**
 * cidade Backbone Model
 */
model.cidadeModel = Backbone.Model.extend({
	urlRoot: 'api/cidade',
	idAttribute: 'idcity',
	idcity: '',
	state: '',
	institution: '',
	citypublic: '',
	city: '',
	citycode: '',
	defaults: {
		'idcity': null,
		'state': '',
		'institution': '',
		'citypublic': '',
		'city': '',
		'citycode': ''
	}
});

/**
 * cidade Backbone Collection
 */
model.cidadeCollection = model.AbstractCollection.extend({
	url: 'api/cidades',
	model: model.cidadeModel
});

/**
 * contato Backbone Model
 */
model.contatoModel = Backbone.Model.extend({
	urlRoot: 'api/contato',
	idAttribute: 'idcontact',
	idcontact: '',
	institution: '',
	iditem: '',
	idexposition: '',
	idholder: '',
	idcreator: '',
	user: '',
	contactname: '',
	urla: '',
	contactcall: '',
	company: '',
	uri: '',
	identity: '',
	federaltaxcode: '',
	statetaxcode: '',
	countytaxcode: '',
	defaults: {
		'idcontact': null,
		'institution': '',
		'iditem': '',
		'idexposition': '',
		'idholder': '',
		'idcreator': '',
		'user': '',
		'contactname': '',
		'urla': '',
		'contactcall': '',
		'company': '',
		'uri': '',
		'identity': '',
		'federaltaxcode': '',
		'statetaxcode': '',
		'countytaxcode': ''
	}
});

/**
 * contato Backbone Collection
 */
model.contatoCollection = model.AbstractCollection.extend({
	url: 'api/contatos',
	model: model.contatoModel
});

/**
 * pais Backbone Model
 */
model.paisModel = Backbone.Model.extend({
	urlRoot: 'api/pais',
	idAttribute: 'idcountry',
	idcountry: '',
	country: '',
	countrycode: '',
	defaults: {
		'idcountry': null,
		'country': '',
		'countrycode': ''
	}
});

/**
 * pais Backbone Collection
 */
model.paisCollection = model.AbstractCollection.extend({
	url: 'api/paises',
	model: model.paisModel
});

/**
 * criador Backbone Model
 */
model.criadorModel = Backbone.Model.extend({
	urlRoot: 'api/criador',
	idAttribute: 'idcreator',
	idcreator: '',
	institution: '',
	type: '',
	name: '',
	notes: '',
	birthdate: '',
	deathdate: '',
	nationality: '',
	maincontact: '',
	defaults: {
		'idcreator': null,
		'institution': '',
		'type': '',
		'name': '',
		'notes': '',
		'birthdate': '',
		'deathdate': '',
		'nationality': '',
		'maincontact': ''
	}
});

/**
 * criador Backbone Collection
 */
model.criadorCollection = model.AbstractCollection.extend({
	url: 'api/criadores',
	model: model.criadorModel
});

/**
 * creator_award_honour Backbone Model
 */
model.creator_award_honourModel = Backbone.Model.extend({
	urlRoot: 'api/creator_award_honour',
	idAttribute: 'id',
	id: '',
	description: '',
	grantedby: '',
	title: '',
	type: '',
	creator: '',
	defaults: {
		'id': null,
		'description': '',
		'grantedby': '',
		'title': '',
		'type': '',
		'creator': ''
	}
});

/**
 * creator_award_honour Backbone Collection
 */
model.creator_award_honourCollection = model.AbstractCollection.extend({
	url: 'api/creator_award_honours',
	model: model.creator_award_honourModel
});

/**
 * contato_criador Backbone Model
 */
model.contato_criadorModel = Backbone.Model.extend({
	urlRoot: 'api/contato_criador',
	idAttribute: 'id',
	id: '',
	type: '',
	contact: '',
	creator: '',
	defaults: {
		'id': null,
		'type': '',
		'contact': '',
		'creator': ''
	}
});

/**
 * contato_criador Backbone Collection
 */
model.contato_criadorCollection = model.AbstractCollection.extend({
	url: 'api/contatos_criadores',
	model: model.contato_criadorModel
});

/**
 * historico_criador Backbone Model
 */
model.historico_criadorModel = Backbone.Model.extend({
	urlRoot: 'api/historico_criador',
	idAttribute: 'id',
	id: '',
	type: '',
	creator: '',
	history: '',
	defaults: {
		'id': null,
		'type': '',
		'creator': '',
		'history': ''
	}
});

/**
 * historico_criador Backbone Collection
 */
model.historico_criadorCollection = model.AbstractCollection.extend({
	url: 'api/historico_criadores',
	model: model.historico_criadorModel
});

/**
 * referencia_criador Backbone Model
 */
model.referencia_criadorModel = Backbone.Model.extend({
	urlRoot: 'api/referencia_criador',
	idAttribute: 'id',
	id: '',
	type: '',
	creator: '',
	reference: '',
	defaults: {
		'id': null,
		'type': '',
		'creator': '',
		'reference': ''
	}
});

/**
 * referencia_criador Backbone Collection
 */
model.referencia_criadorCollection = model.AbstractCollection.extend({
	url: 'api/referencias_criadores',
	model: model.referencia_criadorModel
});

/**
 * nome_criador Backbone Model
 */
model.nome_criadorModel = Backbone.Model.extend({
	urlRoot: 'api/nome_criador',
	idAttribute: 'idcreatorname',
	idcreatorname: '',
	creator: '',
	naname: '',
	type: '',
	defaults: {
		'idcreatorname': null,
		'creator': '',
		'naname': '',
		'type': ''
	}
});

/**
 * nome_criador Backbone Collection
 */
model.nome_criadorCollection = model.AbstractCollection.extend({
	url: 'api/nome_criadores',
	model: model.nome_criadorModel
});

/**
 * datalog Backbone Model
 */
model.datalogModel = Backbone.Model.extend({
	urlRoot: 'api/datalog',
	idAttribute: 'iddatalog',
	iddatalog: '',
	xml: '',
	institution: '',
	defaults: {
		'iddatalog': null,
		'xml': '',
		'institution': ''
	}
});

/**
 * datalog Backbone Collection
 */
model.datalogCollection = model.AbstractCollection.extend({
	url: 'api/datalogs',
	model: model.datalogModel
});

/**
 * dimensao Backbone Model
 */
model.dimensaoModel = Backbone.Model.extend({
	urlRoot: 'api/dimensao',
	idAttribute: 'id',
	id: '',
	unit: '',
	value: '',
	defaults: {
		'id': null,
		'unit': '',
		'value': ''
	}
});

/**
 * dimensao Backbone Collection
 */
model.dimensaoCollection = model.AbstractCollection.extend({
	url: 'api/dimensoes',
	model: model.dimensaoModel
});

/**
 * documento Backbone Model
 */
model.documentoModel = Backbone.Model.extend({
	urlRoot: 'api/documento',
	idAttribute: 'iddocumentation',
	iddocumentation: '',
	item: '',
	institution: '',
	type: '',
	description: '',
	notes: '',
	defaults: {
		'iddocumentation': null,
		'item': '',
		'institution': '',
		'type': '',
		'description': '',
		'notes': ''
	}
});

/**
 * documento Backbone Collection
 */
model.documentoCollection = model.AbstractCollection.extend({
	url: 'api/documentos',
	model: model.documentoModel
});

/**
 * documento_midia Backbone Model
 */
model.documento_midiaModel = Backbone.Model.extend({
	urlRoot: 'api/documento_midia',
	idAttribute: 'documentationIddocumentation',
	documentationIddocumentation: '',
	mediasIdmedia: '',
	defaults: {
		'documentationIddocumentation': null,
		'mediasIdmedia': ''
	}
});

/**
 * documento_midia Backbone Collection
 */
model.documento_midiaCollection = model.AbstractCollection.extend({
	url: 'api/documentos_midias',
	model: model.documento_midiaModel
});

/**
 * expo_item Backbone Model
 */
model.expo_itemModel = Backbone.Model.extend({
	urlRoot: 'api/expo_item',
	idAttribute: 'idexpoitem',
	idexpoitem: '',
	item: '',
	exposition: '',
	type: '',
	defaults: {
		'idexpoitem': null,
		'item': '',
		'exposition': '',
		'type': ''
	}
});

/**
 * expo_item Backbone Collection
 */
model.expo_itemCollection = model.AbstractCollection.extend({
	url: 'api/expo_items',
	model: model.expo_itemModel
});

/**
 * expoisicao Backbone Model
 */
model.expoisicaoModel = Backbone.Model.extend({
	urlRoot: 'api/expoisicao',
	idAttribute: 'idexposition',
	idexposition: '',
	institution: '',
	location: '',
	curator: '',
	initialdate: '',
	enddate: '',
	description: '',
	notes: '',
	name: '',
	exposubtype: '',
	expotype: '',
	iscarriedbyotherinstitution: '',
	isinternational: '',
	otherinfo: '',
	defaults: {
		'idexposition': null,
		'institution': '',
		'location': '',
		'curator': '',
		'initialdate': '',
		'enddate': '',
		'description': '',
		'notes': '',
		'name': '',
		'exposubtype': '',
		'expotype': '',
		'iscarriedbyotherinstitution': '',
		'isinternational': '',
		'otherinfo': ''
	}
});

/**
 * expoisicao Backbone Collection
 */
model.expoisicaoCollection = model.AbstractCollection.extend({
	url: 'api/exposicoes',
	model: model.expoisicaoModel
});

/**
 * exposicao_criador Backbone Model
 */
model.exposicao_criadorModel = Backbone.Model.extend({
	urlRoot: 'api/exposicao_criador',
	idAttribute: 'id',
	id: '',
	attributed: '',
	location: '',
	type: '',
	creator: '',
	exposition: '',
	defaults: {
		'id': null,
		'attributed': '',
		'location': '',
		'type': '',
		'creator': '',
		'exposition': ''
	}
});

/**
 * exposicao_criador Backbone Collection
 */
model.exposicao_criadorCollection = model.AbstractCollection.extend({
	url: 'api/exposicao_criadores',
	model: model.exposicao_criadorModel
});

/**
 * dimensao_exposicao Backbone Model
 */
model.dimensao_exposicaoModel = Backbone.Model.extend({
	urlRoot: 'api/dimensao_exposicao',
	idAttribute: 'id',
	id: '',
	type: '',
	dimension: '',
	exposition: '',
	defaults: {
		'id': null,
		'type': '',
		'dimension': '',
		'exposition': ''
	}
});

/**
 * dimensao_exposicao Backbone Collection
 */
model.dimensao_exposicaoCollection = model.AbstractCollection.extend({
	url: 'api/dimensao_exposicoes',
	model: model.dimensao_exposicaoModel
});

/**
 * exposicao_historico Backbone Model
 */
model.exposicao_historicoModel = Backbone.Model.extend({
	urlRoot: 'api/exposicao_historico',
	idAttribute: 'idhistory',
	idhistory: '',
	type: '',
	idexposition: '',
	history: '',
	defaults: {
		'idhistory': null,
		'type': '',
		'idexposition': '',
		'history': ''
	}
});

/**
 * exposicao_historico Backbone Collection
 */
model.exposicao_historicoCollection = model.AbstractCollection.extend({
	url: 'api/exposicao_historicos',
	model: model.exposicao_historicoModel
});

/**
 * local_exposicao Backbone Model
 */
model.local_exposicaoModel = Backbone.Model.extend({
	urlRoot: 'api/local_exposicao',
	idAttribute: 'id',
	id: '',
	type: '',
	contact: '',
	placelocation: '',
	exposition: '',
	defaults: {
		'id': null,
		'type': '',
		'contact': '',
		'placelocation': '',
		'exposition': ''
	}
});

/**
 * local_exposicao Backbone Collection
 */
model.local_exposicaoCollection = model.AbstractCollection.extend({
	url: 'api/locais_exposicoes',
	model: model.local_exposicaoModel
});

/**
 * referencia_exposicao Backbone Model
 */
model.referencia_exposicaoModel = Backbone.Model.extend({
	urlRoot: 'api/referencia_exposicao',
	idAttribute: 'id',
	id: '',
	type: '',
	exposition: '',
	reference: '',
	defaults: {
		'id': null,
		'type': '',
		'exposition': '',
		'reference': ''
	}
});

/**
 * referencia_exposicao Backbone Collection
 */
model.referencia_exposicaoCollection = model.AbstractCollection.extend({
	url: 'api/referencia_exposicoes',
	model: model.referencia_exposicaoModel
});

/**
 * fundo Backbone Model
 */
model.fundoModel = Backbone.Model.extend({
	urlRoot: 'api/fundo',
	idAttribute: 'idfond',
	idfond: '',
	institution: '',
	fond: '',
	description: '',
	otherinformation: '',
	countitem: '',
	type: '',
	defaults: {
		'idfond': null,
		'institution': '',
		'fond': '',
		'description': '',
		'otherinformation': '',
		'countitem': '',
		'type': ''
	}
});

/**
 * fundo Backbone Collection
 */
model.fundoCollection = model.AbstractCollection.extend({
	url: 'api/fundos',
	model: model.fundoModel
});

/**
 * nivel_fundo Backbone Model
 */
model.nivel_fundoModel = Backbone.Model.extend({
	urlRoot: 'api/nivel_fundo',
	idAttribute: 'fondIdfond',
	fondIdfond: '',
	levelsIdlevel: '',
	defaults: {
		'fondIdfond': null,
		'levelsIdlevel': ''
	}
});

/**
 * nivel_fundo Backbone Collection
 */
model.nivel_fundoCollection = model.AbstractCollection.extend({
	url: 'api/niveis_fundos',
	model: model.nivel_fundoModel
});

/**
 * historico Backbone Model
 */
model.historicoModel = Backbone.Model.extend({
	urlRoot: 'api/historico',
	idAttribute: 'idhistory',
	idhistory: '',
	type: '',
	description: '',
	date: '',
	actor: '',
	item: '',
	institution: '',
	idexposition: '',
	cost: '',
	creator: '',
	ispublic: '',
	defaults: {
		'idhistory': null,
		'type': '',
		'description': '',
		'date': '',
		'actor': '',
		'item': '',
		'institution': '',
		'idexposition': '',
		'cost': '',
		'creator': '',
		'ispublic': ''
	}
});

/**
 * historico Backbone Collection
 */
model.historicoCollection = model.AbstractCollection.extend({
	url: 'api/historicos',
	model: model.historicoModel
});

/**
 * midia_historico Backbone Model
 */
model.midia_historicoModel = Backbone.Model.extend({
	urlRoot: 'api/midia_historico',
	idAttribute: 'historyIdhistory',
	historyIdhistory: '',
	mediasIdmedia: '',
	defaults: {
		'historyIdhistory': null,
		'mediasIdmedia': ''
	}
});

/**
 * midia_historico Backbone Collection
 */
model.midia_historicoCollection = model.AbstractCollection.extend({
	url: 'api/midia_historicos',
	model: model.midia_historicoModel
});

/**
 * possuidor Backbone Model
 */
model.possuidorModel = Backbone.Model.extend({
	urlRoot: 'api/possuidor',
	idAttribute: 'idholder',
	idholder: '',
	institution: '',
	holder: '',
	notes: '',
	defaults: {
		'idholder': null,
		'institution': '',
		'holder': '',
		'notes': ''
	}
});

/**
 * possuidor Backbone Collection
 */
model.possuidorCollection = model.AbstractCollection.extend({
	url: 'api/possuidores',
	model: model.possuidorModel
});

/**
 * instituicao Backbone Model
 */
model.instituicaoModel = Backbone.Model.extend({
	urlRoot: 'api/instituicao',
	idAttribute: 'idinstitution',
	idinstitution: '',
	name: '',
	description: '',
	uri: '',
	otherinformation: '',
	code: '',
	timezone: '',
	thumbnail: '',
	defaults: {
		'idinstitution': null,
		'name': '',
		'description': '',
		'uri': '',
		'otherinformation': '',
		'code': '',
		'timezone': '',
		'thumbnail': ''
	}
});

/**
 * instituicao Backbone Collection
 */
model.instituicaoCollection = model.AbstractCollection.extend({
	url: 'api/instituicoes',
	model: model.instituicaoModel
});

/**
 * nivel_instituicoes Backbone Model
 */
model.nivel_instituicoesModel = Backbone.Model.extend({
	urlRoot: 'api/nivel_instituicoes',
	idAttribute: 'institutionIdinstitution',
	institutionIdinstitution: '',
	levelsIdlevel: '',
	defaults: {
		'institutionIdinstitution': null,
		'levelsIdlevel': ''
	}
});

/**
 * nivel_instituicoes Backbone Collection
 */
model.nivel_instituicoesCollection = model.AbstractCollection.extend({
	url: 'api/niveis_instituicoes',
	model: model.nivel_instituicoesModel
});

/**
 * midia_instituicao Backbone Model
 */
model.midia_instituicaoModel = Backbone.Model.extend({
	urlRoot: 'api/midia_instituicao',
	idAttribute: 'institutionIdinstitution',
	institutionIdinstitution: '',
	mediasIdmedia: '',
	defaults: {
		'institutionIdinstitution': null,
		'mediasIdmedia': ''
	}
});

/**
 * midia_instituicao Backbone Collection
 */
model.midia_instituicaoCollection = model.AbstractCollection.extend({
	url: 'api/midia_instituicoes',
	model: model.midia_instituicaoModel
});

/**
 * item Backbone Model
 */
model.itemModel = Backbone.Model.extend({
	urlRoot: 'api/item',
	idAttribute: 'iditem',
	iditem: '',
	holder: '',
	level: '',
	institution: '',
	inventoryid: '',
	uritype: '',
	uri: '',
	keywords: '',
	description: '',
	uidtype: '',
	uid: '',
	class: '',
	type: '',
	iseletronic: '',
	creationdate: '',
	acquisitiondate: '',
	scopecontent: '',
	originalexistence: '',
	originallocation: '',
	repositorycode: '',
	copyexistence: '',
	copylocation: '',
	legalaccess: '',
	accesscondition: '',
	reproductionrights: '',
	reproductionrightsdescription: '',
	itemdate: '',
	publishdate: '',
	publisher: '',
	itematributes: '',
	ispublic: '',
	preliminaryrule: '',
	punctuation: '',
	notes: '',
	otherinformation: '',
	titledefault: '',
	subitem: '',
	deletecomfirm: '',
	typeitem: '',
	edition: '',
	isexposed: '',
	isoriginal: '',
	ispart: '',
	haspart: '',
	ispartof: '',
	numberofcopies: '',
	tobepublicin: '',
	creationdateattributed: '',
	itemdateattributed: '',
	publishdateattributed: '',
	serachdump: '',
	itemmediadir: '',
	defaults: {
		'iditem': null,
		'holder': '',
		'level': '',
		'institution': '',
		'inventoryid': '',
		'uritype': '',
		'uri': '',
		'keywords': '',
		'description': '',
		'uidtype': '',
		'uid': '',
		'class': '',
		'type': '',
		'iseletronic': '',
		'creationdate': '',
		'acquisitiondate': '',
		'scopecontent': '',
		'originalexistence': '',
		'originallocation': '',
		'repositorycode': '',
		'copyexistence': '',
		'copylocation': '',
		'legalaccess': '',
		'accesscondition': '',
		'reproductionrights': '',
		'reproductionrightsdescription': '',
		'itemdate': '',
		'publishdate': '',
		'publisher': '',
		'itematributes': '',
		'ispublic': '',
		'preliminaryrule': '',
		'punctuation': '',
		'notes': '',
		'otherinformation': '',
		'titledefault': '',
		'subitem': '',
		'deletecomfirm': '',
		'typeitem': '',
		'edition': '',
		'isexposed': '',
		'isoriginal': '',
		'ispart': '',
		'haspart': '',
		'ispartof': '',
		'numberofcopies': '',
		'tobepublicin': new Date(),
		'creationdateattributed': '',
		'itemdateattributed': '',
		'publishdateattributed': '',
		'serachdump': '',
		'itemmediadir': ''
	}
});

/**
 * item Backbone Collection
 */
model.itemCollection = model.AbstractCollection.extend({
	url: 'api/items',
	model: model.itemModel
});

/**
 * item_midia Backbone Model
 */
model.item_midiaModel = Backbone.Model.extend({
	urlRoot: 'api/item_midia',
	idAttribute: 'id',
	itemIditem: '',
	mediasIdmedia: '',
	id: '',
	defaults: {
		'itemIditem': '',
		'mediasIdmedia': '',
		'id': null
	}
});

/**
 * item_midia Backbone Collection
 */
model.item_midiaCollection = model.AbstractCollection.extend({
	url: 'api/item_midias',
	model: model.item_midiaModel
});

/**
 * criador_item Backbone Model
 */
model.criador_itemModel = Backbone.Model.extend({
	urlRoot: 'api/criador_item',
	idAttribute: 'iditemcreator',
	iditemcreator: '',
	item: '',
	creator: '',
	type: '',
	location: '',
	attributed: '',
	defaults: {
		'iditemcreator': null,
		'item': '',
		'creator': '',
		'type': '',
		'location': '',
		'attributed': ''
	}
});

/**
 * criador_item Backbone Collection
 */
model.criador_itemCollection = model.AbstractCollection.extend({
	url: 'api/criadores_items',
	model: model.criador_itemModel
});

/**
 * descricao_item Backbone Model
 */
model.descricao_itemModel = Backbone.Model.extend({
	urlRoot: 'api/descricao_item',
	idAttribute: 'id',
	id: '',
	item: '',
	abstracttext: '',
	accrual: '',
	appraisaldesstructionschedulling: '',
	arrangement: '',
	broadcastmethod: '',
	era: '',
	fromcorporate: '',
	frompersonal: '',
	geographiccoodnates: '',
	geographicname: '',
	label: '',
	language: '',
	mediapresentation: '',
	movement: '',
	other: '',
	period: '',
	periodicity: '',
	preservationstatus: '',
	scope: '',
	style: '',
	subject: '',
	tableofcontents: '',
	targetaudience: '',
	tocorporate: '',
	topersonal: '',
	defaults: {
		'id': null,
		'item': '',
		'abstracttext': '',
		'accrual': '',
		'appraisaldesstructionschedulling': '',
		'arrangement': '',
		'broadcastmethod': '',
		'era': '',
		'fromcorporate': '',
		'frompersonal': '',
		'geographiccoodnates': '',
		'geographicname': '',
		'label': '',
		'language': '',
		'mediapresentation': '',
		'movement': '',
		'other': '',
		'period': '',
		'periodicity': '',
		'preservationstatus': '',
		'scope': '',
		'style': '',
		'subject': '',
		'tableofcontents': '',
		'targetaudience': '',
		'tocorporate': '',
		'topersonal': ''
	}
});

/**
 * descricao_item Backbone Collection
 */
model.descricao_itemCollection = model.AbstractCollection.extend({
	url: 'api/descricoes_items',
	model: model.descricao_itemModel
});

/**
 * dimensao_item Backbone Model
 */
model.dimensao_itemModel = Backbone.Model.extend({
	urlRoot: 'api/dimensao_item',
	idAttribute: 'id',
	id: '',
	item: '',
	dimensiontype: '',
	dimensionunit: '',
	dimensionvalue: '',
	defaults: {
		'id': null,
		'item': '',
		'dimensiontype': '',
		'dimensionunit': '',
		'dimensionvalue': ''
	}
});

/**
 * dimensao_item Backbone Collection
 */
model.dimensao_itemCollection = model.AbstractCollection.extend({
	url: 'api/dimensoes_items',
	model: model.dimensao_itemModel
});

/**
 * descricao_item Backbone Model
 */
model.descricao_itemModel = Backbone.Model.extend({
	urlRoot: 'api/descricao_item',
	idAttribute: 'd',
	d: '',
	tem: '',
	nscriptiontype: '',
	nscriptiondescription: '',
	nscriptionlocation: '',
	defaults: {
		'd': null,
		'tem': '',
		'nscriptiontype': '',
		'nscriptiondescription': '',
		'nscriptionlocation': ''
	}
});

/**
 * descricao_item Backbone Collection
 */
model.descricao_itemCollection = model.AbstractCollection.extend({
	url: 'api/descricao_items',
	model: model.descricao_itemModel
});

/**
 * nivel Backbone Model
 */
model.nivelModel = Backbone.Model.extend({
	urlRoot: 'api/nivel',
	idAttribute: 'idlevel',
	idlevel: '',
	seriefather: '',
	fond: '',
	institution: '',
	type: '',
	level: '',
	countitem: '',
	defaults: {
		'idlevel': null,
		'seriefather': '',
		'fond': '',
		'institution': '',
		'type': '',
		'level': '',
		'countitem': ''
	}
});

/**
 * nivel Backbone Collection
 */
model.nivelCollection = model.AbstractCollection.extend({
	url: 'api/niveis',
	model: model.nivelModel
});

/**
 * midia Backbone Model
 */
model.midiaModel = Backbone.Model.extend({
	urlRoot: 'api/midia',
	idAttribute: 'idmedia',
	idmedia: '',
	item: '',
	idhistory: '',
	storage: '',
	iddocumentation: '',
	institution: '',
	idreference: '',
	mediatype: '',
	mediaurl: '',
	digitizationdate: '',
	digitizationresponsable: '',
	polarity: '',
	colorspace: '',
	iccprofile: '',
	xresolution: '',
	yresolution: '',
	thumbnail: '',
	digitizationequipment: '',
	format: '',
	ispublic: '',
	ordername: '',
	sent: '',
	exif: '',
	textual: '',
	sizemedia: '',
	nameoriginal: '',
	mainmedia: '',
	mediadir: '',
	thumbnaildir: '',
	thumbnailurl: '',
	defaults: {
		'idmedia': null,
		'item': '',
		'idhistory': '',
		'storage': '',
		'iddocumentation': '',
		'institution': '',
		'idreference': '',
		'mediatype': '',
		'mediaurl': '',
		'digitizationdate': new Date(),
		'digitizationresponsable': '',
		'polarity': '',
		'colorspace': '',
		'iccprofile': '',
		'xresolution': '',
		'yresolution': '',
		'thumbnail': '',
		'digitizationequipment': '',
		'format': '',
		'ispublic': '',
		'ordername': '',
		'sent': '',
		'exif': '',
		'textual': '',
		'sizemedia': '',
		'nameoriginal': '',
		'mainmedia': '',
		'mediadir': '',
		'thumbnaildir': '',
		'thumbnailurl': ''
	}
});

/**
 * midia Backbone Collection
 */
model.midiaCollection = model.AbstractCollection.extend({
	url: 'api/midias',
	model: model.midiaModel
});

/**
 * modulo Backbone Model
 */
model.moduloModel = Backbone.Model.extend({
	urlRoot: 'api/modulo',
	idAttribute: 'idmodule',
	idmodule: '',
	moname: '',
	mokeyname: '',
	institution: '',
	defaults: {
		'idmodule': null,
		'moname': '',
		'mokeyname': '',
		'institution': ''
	}
});

/**
 * modulo Backbone Collection
 */
model.moduloCollection = model.AbstractCollection.extend({
	url: 'api/modulos',
	model: model.moduloModel
});

/**
 * n_contato Backbone Model
 */
model.n_contatoModel = Backbone.Model.extend({
	urlRoot: 'api/n_contato',
	idAttribute: 'id',
	id: '',
	call_: '',
	company: '',
	countyTaxcode: '',
	federalTaxcode: '',
	identity: '',
	name: '',
	stateTaxcode: '',
	uri: '',
	urla: '',
	institution: '',
	defaults: {
		'id': null,
		'call_': '',
		'company': '',
		'countyTaxcode': '',
		'federalTaxcode': '',
		'identity': '',
		'name': '',
		'stateTaxcode': '',
		'uri': '',
		'urla': '',
		'institution': ''
	}
});

/**
 * n_contato Backbone Collection
 */
model.n_contatoCollection = model.AbstractCollection.extend({
	url: 'api/n_contatos',
	model: model.n_contatoModel
});

/**
 * n_historico Backbone Model
 */
model.n_historicoModel = Backbone.Model.extend({
	urlRoot: 'api/n_historico',
	idAttribute: 'idhistory',
	idhistory: '',
	actor: '',
	cost: '',
	date: '',
	description: '',
	ispublic: '',
	institution: '',
	defaults: {
		'idhistory': null,
		'actor': '',
		'cost': '',
		'date': '',
		'description': '',
		'ispublic': '',
		'institution': ''
	}
});

/**
 * n_historico Backbone Collection
 */
model.n_historicoCollection = model.AbstractCollection.extend({
	url: 'api/n_historicos',
	model: model.n_historicoModel
});

/**
 * n_referencia Backbone Model
 */
model.n_referenciaModel = Backbone.Model.extend({
	urlRoot: 'api/n_referencia',
	idAttribute: 'id',
	id: '',
	author: '',
	description: '',
	otherInformation: '',
	text: '',
	title: '',
	institution: '',
	defaults: {
		'id': null,
		'author': '',
		'description': '',
		'otherInformation': '',
		'text': '',
		'title': '',
		'institution': ''
	}
});

/**
 * n_referencia Backbone Collection
 */
model.n_referenciaCollection = model.AbstractCollection.extend({
	url: 'api/n_referencias',
	model: model.n_referenciaModel
});

/**
 * descricao_fisica Backbone Model
 */
model.descricao_fisicaModel = Backbone.Model.extend({
	urlRoot: 'api/descricao_fisica',
	idAttribute: 'id',
	id: '',
	item: '',
	apexiso: '',
	arabicpagenumbering: '',
	asaiso: '',
	boundtype: '',
	color: '',
	colorsystem: '',
	columnnumber: '',
	compressionmethod: '',
	contentcolor: '',
	contentextent: '',
	contentfinishing: '',
	contentsubstract: '',
	contenttype: '',
	covercolor: '',
	coverfinishing: '',
	coversubstract: '',
	defaultapplication: '',
	dustjacketcolor: '',
	dustjacketfinishing: '',
	dustjacketsubstract: '',
	endpaper: '',
	exif: '',
	format: '',
	framerate: '',
	hasdustjacket: '',
	hassound: '',
	hasspecialfold: '',
	iscompressed: '',
	lengthtxt: '',
	master: '',
	media: '',
	mediasupport: '',
	movements: '',
	other: '',
	projectionmode: '',
	romanpage: '',
	sizetxt: '',
	soundsystem: '',
	specialfold: '',
	specialpagenumebring: '',
	technique: '',
	timecode: '',
	tinting: '',
	titlepage: '',
	totaltime: '',
	type: '',
	writingformat: '',
	defaults: {
		'id': null,
		'item': '',
		'apexiso': '',
		'arabicpagenumbering': '',
		'asaiso': '',
		'boundtype': '',
		'color': '',
		'colorsystem': '',
		'columnnumber': '',
		'compressionmethod': '',
		'contentcolor': '',
		'contentextent': '',
		'contentfinishing': '',
		'contentsubstract': '',
		'contenttype': '',
		'covercolor': '',
		'coverfinishing': '',
		'coversubstract': '',
		'defaultapplication': '',
		'dustjacketcolor': '',
		'dustjacketfinishing': '',
		'dustjacketsubstract': '',
		'endpaper': '',
		'exif': '',
		'format': '',
		'framerate': '',
		'hasdustjacket': '',
		'hassound': '',
		'hasspecialfold': '',
		'iscompressed': '',
		'lengthtxt': '',
		'master': '',
		'media': '',
		'mediasupport': '',
		'movements': '',
		'other': '',
		'projectionmode': '',
		'romanpage': '',
		'sizetxt': '',
		'soundsystem': '',
		'specialfold': '',
		'specialpagenumebring': '',
		'technique': '',
		'timecode': '',
		'tinting': '',
		'titlepage': '',
		'totaltime': '',
		'type': '',
		'writingformat': ''
	}
});

/**
 * descricao_fisica Backbone Collection
 */
model.descricao_fisicaCollection = model.AbstractCollection.extend({
	url: 'api/descricoes_fisicas',
	model: model.descricao_fisicaModel
});

/**
 * local Backbone Model
 */
model.localModel = Backbone.Model.extend({
	urlRoot: 'api/local',
	idAttribute: 'id',
	id: '',
	complement: '',
	latituded: '',
	local: '',
	longitude: '',
	number: '',
	otherinformation: '',
	street: '',
	type: '',
	zipcode: '',
	city: '',
	country: '',
	institution: '',
	state: '',
	defaults: {
		'id': null,
		'complement': '',
		'latituded': '',
		'local': '',
		'longitude': '',
		'number': '',
		'otherinformation': '',
		'street': '',
		'type': '',
		'zipcode': '',
		'city': '',
		'country': '',
		'institution': '',
		'state': ''
	}
});

/**
 * local Backbone Collection
 */
model.localCollection = model.AbstractCollection.extend({
	url: 'api/locais',
	model: model.localModel
});

/**
 * referencia Backbone Model
 */
model.referenciaModel = Backbone.Model.extend({
	urlRoot: 'api/referencia',
	idAttribute: 'idreference',
	idreference: '',
	item: '',
	institution: '',
	creator: '',
	referencetype: '',
	referencetitle: '',
	referencedescription: '',
	referenceauthor: '',
	referencetext: '',
	otherinformations: '',
	defaults: {
		'idreference': null,
		'item': '',
		'institution': '',
		'creator': '',
		'referencetype': '',
		'referencetitle': '',
		'referencedescription': '',
		'referenceauthor': '',
		'referencetext': '',
		'otherinformations': ''
	}
});

/**
 * referencia Backbone Collection
 */
model.referenciaCollection = model.AbstractCollection.extend({
	url: 'api/referencias',
	model: model.referenciaModel
});

/**
 * midia_referencia Backbone Model
 */
model.midia_referenciaModel = Backbone.Model.extend({
	urlRoot: 'api/midia_referencia',
	idAttribute: 'referenceIdreference',
	referenceIdreference: '',
	mediasIdmedia: '',
	defaults: {
		'referenceIdreference': null,
		'mediasIdmedia': ''
	}
});

/**
 * midia_referencia Backbone Collection
 */
model.midia_referenciaCollection = model.AbstractCollection.extend({
	url: 'api/midia_referencias',
	model: model.midia_referenciaModel
});

/**
 * relacionamento_item Backbone Model
 */
model.relacionamento_itemModel = Backbone.Model.extend({
	urlRoot: 'api/relacionamento_item',
	idAttribute: 'id',
	id: '',
	type: '',
	item: '',
	relationship: '',
	defaults: {
		'id': null,
		'type': '',
		'item': '',
		'relationship': ''
	}
});

/**
 * relacionamento_item Backbone Collection
 */
model.relacionamento_itemCollection = model.AbstractCollection.extend({
	url: 'api/relacionamento_items',
	model: model.relacionamento_itemModel
});

/**
 * papel Backbone Model
 */
model.papelModel = Backbone.Model.extend({
	urlRoot: 'api/papel',
	idAttribute: 'idrole',
	idrole: '',
	name: '',
	institution: '',
	defaults: {
		'idrole': null,
		'name': '',
		'institution': ''
	}
});

/**
 * papel Backbone Collection
 */
model.papelCollection = model.AbstractCollection.extend({
	url: 'api/papeis',
	model: model.papelModel
});

/**
 * busca Backbone Model
 */
model.buscaModel = Backbone.Model.extend({
	urlRoot: 'api/busca',
	idAttribute: 'idsearch',
	idsearch: '',
	user: '',
	name: '',
	info: '',
	type: '',
	datecreate: '',
	defaults: {
		'idsearch': null,
		'user': '',
		'name': '',
		'info': '',
		'type': '',
		'datecreate': new Date()
	}
});

/**
 * busca Backbone Collection
 */
model.buscaCollection = model.AbstractCollection.extend({
	url: 'api/buscas',
	model: model.buscaModel
});

/**
 * estado Backbone Model
 */
model.estadoModel = Backbone.Model.extend({
	urlRoot: 'api/estado',
	idAttribute: 'idstate',
	idstate: '',
	country: '',
	state: '',
	statecode: '',
	defaults: {
		'idstate': null,
		'country': '',
		'state': '',
		'statecode': ''
	}
});

/**
 * estado Backbone Collection
 */
model.estadoCollection = model.AbstractCollection.extend({
	url: 'api/estados',
	model: model.estadoModel
});

/**
 * armazenamento Backbone Model
 */
model.armazenamentoModel = Backbone.Model.extend({
	urlRoot: 'api/armazenamento',
	idAttribute: 'idstorage',
	idstorage: '',
	host: '',
	local: '',
	username: '',
	password: '',
	folder: '',
	urlftp: '',
	urlhttp: '',
	ipaddress: '',
	full: '',
	usedspace: '',
	diskcapacity: '',
	institution: '',
	defaultstorage: '',
	port: '',
	status: '',
	defaults: {
		'idstorage': null,
		'host': '',
		'local': '',
		'username': '',
		'password': '',
		'folder': '',
		'urlftp': '',
		'urlhttp': '',
		'ipaddress': '',
		'full': '',
		'usedspace': '',
		'diskcapacity': '',
		'institution': '',
		'defaultstorage': '',
		'port': '',
		'status': ''
	}
});

/**
 * armazenamento Backbone Collection
 */
model.armazenamentoCollection = model.AbstractCollection.extend({
	url: 'api/armazenamentos',
	model: model.armazenamentoModel
});

/**
 * midia_armazanenamento Backbone Model
 */
model.midia_armazanenamentoModel = Backbone.Model.extend({
	urlRoot: 'api/midia_armazanenamento',
	idAttribute: 'storageIdstorage',
	storageIdstorage: '',
	mediasIdmedia: '',
	defaults: {
		'storageIdstorage': null,
		'mediasIdmedia': ''
	}
});

/**
 * midia_armazanenamento Backbone Collection
 */
model.midia_armazanenamentoCollection = model.AbstractCollection.extend({
	url: 'api/midia_armazenamentos',
	model: model.midia_armazanenamentoModel
});

/**
 * timezone Backbone Model
 */
model.timezoneModel = Backbone.Model.extend({
	urlRoot: 'api/timezone',
	idAttribute: 'idtimezone',
	idtimezone: '',
	name: '',
	defaults: {
		'idtimezone': null,
		'name': ''
	}
});

/**
 * timezone Backbone Collection
 */
model.timezoneCollection = model.AbstractCollection.extend({
	url: 'api/timezones',
	model: model.timezoneModel
});

/**
 * titulo Backbone Model
 */
model.tituloModel = Backbone.Model.extend({
	urlRoot: 'api/titulo',
	idAttribute: 'idtitle',
	idtitle: '',
	name: '',
	value: '',
	item: '',
	institution: '',
	defaulttitle: '',
	defaults: {
		'idtitle': null,
		'name': '',
		'value': '',
		'item': '',
		'institution': '',
		'defaulttitle': ''
	}
});

/**
 * titulo Backbone Collection
 */
model.tituloCollection = model.AbstractCollection.extend({
	url: 'api/titulos',
	model: model.tituloModel
});

/**
 * transcicao Backbone Model
 */
model.transcicaoModel = Backbone.Model.extend({
	urlRoot: 'api/transcicao',
	idAttribute: 'idtranscription',
	idtranscription: '',
	iditem: '',
	idmedia: '',
	institution: '',
	transcription: '',
	notes: '',
	language: '',
	defaults: {
		'idtranscription': null,
		'iditem': '',
		'idmedia': '',
		'institution': '',
		'transcription': '',
		'notes': '',
		'language': ''
	}
});

/**
 * transcicao Backbone Collection
 */
model.transcicaoCollection = model.AbstractCollection.extend({
	url: 'api/transcricoes',
	model: model.transcicaoModel
});

/**
 * usuario Backbone Model
 */
model.usuarioModel = Backbone.Model.extend({
	urlRoot: 'api/usuario',
	idAttribute: 'iduser',
	iduser: '',
	institution: '',
	fullname: '',
	username: '',
	password: '',
	notes: '',
	code: '',
	timezone: '',
	lastlogin: '',
	status: '',
	admin: '',
	defaults: {
		'iduser': null,
		'institution': '',
		'fullname': '',
		'username': '',
		'password': '',
		'notes': '',
		'code': '',
		'timezone': '',
		'lastlogin': '',
		'status': '',
		'admin': ''
	}
});

/**
 * usuario Backbone Collection
 */
model.usuarioCollection = model.AbstractCollection.extend({
	url: 'api/usuarios',
	model: model.usuarioModel
});

/**
 * papel_usuario Backbone Model
 */
model.papel_usuarioModel = Backbone.Model.extend({
	urlRoot: 'api/papel_usuario',
	idAttribute: 'iduserrole',
	iduserrole: '',
	user: '',
	role: '',
	defaults: {
		'iduserrole': null,
		'user': '',
		'role': ''
	}
});

/**
 * papel_usuario Backbone Collection
 */
model.papel_usuarioCollection = model.AbstractCollection.extend({
	url: 'api/papeis_usuarios',
	model: model.papel_usuarioModel
});

