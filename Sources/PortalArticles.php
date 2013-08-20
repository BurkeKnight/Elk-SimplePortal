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

if (!defined('ELK'))
	die('No access...');

function sportal_articles()
{
	global $context, $scripturl, $txt;

	loadTemplate('PortalArticles');

	$context['SPortal']['articles'] = sportal_get_articles(0, true, true, 'spa.id_article DESC');

	foreach ($context['SPortal']['articles'] as $article)
	{
		if (($cutoff = Util::strpos($article['body'], '[cutoff]')) !== false)
			$article['body'] = Util::substr($article['body'], 0, $cutoff);

		$context['SPortal']['articles'][$article['id']]['preview'] = parse_bbc($article['body']);
		$context['SPortal']['articles'][$article['id']]['date'] = timeformat($article['date']);
	}

	$context['linktree'][] = array(
		'url' => $scripturl . '?action=portal;sa=articles',
		'name' => $txt['sp-articles'],
	);

	$context['page_title'] = $txt['sp-articles'];
	$context['sub_template'] = 'view_articles';
}