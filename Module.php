<?php

/**
 * Venne:CMS (version 2.0-dev released on $WCDATE$)
 *
 * Copyright (c) 2011 Josef Kříž pepakriz@gmail.com
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\CommentsModule;

use \Venne\Developer\Module\Service\IRouteService;

/**
 * @author Josef Kříž
 */
class Module extends \Venne\Module\AutoModule {


	public function getName()
	{
		return "comments";
	}


	public function getDescription()
	{
		return "Content submodule for comments";
	}


	public function getVersion()
	{
		return "2.0";
	}

	public function setServices(\Venne\DI\Container $container)
	{
		$container->services->addService("comments", function() use ($container) {
					return new Service($container, "comments", $container->doctrineContainer->entityManager);
				}
		);
		$container->services->addService("commentItems", function() use ($container) {
					return new Service($container, "commentsItem", $container->doctrineContainer->entityManager);
				}
		);
	}
	
	public function setHooks(\Venne\DI\Container $container, \App\HookModule\Manager $manager)
	{
		$manager->addHookExtension(\App\HookModule\Manager::EXTENSION_CONTENT, new CommentsContentExtension($container->services->comments));
	}

}
