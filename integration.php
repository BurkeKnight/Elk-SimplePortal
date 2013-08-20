<?php

/**
 * @package SimplePortal
 *
 * @author SimplePortal Team
 * @copyright 2013 SimplePortal Team
 * @license BSD 3-clause
 *
 * @version 2.4
 */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('ELK'))
{
	$_GET['debug'] = 'Blue Dream!';
	require_once(dirname(__FILE__) . '/SSI.php');
}
elseif (!defined('ELK'))
	die('<b>Error:</b> Cannot install - please verify you put this in the same place as ELK\'s index.php.');

global $context;

$hooks = array(
	'integrate_pre_include' => array('SOURCEDIR/Subs-PortalIntegration.php', 'SOURCEDIR/Subs-Portal.php'),
	'integrate_load_theme' => array('sportal_init'),
	'integrate_actions' => array('sp_integrate_actions'),
	'integrate_admin_areas' => array('sp_integrate_admin_areas'),
);

$integration_function = empty($context['uninstalling']) ? 'add_integration_function' : 'remove_integration_function';
foreach ($hooks as $hook => $functions)
	foreach ($functions as $function)
		$integration_function($hook, $function);

if (ELK == 'SSI')
	echo 'Integration changes were carried out successfully.';