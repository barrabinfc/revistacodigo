<?php
/**
 * @package sistema
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// endereco
	'GET:enderecos' => array('route' => 'endereco.ListView'),
	'GET:endereco/(:num)' => array('route' => 'endereco.SingleView', 'params' => array('idaddress' => 1)),
	'GET:api/enderecos' => array('route' => 'endereco.Query'),
	'POST:api/endereco' => array('route' => 'endereco.Create'),
	'GET:api/endereco/(:num)' => array('route' => 'endereco.Read', 'params' => array('idaddress' => 2)),
	'PUT:api/endereco/(:num)' => array('route' => 'endereco.Update', 'params' => array('idaddress' => 2)),
	'DELETE:api/endereco/(:num)' => array('route' => 'endereco.Delete', 'params' => array('idaddress' => 2)),
		
	// autoridade
	'GET:authorities' => array('route' => 'autoridade.ListView'),
	'GET:autoridade/(:num)' => array('route' => 'autoridade.SingleView', 'params' => array('idauthority' => 1)),
	'GET:api/authorities' => array('route' => 'autoridade.Query'),
	'POST:api/autoridade' => array('route' => 'autoridade.Create'),
	'GET:api/autoridade/(:num)' => array('route' => 'autoridade.Read', 'params' => array('idauthority' => 2)),
	'PUT:api/autoridade/(:num)' => array('route' => 'autoridade.Update', 'params' => array('idauthority' => 2)),
	'DELETE:api/autoridade/(:num)' => array('route' => 'autoridade.Delete', 'params' => array('idauthority' => 2)),
		
	// autorole
	'GET:autoroles' => array('route' => 'autorole.ListView'),
	'GET:autorole/(:num)' => array('route' => 'autorole.SingleView', 'params' => array('dautorole' => 1)),
	'GET:api/autoroles' => array('route' => 'autorole.Query'),
	'POST:api/autorole' => array('route' => 'autorole.Create'),
	'GET:api/autorole/(:num)' => array('route' => 'autorole.Read', 'params' => array('dautorole' => 2)),
	'PUT:api/autorole/(:num)' => array('route' => 'autorole.Update', 'params' => array('dautorole' => 2)),
	'DELETE:api/autorole/(:num)' => array('route' => 'autorole.Delete', 'params' => array('dautorole' => 2)),
		
	// cidade
	'GET:cidades' => array('route' => 'cidade.ListView'),
	'GET:cidade/(:num)' => array('route' => 'cidade.SingleView', 'params' => array('idcity' => 1)),
	'GET:api/cidades' => array('route' => 'cidade.Query'),
	'POST:api/cidade' => array('route' => 'cidade.Create'),
	'GET:api/cidade/(:num)' => array('route' => 'cidade.Read', 'params' => array('idcity' => 2)),
	'PUT:api/cidade/(:num)' => array('route' => 'cidade.Update', 'params' => array('idcity' => 2)),
	'DELETE:api/cidade/(:num)' => array('route' => 'cidade.Delete', 'params' => array('idcity' => 2)),
		
	// contato
	'GET:contatos' => array('route' => 'contato.ListView'),
	'GET:contato/(:num)' => array('route' => 'contato.SingleView', 'params' => array('idcontact' => 1)),
	'GET:api/contatos' => array('route' => 'contato.Query'),
	'POST:api/contato' => array('route' => 'contato.Create'),
	'GET:api/contato/(:num)' => array('route' => 'contato.Read', 'params' => array('idcontact' => 2)),
	'PUT:api/contato/(:num)' => array('route' => 'contato.Update', 'params' => array('idcontact' => 2)),
	'DELETE:api/contato/(:num)' => array('route' => 'contato.Delete', 'params' => array('idcontact' => 2)),
		
	// pais
	'GET:paises' => array('route' => 'pais.ListView'),
	'GET:pais/(:num)' => array('route' => 'pais.SingleView', 'params' => array('idcountry' => 1)),
	'GET:api/paises' => array('route' => 'pais.Query'),
	'POST:api/pais' => array('route' => 'pais.Create'),
	'GET:api/pais/(:num)' => array('route' => 'pais.Read', 'params' => array('idcountry' => 2)),
	'PUT:api/pais/(:num)' => array('route' => 'pais.Update', 'params' => array('idcountry' => 2)),
	'DELETE:api/pais/(:num)' => array('route' => 'pais.Delete', 'params' => array('idcountry' => 2)),
		
	// criador
	'GET:criadores' => array('route' => 'criador.ListView'),
	'GET:criador/(:num)' => array('route' => 'criador.SingleView', 'params' => array('idcreator' => 1)),
	'GET:api/criadores' => array('route' => 'criador.Query'),
	'POST:api/criador' => array('route' => 'criador.Create'),
	'GET:api/criador/(:num)' => array('route' => 'criador.Read', 'params' => array('idcreator' => 2)),
	'PUT:api/criador/(:num)' => array('route' => 'criador.Update', 'params' => array('idcreator' => 2)),
	'DELETE:api/criador/(:num)' => array('route' => 'criador.Delete', 'params' => array('idcreator' => 2)),
		
	// creator_award_honour
	'GET:creator_award_honours' => array('route' => 'creator_award_honour.ListView'),
	'GET:creator_award_honour/(:num)' => array('route' => 'creator_award_honour.SingleView', 'params' => array('id' => 1)),
	'GET:api/creator_award_honours' => array('route' => 'creator_award_honour.Query'),
	'POST:api/creator_award_honour' => array('route' => 'creator_award_honour.Create'),
	'GET:api/creator_award_honour/(:num)' => array('route' => 'creator_award_honour.Read', 'params' => array('id' => 2)),
	'PUT:api/creator_award_honour/(:num)' => array('route' => 'creator_award_honour.Update', 'params' => array('id' => 2)),
	'DELETE:api/creator_award_honour/(:num)' => array('route' => 'creator_award_honour.Delete', 'params' => array('id' => 2)),
		
	// contato_criador
	'GET:contatos_criadores' => array('route' => 'contato_criador.ListView'),
	'GET:contato_criador/(:num)' => array('route' => 'contato_criador.SingleView', 'params' => array('id' => 1)),
	'GET:api/contatos_criadores' => array('route' => 'contato_criador.Query'),
	'POST:api/contato_criador' => array('route' => 'contato_criador.Create'),
	'GET:api/contato_criador/(:num)' => array('route' => 'contato_criador.Read', 'params' => array('id' => 2)),
	'PUT:api/contato_criador/(:num)' => array('route' => 'contato_criador.Update', 'params' => array('id' => 2)),
	'DELETE:api/contato_criador/(:num)' => array('route' => 'contato_criador.Delete', 'params' => array('id' => 2)),
		
	// historico_criador
	'GET:historico_criadores' => array('route' => 'historico_criador.ListView'),
	'GET:historico_criador/(:num)' => array('route' => 'historico_criador.SingleView', 'params' => array('id' => 1)),
	'GET:api/historico_criadores' => array('route' => 'historico_criador.Query'),
	'POST:api/historico_criador' => array('route' => 'historico_criador.Create'),
	'GET:api/historico_criador/(:num)' => array('route' => 'historico_criador.Read', 'params' => array('id' => 2)),
	'PUT:api/historico_criador/(:num)' => array('route' => 'historico_criador.Update', 'params' => array('id' => 2)),
	'DELETE:api/historico_criador/(:num)' => array('route' => 'historico_criador.Delete', 'params' => array('id' => 2)),
		
	// referencia_criador
	'GET:referencias_criadores' => array('route' => 'referencia_criador.ListView'),
	'GET:referencia_criador/(:num)' => array('route' => 'referencia_criador.SingleView', 'params' => array('id' => 1)),
	'GET:api/referencias_criadores' => array('route' => 'referencia_criador.Query'),
	'POST:api/referencia_criador' => array('route' => 'referencia_criador.Create'),
	'GET:api/referencia_criador/(:num)' => array('route' => 'referencia_criador.Read', 'params' => array('id' => 2)),
	'PUT:api/referencia_criador/(:num)' => array('route' => 'referencia_criador.Update', 'params' => array('id' => 2)),
	'DELETE:api/referencia_criador/(:num)' => array('route' => 'referencia_criador.Delete', 'params' => array('id' => 2)),
		
	// nome_criador
	'GET:nome_criadores' => array('route' => 'nome_criador.ListView'),
	'GET:nome_criador/(:num)' => array('route' => 'nome_criador.SingleView', 'params' => array('idcreatorname' => 1)),
	'GET:api/nome_criadores' => array('route' => 'nome_criador.Query'),
	'POST:api/nome_criador' => array('route' => 'nome_criador.Create'),
	'GET:api/nome_criador/(:num)' => array('route' => 'nome_criador.Read', 'params' => array('idcreatorname' => 2)),
	'PUT:api/nome_criador/(:num)' => array('route' => 'nome_criador.Update', 'params' => array('idcreatorname' => 2)),
	'DELETE:api/nome_criador/(:num)' => array('route' => 'nome_criador.Delete', 'params' => array('idcreatorname' => 2)),
		
	// datalog
	'GET:datalogs' => array('route' => 'datalog.ListView'),
	'GET:datalog/(:num)' => array('route' => 'datalog.SingleView', 'params' => array('iddatalog' => 1)),
	'GET:api/datalogs' => array('route' => 'datalog.Query'),
	'POST:api/datalog' => array('route' => 'datalog.Create'),
	'GET:api/datalog/(:num)' => array('route' => 'datalog.Read', 'params' => array('iddatalog' => 2)),
	'PUT:api/datalog/(:num)' => array('route' => 'datalog.Update', 'params' => array('iddatalog' => 2)),
	'DELETE:api/datalog/(:num)' => array('route' => 'datalog.Delete', 'params' => array('iddatalog' => 2)),
		
	// dimensao
	'GET:dimensoes' => array('route' => 'dimensao.ListView'),
	'GET:dimensao/(:num)' => array('route' => 'dimensao.SingleView', 'params' => array('id' => 1)),
	'GET:api/dimensoes' => array('route' => 'dimensao.Query'),
	'POST:api/dimensao' => array('route' => 'dimensao.Create'),
	'GET:api/dimensao/(:num)' => array('route' => 'dimensao.Read', 'params' => array('id' => 2)),
	'PUT:api/dimensao/(:num)' => array('route' => 'dimensao.Update', 'params' => array('id' => 2)),
	'DELETE:api/dimensao/(:num)' => array('route' => 'dimensao.Delete', 'params' => array('id' => 2)),
		
	// documento
	'GET:documentos' => array('route' => 'documento.ListView'),
	'GET:documento/(:num)' => array('route' => 'documento.SingleView', 'params' => array('iddocumentation' => 1)),
	'GET:api/documentos' => array('route' => 'documento.Query'),
	'POST:api/documento' => array('route' => 'documento.Create'),
	'GET:api/documento/(:num)' => array('route' => 'documento.Read', 'params' => array('iddocumentation' => 2)),
	'PUT:api/documento/(:num)' => array('route' => 'documento.Update', 'params' => array('iddocumentation' => 2)),
	'DELETE:api/documento/(:num)' => array('route' => 'documento.Delete', 'params' => array('iddocumentation' => 2)),
		
	// documento_midia
	'GET:documentos_midias' => array('route' => 'documento_midia.ListView'),
	'GET:documento_midia/(:any)' => array('route' => 'documento_midia.SingleView', 'params' => array('documentationIddocumentation' => 1)),
	'GET:api/documentos_midias' => array('route' => 'documento_midia.Query'),
	'POST:api/documento_midia' => array('route' => 'documento_midia.Create'),
	'GET:api/documento_midia/(:any)' => array('route' => 'documento_midia.Read', 'params' => array('documentationIddocumentation' => 2)),
	'PUT:api/documento_midia/(:any)' => array('route' => 'documento_midia.Update', 'params' => array('documentationIddocumentation' => 2)),
	'DELETE:api/documento_midia/(:any)' => array('route' => 'documento_midia.Delete', 'params' => array('documentationIddocumentation' => 2)),
		
	// expo_item
	'GET:expo_items' => array('route' => 'expo_item.ListView'),
	'GET:expo_item/(:num)' => array('route' => 'expo_item.SingleView', 'params' => array('idexpoitem' => 1)),
	'GET:api/expo_items' => array('route' => 'expo_item.Query'),
	'POST:api/expo_item' => array('route' => 'expo_item.Create'),
	'GET:api/expo_item/(:num)' => array('route' => 'expo_item.Read', 'params' => array('idexpoitem' => 2)),
	'PUT:api/expo_item/(:num)' => array('route' => 'expo_item.Update', 'params' => array('idexpoitem' => 2)),
	'DELETE:api/expo_item/(:num)' => array('route' => 'expo_item.Delete', 'params' => array('idexpoitem' => 2)),
		
	// expoisicao
	'GET:exposicoes' => array('route' => 'expoisicao.ListView'),
	'GET:expoisicao/(:num)' => array('route' => 'expoisicao.SingleView', 'params' => array('idexposition' => 1)),
	'GET:api/exposicoes' => array('route' => 'expoisicao.Query'),
	'POST:api/expoisicao' => array('route' => 'expoisicao.Create'),
	'GET:api/expoisicao/(:num)' => array('route' => 'expoisicao.Read', 'params' => array('idexposition' => 2)),
	'PUT:api/expoisicao/(:num)' => array('route' => 'expoisicao.Update', 'params' => array('idexposition' => 2)),
	'DELETE:api/expoisicao/(:num)' => array('route' => 'expoisicao.Delete', 'params' => array('idexposition' => 2)),
		
	// exposicao_criador
	'GET:exposicao_criadores' => array('route' => 'exposicao_criador.ListView'),
	'GET:exposicao_criador/(:num)' => array('route' => 'exposicao_criador.SingleView', 'params' => array('id' => 1)),
	'GET:api/exposicao_criadores' => array('route' => 'exposicao_criador.Query'),
	'POST:api/exposicao_criador' => array('route' => 'exposicao_criador.Create'),
	'GET:api/exposicao_criador/(:num)' => array('route' => 'exposicao_criador.Read', 'params' => array('id' => 2)),
	'PUT:api/exposicao_criador/(:num)' => array('route' => 'exposicao_criador.Update', 'params' => array('id' => 2)),
	'DELETE:api/exposicao_criador/(:num)' => array('route' => 'exposicao_criador.Delete', 'params' => array('id' => 2)),
		
	// dimensao_exposicao
	'GET:dimensao_exposicoes' => array('route' => 'dimensao_exposicao.ListView'),
	'GET:dimensao_exposicao/(:num)' => array('route' => 'dimensao_exposicao.SingleView', 'params' => array('id' => 1)),
	'GET:api/dimensao_exposicoes' => array('route' => 'dimensao_exposicao.Query'),
	'POST:api/dimensao_exposicao' => array('route' => 'dimensao_exposicao.Create'),
	'GET:api/dimensao_exposicao/(:num)' => array('route' => 'dimensao_exposicao.Read', 'params' => array('id' => 2)),
	'PUT:api/dimensao_exposicao/(:num)' => array('route' => 'dimensao_exposicao.Update', 'params' => array('id' => 2)),
	'DELETE:api/dimensao_exposicao/(:num)' => array('route' => 'dimensao_exposicao.Delete', 'params' => array('id' => 2)),
		
	// exposicao_historico
	'GET:exposicao_historicos' => array('route' => 'exposicao_historico.ListView'),
	'GET:exposicao_historico/(:num)' => array('route' => 'exposicao_historico.SingleView', 'params' => array('idhistory' => 1)),
	'GET:api/exposicao_historicos' => array('route' => 'exposicao_historico.Query'),
	'POST:api/exposicao_historico' => array('route' => 'exposicao_historico.Create'),
	'GET:api/exposicao_historico/(:num)' => array('route' => 'exposicao_historico.Read', 'params' => array('idhistory' => 2)),
	'PUT:api/exposicao_historico/(:num)' => array('route' => 'exposicao_historico.Update', 'params' => array('idhistory' => 2)),
	'DELETE:api/exposicao_historico/(:num)' => array('route' => 'exposicao_historico.Delete', 'params' => array('idhistory' => 2)),
		
	// local_exposicao
	'GET:locais_exposicoes' => array('route' => 'local_exposicao.ListView'),
	'GET:local_exposicao/(:num)' => array('route' => 'local_exposicao.SingleView', 'params' => array('id' => 1)),
	'GET:api/locais_exposicoes' => array('route' => 'local_exposicao.Query'),
	'POST:api/local_exposicao' => array('route' => 'local_exposicao.Create'),
	'GET:api/local_exposicao/(:num)' => array('route' => 'local_exposicao.Read', 'params' => array('id' => 2)),
	'PUT:api/local_exposicao/(:num)' => array('route' => 'local_exposicao.Update', 'params' => array('id' => 2)),
	'DELETE:api/local_exposicao/(:num)' => array('route' => 'local_exposicao.Delete', 'params' => array('id' => 2)),
		
	// referencia_exposicao
	'GET:referencia_exposicoes' => array('route' => 'referencia_exposicao.ListView'),
	'GET:referencia_exposicao/(:num)' => array('route' => 'referencia_exposicao.SingleView', 'params' => array('id' => 1)),
	'GET:api/referencia_exposicoes' => array('route' => 'referencia_exposicao.Query'),
	'POST:api/referencia_exposicao' => array('route' => 'referencia_exposicao.Create'),
	'GET:api/referencia_exposicao/(:num)' => array('route' => 'referencia_exposicao.Read', 'params' => array('id' => 2)),
	'PUT:api/referencia_exposicao/(:num)' => array('route' => 'referencia_exposicao.Update', 'params' => array('id' => 2)),
	'DELETE:api/referencia_exposicao/(:num)' => array('route' => 'referencia_exposicao.Delete', 'params' => array('id' => 2)),
		
	// fundo
	'GET:fundos' => array('route' => 'fundo.ListView'),
	'GET:fundo/(:num)' => array('route' => 'fundo.SingleView', 'params' => array('idfond' => 1)),
	'GET:api/fundos' => array('route' => 'fundo.Query'),
	'POST:api/fundo' => array('route' => 'fundo.Create'),
	'GET:api/fundo/(:num)' => array('route' => 'fundo.Read', 'params' => array('idfond' => 2)),
	'PUT:api/fundo/(:num)' => array('route' => 'fundo.Update', 'params' => array('idfond' => 2)),
	'DELETE:api/fundo/(:num)' => array('route' => 'fundo.Delete', 'params' => array('idfond' => 2)),
		
	// nivel_fundo
	'GET:niveis_fundos' => array('route' => 'nivel_fundo.ListView'),
	'GET:nivel_fundo/(:any)' => array('route' => 'nivel_fundo.SingleView', 'params' => array('fondIdfond' => 1)),
	'GET:api/niveis_fundos' => array('route' => 'nivel_fundo.Query'),
	'POST:api/nivel_fundo' => array('route' => 'nivel_fundo.Create'),
	'GET:api/nivel_fundo/(:any)' => array('route' => 'nivel_fundo.Read', 'params' => array('fondIdfond' => 2)),
	'PUT:api/nivel_fundo/(:any)' => array('route' => 'nivel_fundo.Update', 'params' => array('fondIdfond' => 2)),
	'DELETE:api/nivel_fundo/(:any)' => array('route' => 'nivel_fundo.Delete', 'params' => array('fondIdfond' => 2)),
		
	// historico
	'GET:historicos' => array('route' => 'historico.ListView'),
	'GET:historico/(:num)' => array('route' => 'historico.SingleView', 'params' => array('idhistory' => 1)),
	'GET:api/historicos' => array('route' => 'historico.Query'),
	'POST:api/historico' => array('route' => 'historico.Create'),
	'GET:api/historico/(:num)' => array('route' => 'historico.Read', 'params' => array('idhistory' => 2)),
	'PUT:api/historico/(:num)' => array('route' => 'historico.Update', 'params' => array('idhistory' => 2)),
	'DELETE:api/historico/(:num)' => array('route' => 'historico.Delete', 'params' => array('idhistory' => 2)),
		
	// midia_historico
	'GET:midia_historicos' => array('route' => 'midia_historico.ListView'),
	'GET:midia_historico/(:any)' => array('route' => 'midia_historico.SingleView', 'params' => array('historyIdhistory' => 1)),
	'GET:api/midia_historicos' => array('route' => 'midia_historico.Query'),
	'POST:api/midia_historico' => array('route' => 'midia_historico.Create'),
	'GET:api/midia_historico/(:any)' => array('route' => 'midia_historico.Read', 'params' => array('historyIdhistory' => 2)),
	'PUT:api/midia_historico/(:any)' => array('route' => 'midia_historico.Update', 'params' => array('historyIdhistory' => 2)),
	'DELETE:api/midia_historico/(:any)' => array('route' => 'midia_historico.Delete', 'params' => array('historyIdhistory' => 2)),
		
	// possuidor
	'GET:possuidores' => array('route' => 'possuidor.ListView'),
	'GET:possuidor/(:num)' => array('route' => 'possuidor.SingleView', 'params' => array('idholder' => 1)),
	'GET:api/possuidores' => array('route' => 'possuidor.Query'),
	'POST:api/possuidor' => array('route' => 'possuidor.Create'),
	'GET:api/possuidor/(:num)' => array('route' => 'possuidor.Read', 'params' => array('idholder' => 2)),
	'PUT:api/possuidor/(:num)' => array('route' => 'possuidor.Update', 'params' => array('idholder' => 2)),
	'DELETE:api/possuidor/(:num)' => array('route' => 'possuidor.Delete', 'params' => array('idholder' => 2)),
		
	// instituicao
	'GET:instituicoes' => array('route' => 'instituicao.ListView'),
	'GET:instituicao/(:num)' => array('route' => 'instituicao.SingleView', 'params' => array('idinstitution' => 1)),
	'GET:api/instituicoes' => array('route' => 'instituicao.Query'),
	'POST:api/instituicao' => array('route' => 'instituicao.Create'),
	'GET:api/instituicao/(:num)' => array('route' => 'instituicao.Read', 'params' => array('idinstitution' => 2)),
	'PUT:api/instituicao/(:num)' => array('route' => 'instituicao.Update', 'params' => array('idinstitution' => 2)),
	'DELETE:api/instituicao/(:num)' => array('route' => 'instituicao.Delete', 'params' => array('idinstitution' => 2)),
		
	// nivel_instituicoes
	'GET:niveis_instituicoes' => array('route' => 'nivel_instituicoes.ListView'),
	'GET:nivel_instituicoes/(:any)' => array('route' => 'nivel_instituicoes.SingleView', 'params' => array('institutionIdinstitution' => 1)),
	'GET:api/niveis_instituicoes' => array('route' => 'nivel_instituicoes.Query'),
	'POST:api/nivel_instituicoes' => array('route' => 'nivel_instituicoes.Create'),
	'GET:api/nivel_instituicoes/(:any)' => array('route' => 'nivel_instituicoes.Read', 'params' => array('institutionIdinstitution' => 2)),
	'PUT:api/nivel_instituicoes/(:any)' => array('route' => 'nivel_instituicoes.Update', 'params' => array('institutionIdinstitution' => 2)),
	'DELETE:api/nivel_instituicoes/(:any)' => array('route' => 'nivel_instituicoes.Delete', 'params' => array('institutionIdinstitution' => 2)),
		
	// midia_instituicao
	'GET:midia_instituicoes' => array('route' => 'midia_instituicao.ListView'),
	'GET:midia_instituicao/(:any)' => array('route' => 'midia_instituicao.SingleView', 'params' => array('institutionIdinstitution' => 1)),
	'GET:api/midia_instituicoes' => array('route' => 'midia_instituicao.Query'),
	'POST:api/midia_instituicao' => array('route' => 'midia_instituicao.Create'),
	'GET:api/midia_instituicao/(:any)' => array('route' => 'midia_instituicao.Read', 'params' => array('institutionIdinstitution' => 2)),
	'PUT:api/midia_instituicao/(:any)' => array('route' => 'midia_instituicao.Update', 'params' => array('institutionIdinstitution' => 2)),
	'DELETE:api/midia_instituicao/(:any)' => array('route' => 'midia_instituicao.Delete', 'params' => array('institutionIdinstitution' => 2)),
		
	// item
	'GET:items' => array('route' => 'item.ListView'),
	'GET:item/(:num)' => array('route' => 'item.SingleView', 'params' => array('iditem' => 1)),
	'GET:api/items' => array('route' => 'item.Query'),
	'POST:api/item' => array('route' => 'item.Create'),
	'GET:api/item/(:num)' => array('route' => 'item.Read', 'params' => array('iditem' => 2)),
	'PUT:api/item/(:num)' => array('route' => 'item.Update', 'params' => array('iditem' => 2)),
	'DELETE:api/item/(:num)' => array('route' => 'item.Delete', 'params' => array('iditem' => 2)),
		
	// item_midia
	'GET:item_midias' => array('route' => 'item_midia.ListView'),
	'GET:item_midia/(:num)' => array('route' => 'item_midia.SingleView', 'params' => array('id' => 1)),
	'GET:api/item_midias' => array('route' => 'item_midia.Query'),
	'POST:api/item_midia' => array('route' => 'item_midia.Create'),
	'GET:api/item_midia/(:num)' => array('route' => 'item_midia.Read', 'params' => array('id' => 2)),
	'PUT:api/item_midia/(:num)' => array('route' => 'item_midia.Update', 'params' => array('id' => 2)),
	'DELETE:api/item_midia/(:num)' => array('route' => 'item_midia.Delete', 'params' => array('id' => 2)),
		
	// criador_item
	'GET:criadores_items' => array('route' => 'criador_item.ListView'),
	'GET:criador_item/(:num)' => array('route' => 'criador_item.SingleView', 'params' => array('iditemcreator' => 1)),
	'GET:api/criadores_items' => array('route' => 'criador_item.Query'),
	'POST:api/criador_item' => array('route' => 'criador_item.Create'),
	'GET:api/criador_item/(:num)' => array('route' => 'criador_item.Read', 'params' => array('iditemcreator' => 2)),
	'PUT:api/criador_item/(:num)' => array('route' => 'criador_item.Update', 'params' => array('iditemcreator' => 2)),
	'DELETE:api/criador_item/(:num)' => array('route' => 'criador_item.Delete', 'params' => array('iditemcreator' => 2)),
		
	// descricao_item
	'GET:descricoes_items' => array('route' => 'descricao_item.ListView'),
	'GET:descricao_item/(:num)' => array('route' => 'descricao_item.SingleView', 'params' => array('id' => 1)),
	'GET:api/descricoes_items' => array('route' => 'descricao_item.Query'),
	'POST:api/descricao_item' => array('route' => 'descricao_item.Create'),
	'GET:api/descricao_item/(:num)' => array('route' => 'descricao_item.Read', 'params' => array('id' => 2)),
	'PUT:api/descricao_item/(:num)' => array('route' => 'descricao_item.Update', 'params' => array('id' => 2)),
	'DELETE:api/descricao_item/(:num)' => array('route' => 'descricao_item.Delete', 'params' => array('id' => 2)),
		
	// dimensao_item
	'GET:dimensoes_items' => array('route' => 'dimensao_item.ListView'),
	'GET:dimensao_item/(:num)' => array('route' => 'dimensao_item.SingleView', 'params' => array('id' => 1)),
	'GET:api/dimensoes_items' => array('route' => 'dimensao_item.Query'),
	'POST:api/dimensao_item' => array('route' => 'dimensao_item.Create'),
	'GET:api/dimensao_item/(:num)' => array('route' => 'dimensao_item.Read', 'params' => array('id' => 2)),
	'PUT:api/dimensao_item/(:num)' => array('route' => 'dimensao_item.Update', 'params' => array('id' => 2)),
	'DELETE:api/dimensao_item/(:num)' => array('route' => 'dimensao_item.Delete', 'params' => array('id' => 2)),
		
	// descricao_item
	'GET:descricao_items' => array('route' => 'descricao_item.ListView'),
	'GET:descricao_item/(:num)' => array('route' => 'descricao_item.SingleView', 'params' => array('d' => 1)),
	'GET:api/descricao_items' => array('route' => 'descricao_item.Query'),
	'POST:api/descricao_item' => array('route' => 'descricao_item.Create'),
	'GET:api/descricao_item/(:num)' => array('route' => 'descricao_item.Read', 'params' => array('d' => 2)),
	'PUT:api/descricao_item/(:num)' => array('route' => 'descricao_item.Update', 'params' => array('d' => 2)),
	'DELETE:api/descricao_item/(:num)' => array('route' => 'descricao_item.Delete', 'params' => array('d' => 2)),
		
	// nivel
	'GET:niveis' => array('route' => 'nivel.ListView'),
	'GET:nivel/(:num)' => array('route' => 'nivel.SingleView', 'params' => array('idlevel' => 1)),
	'GET:api/niveis' => array('route' => 'nivel.Query'),
	'POST:api/nivel' => array('route' => 'nivel.Create'),
	'GET:api/nivel/(:num)' => array('route' => 'nivel.Read', 'params' => array('idlevel' => 2)),
	'PUT:api/nivel/(:num)' => array('route' => 'nivel.Update', 'params' => array('idlevel' => 2)),
	'DELETE:api/nivel/(:num)' => array('route' => 'nivel.Delete', 'params' => array('idlevel' => 2)),
		
	// midia
	'GET:midias' => array('route' => 'midia.ListView'),
	'GET:midia/(:num)' => array('route' => 'midia.SingleView', 'params' => array('idmedia' => 1)),
	'GET:api/midias' => array('route' => 'midia.Query'),
	'POST:api/midia' => array('route' => 'midia.Create'),
	'GET:api/midia/(:num)' => array('route' => 'midia.Read', 'params' => array('idmedia' => 2)),
	'PUT:api/midia/(:num)' => array('route' => 'midia.Update', 'params' => array('idmedia' => 2)),
	'DELETE:api/midia/(:num)' => array('route' => 'midia.Delete', 'params' => array('idmedia' => 2)),
		
	// modulo
	'GET:modulos' => array('route' => 'modulo.ListView'),
	'GET:modulo/(:num)' => array('route' => 'modulo.SingleView', 'params' => array('idmodule' => 1)),
	'GET:api/modulos' => array('route' => 'modulo.Query'),
	'POST:api/modulo' => array('route' => 'modulo.Create'),
	'GET:api/modulo/(:num)' => array('route' => 'modulo.Read', 'params' => array('idmodule' => 2)),
	'PUT:api/modulo/(:num)' => array('route' => 'modulo.Update', 'params' => array('idmodule' => 2)),
	'DELETE:api/modulo/(:num)' => array('route' => 'modulo.Delete', 'params' => array('idmodule' => 2)),
		
	// n_contato
	'GET:n_contatos' => array('route' => 'n_contato.ListView'),
	'GET:n_contato/(:num)' => array('route' => 'n_contato.SingleView', 'params' => array('id' => 1)),
	'GET:api/n_contatos' => array('route' => 'n_contato.Query'),
	'POST:api/n_contato' => array('route' => 'n_contato.Create'),
	'GET:api/n_contato/(:num)' => array('route' => 'n_contato.Read', 'params' => array('id' => 2)),
	'PUT:api/n_contato/(:num)' => array('route' => 'n_contato.Update', 'params' => array('id' => 2)),
	'DELETE:api/n_contato/(:num)' => array('route' => 'n_contato.Delete', 'params' => array('id' => 2)),
		
	// n_historico
	'GET:n_historicos' => array('route' => 'n_historico.ListView'),
	'GET:n_historico/(:num)' => array('route' => 'n_historico.SingleView', 'params' => array('idhistory' => 1)),
	'GET:api/n_historicos' => array('route' => 'n_historico.Query'),
	'POST:api/n_historico' => array('route' => 'n_historico.Create'),
	'GET:api/n_historico/(:num)' => array('route' => 'n_historico.Read', 'params' => array('idhistory' => 2)),
	'PUT:api/n_historico/(:num)' => array('route' => 'n_historico.Update', 'params' => array('idhistory' => 2)),
	'DELETE:api/n_historico/(:num)' => array('route' => 'n_historico.Delete', 'params' => array('idhistory' => 2)),
		
	// n_referencia
	'GET:n_referencias' => array('route' => 'n_referencia.ListView'),
	'GET:n_referencia/(:num)' => array('route' => 'n_referencia.SingleView', 'params' => array('id' => 1)),
	'GET:api/n_referencias' => array('route' => 'n_referencia.Query'),
	'POST:api/n_referencia' => array('route' => 'n_referencia.Create'),
	'GET:api/n_referencia/(:num)' => array('route' => 'n_referencia.Read', 'params' => array('id' => 2)),
	'PUT:api/n_referencia/(:num)' => array('route' => 'n_referencia.Update', 'params' => array('id' => 2)),
	'DELETE:api/n_referencia/(:num)' => array('route' => 'n_referencia.Delete', 'params' => array('id' => 2)),
		
	// descricao_fisica
	'GET:descricoes_fisicas' => array('route' => 'descricao_fisica.ListView'),
	'GET:descricao_fisica/(:num)' => array('route' => 'descricao_fisica.SingleView', 'params' => array('id' => 1)),
	'GET:api/descricoes_fisicas' => array('route' => 'descricao_fisica.Query'),
	'POST:api/descricao_fisica' => array('route' => 'descricao_fisica.Create'),
	'GET:api/descricao_fisica/(:num)' => array('route' => 'descricao_fisica.Read', 'params' => array('id' => 2)),
	'PUT:api/descricao_fisica/(:num)' => array('route' => 'descricao_fisica.Update', 'params' => array('id' => 2)),
	'DELETE:api/descricao_fisica/(:num)' => array('route' => 'descricao_fisica.Delete', 'params' => array('id' => 2)),
		
	// local
	'GET:locais' => array('route' => 'local.ListView'),
	'GET:local/(:num)' => array('route' => 'local.SingleView', 'params' => array('id' => 1)),
	'GET:api/locais' => array('route' => 'local.Query'),
	'POST:api/local' => array('route' => 'local.Create'),
	'GET:api/local/(:num)' => array('route' => 'local.Read', 'params' => array('id' => 2)),
	'PUT:api/local/(:num)' => array('route' => 'local.Update', 'params' => array('id' => 2)),
	'DELETE:api/local/(:num)' => array('route' => 'local.Delete', 'params' => array('id' => 2)),
		
	// referencia
	'GET:referencias' => array('route' => 'referencia.ListView'),
	'GET:referencia/(:num)' => array('route' => 'referencia.SingleView', 'params' => array('idreference' => 1)),
	'GET:api/referencias' => array('route' => 'referencia.Query'),
	'POST:api/referencia' => array('route' => 'referencia.Create'),
	'GET:api/referencia/(:num)' => array('route' => 'referencia.Read', 'params' => array('idreference' => 2)),
	'PUT:api/referencia/(:num)' => array('route' => 'referencia.Update', 'params' => array('idreference' => 2)),
	'DELETE:api/referencia/(:num)' => array('route' => 'referencia.Delete', 'params' => array('idreference' => 2)),
		
	// midia_referencia
	'GET:midia_referencias' => array('route' => 'midia_referencia.ListView'),
	'GET:midia_referencia/(:any)' => array('route' => 'midia_referencia.SingleView', 'params' => array('referenceIdreference' => 1)),
	'GET:api/midia_referencias' => array('route' => 'midia_referencia.Query'),
	'POST:api/midia_referencia' => array('route' => 'midia_referencia.Create'),
	'GET:api/midia_referencia/(:any)' => array('route' => 'midia_referencia.Read', 'params' => array('referenceIdreference' => 2)),
	'PUT:api/midia_referencia/(:any)' => array('route' => 'midia_referencia.Update', 'params' => array('referenceIdreference' => 2)),
	'DELETE:api/midia_referencia/(:any)' => array('route' => 'midia_referencia.Delete', 'params' => array('referenceIdreference' => 2)),
		
	// relacionamento_item
	'GET:relacionamento_items' => array('route' => 'relacionamento_item.ListView'),
	'GET:relacionamento_item/(:num)' => array('route' => 'relacionamento_item.SingleView', 'params' => array('id' => 1)),
	'GET:api/relacionamento_items' => array('route' => 'relacionamento_item.Query'),
	'POST:api/relacionamento_item' => array('route' => 'relacionamento_item.Create'),
	'GET:api/relacionamento_item/(:num)' => array('route' => 'relacionamento_item.Read', 'params' => array('id' => 2)),
	'PUT:api/relacionamento_item/(:num)' => array('route' => 'relacionamento_item.Update', 'params' => array('id' => 2)),
	'DELETE:api/relacionamento_item/(:num)' => array('route' => 'relacionamento_item.Delete', 'params' => array('id' => 2)),
		
	// papel
	'GET:papeis' => array('route' => 'papel.ListView'),
	'GET:papel/(:num)' => array('route' => 'papel.SingleView', 'params' => array('idrole' => 1)),
	'GET:api/papeis' => array('route' => 'papel.Query'),
	'POST:api/papel' => array('route' => 'papel.Create'),
	'GET:api/papel/(:num)' => array('route' => 'papel.Read', 'params' => array('idrole' => 2)),
	'PUT:api/papel/(:num)' => array('route' => 'papel.Update', 'params' => array('idrole' => 2)),
	'DELETE:api/papel/(:num)' => array('route' => 'papel.Delete', 'params' => array('idrole' => 2)),
		
	// busca
	'GET:buscas' => array('route' => 'busca.ListView'),
	'GET:busca/(:num)' => array('route' => 'busca.SingleView', 'params' => array('idsearch' => 1)),
	'GET:api/buscas' => array('route' => 'busca.Query'),
	'POST:api/busca' => array('route' => 'busca.Create'),
	'GET:api/busca/(:num)' => array('route' => 'busca.Read', 'params' => array('idsearch' => 2)),
	'PUT:api/busca/(:num)' => array('route' => 'busca.Update', 'params' => array('idsearch' => 2)),
	'DELETE:api/busca/(:num)' => array('route' => 'busca.Delete', 'params' => array('idsearch' => 2)),
		
	// estado
	'GET:estados' => array('route' => 'estado.ListView'),
	'GET:estado/(:num)' => array('route' => 'estado.SingleView', 'params' => array('idstate' => 1)),
	'GET:api/estados' => array('route' => 'estado.Query'),
	'POST:api/estado' => array('route' => 'estado.Create'),
	'GET:api/estado/(:num)' => array('route' => 'estado.Read', 'params' => array('idstate' => 2)),
	'PUT:api/estado/(:num)' => array('route' => 'estado.Update', 'params' => array('idstate' => 2)),
	'DELETE:api/estado/(:num)' => array('route' => 'estado.Delete', 'params' => array('idstate' => 2)),
		
	// armazenamento
	'GET:armazenamentos' => array('route' => 'armazenamento.ListView'),
	'GET:armazenamento/(:num)' => array('route' => 'armazenamento.SingleView', 'params' => array('idstorage' => 1)),
	'GET:api/armazenamentos' => array('route' => 'armazenamento.Query'),
	'POST:api/armazenamento' => array('route' => 'armazenamento.Create'),
	'GET:api/armazenamento/(:num)' => array('route' => 'armazenamento.Read', 'params' => array('idstorage' => 2)),
	'PUT:api/armazenamento/(:num)' => array('route' => 'armazenamento.Update', 'params' => array('idstorage' => 2)),
	'DELETE:api/armazenamento/(:num)' => array('route' => 'armazenamento.Delete', 'params' => array('idstorage' => 2)),
		
	// midia_armazanenamento
	'GET:midia_armazenamentos' => array('route' => 'midia_armazanenamento.ListView'),
	'GET:midia_armazanenamento/(:any)' => array('route' => 'midia_armazanenamento.SingleView', 'params' => array('storageIdstorage' => 1)),
	'GET:api/midia_armazenamentos' => array('route' => 'midia_armazanenamento.Query'),
	'POST:api/midia_armazanenamento' => array('route' => 'midia_armazanenamento.Create'),
	'GET:api/midia_armazanenamento/(:any)' => array('route' => 'midia_armazanenamento.Read', 'params' => array('storageIdstorage' => 2)),
	'PUT:api/midia_armazanenamento/(:any)' => array('route' => 'midia_armazanenamento.Update', 'params' => array('storageIdstorage' => 2)),
	'DELETE:api/midia_armazanenamento/(:any)' => array('route' => 'midia_armazanenamento.Delete', 'params' => array('storageIdstorage' => 2)),
		
	// timezone
	'GET:timezones' => array('route' => 'timezone.ListView'),
	'GET:timezone/(:num)' => array('route' => 'timezone.SingleView', 'params' => array('idtimezone' => 1)),
	'GET:api/timezones' => array('route' => 'timezone.Query'),
	'POST:api/timezone' => array('route' => 'timezone.Create'),
	'GET:api/timezone/(:num)' => array('route' => 'timezone.Read', 'params' => array('idtimezone' => 2)),
	'PUT:api/timezone/(:num)' => array('route' => 'timezone.Update', 'params' => array('idtimezone' => 2)),
	'DELETE:api/timezone/(:num)' => array('route' => 'timezone.Delete', 'params' => array('idtimezone' => 2)),
		
	// titulo
	'GET:titulos' => array('route' => 'titulo.ListView'),
	'GET:titulo/(:num)' => array('route' => 'titulo.SingleView', 'params' => array('idtitle' => 1)),
	'GET:api/titulos' => array('route' => 'titulo.Query'),
	'POST:api/titulo' => array('route' => 'titulo.Create'),
	'GET:api/titulo/(:num)' => array('route' => 'titulo.Read', 'params' => array('idtitle' => 2)),
	'PUT:api/titulo/(:num)' => array('route' => 'titulo.Update', 'params' => array('idtitle' => 2)),
	'DELETE:api/titulo/(:num)' => array('route' => 'titulo.Delete', 'params' => array('idtitle' => 2)),
		
	// transcicao
	'GET:transcricoes' => array('route' => 'transcicao.ListView'),
	'GET:transcicao/(:num)' => array('route' => 'transcicao.SingleView', 'params' => array('idtranscription' => 1)),
	'GET:api/transcricoes' => array('route' => 'transcicao.Query'),
	'POST:api/transcicao' => array('route' => 'transcicao.Create'),
	'GET:api/transcicao/(:num)' => array('route' => 'transcicao.Read', 'params' => array('idtranscription' => 2)),
	'PUT:api/transcicao/(:num)' => array('route' => 'transcicao.Update', 'params' => array('idtranscription' => 2)),
	'DELETE:api/transcicao/(:num)' => array('route' => 'transcicao.Delete', 'params' => array('idtranscription' => 2)),
		
	// usuario
	'GET:usuarios' => array('route' => 'usuario.ListView'),
	'GET:usuario/(:num)' => array('route' => 'usuario.SingleView', 'params' => array('iduser' => 1)),
	'GET:api/usuarios' => array('route' => 'usuario.Query'),
	'POST:api/usuario' => array('route' => 'usuario.Create'),
	'GET:api/usuario/(:num)' => array('route' => 'usuario.Read', 'params' => array('iduser' => 2)),
	'PUT:api/usuario/(:num)' => array('route' => 'usuario.Update', 'params' => array('iduser' => 2)),
	'DELETE:api/usuario/(:num)' => array('route' => 'usuario.Delete', 'params' => array('iduser' => 2)),
		
	// papel_usuario
	'GET:papeis_usuarios' => array('route' => 'papel_usuario.ListView'),
	'GET:papel_usuario/(:num)' => array('route' => 'papel_usuario.SingleView', 'params' => array('iduserrole' => 1)),
	'GET:api/papeis_usuarios' => array('route' => 'papel_usuario.Query'),
	'POST:api/papel_usuario' => array('route' => 'papel_usuario.Create'),
	'GET:api/papel_usuario/(:num)' => array('route' => 'papel_usuario.Read', 'params' => array('iduserrole' => 2)),
	'PUT:api/papel_usuario/(:num)' => array('route' => 'papel_usuario.Update', 'params' => array('iduserrole' => 2)),
	'DELETE:api/papel_usuario/(:num)' => array('route' => 'papel_usuario.Delete', 'params' => array('iduserrole' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("City","fk_city_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("City","fk_city_state1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Creator","fk_creator_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("CreatorAwardHonour","FK_qr69vjpxl6txy39isg3fpmx6q",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("CreatorContact","FK_c6nw3s2tta2x613rsgefyiegs",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("CreatorHistory","FK_kv28ykd90gnj9a3ika7vvbsib",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Datalog","fk_datalog_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Documentation","fk_document_item1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Documentation","fk_documentation_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("DocumentationMedia","FK_6e9vbhu4tcokto4knwv1qf4ah",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Expoitem","fk_expoitem_exposition",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Expoitem","fk_expoitem_item",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exposition","fk_exposition_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ExpositionCreator","FK_kwh7ariugb0qjrwhpo3rai1uy",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ExpositionCreator","FK_rqs393faxa7qvmarkbh38rhay",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ExpositionDimension","FK_69we0kulo49s1sr97htshsxtw",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ExpositionDimension","FK_ai09pidrxa780uxmakwlex92c",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ExpositionHistory","FK_g6g5n45iyajyahsp1dfaeff4b",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ExpositionHistory","FK_sfxtpv6nypctjcamcjgov1etg",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Fond","fk_fond_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("History","fk_history_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("History","fk_history_item1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Holder","fk_holder_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Institution","fk_institution_timezone",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("InstitutionLevel","FK_4pu1mko6s7rh12iydqohhngj",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("InstitutionLevel","FK_56md01pp54ivtjhs8gg0esb9s",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("InstitutionMedia","FK_3lwqddobdgdre6fm972g8f6ul",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("InstitutionMedia","FK_b8huwidanw431gu321kah8d3d",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ItemMedia","FK_4922opf11ju2cvt7s73ofcb8a",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ItemMedia","FK_sey6rhf0ydi6904yk08gu42d9",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Itemcreator","fk_document_has_creator_creator1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Itemcreator","fk_document_has_creator_document1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Itemdescription","fk_item_description",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Itemdimension","fk_item_dimension",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Iteminscription","fk_item_inscription",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Level","fk_serie_fond1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Level","fk_serie_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Level","fk_series_series",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Media","fk_media_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Media","fk_media_item1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Media","fk_media_storage1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Ncontact","FK_q27ejta8y2arisfx6k2v8y01v",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Nreference","FK_360fxrl1q9vf3b3yu70b0lxl1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Physicaldescription","fk_item_physical",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Reference","fk_reference_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("ReferenceMedia","FK_1i4ds2wp2qiswb43dcjl1tfy6",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("RelationshipItem","FK_c0y3gf5cowm6uo7ecld19tuqa",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("RelationshipItem","FK_geqqk61hbyqn45ylpg1fwctja",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Role","fk_role_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Search","fk_search_user1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("State","fk_state_country1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("StorageMedia","FK_hrmsbocvkwn14rnyh8qj55dfc",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("StorageMedia","FK_nmymba781jas5ih7fojmm9435",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Title","fk_title_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Title","fk_title_item1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Transcription","fk_transcription_item1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("User","fk_user_institution1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("User","fk_user_timezone",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Userrole","fk_user_has_role_role1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Userrole","fk_user_has_role_user1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>