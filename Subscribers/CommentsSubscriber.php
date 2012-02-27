<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\CommentsModule\Subscribers;

use Doctrine\Common\EventSubscriber;
use Venne\ContentExtension\Events;
use Nette\DI\Container;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class CommentsSubscriber implements EventSubscriber
{

	/** @var \Venne\Doctrine\ORM\BaseRepository */
	protected $repository;

	/** @var \Nette\Application\Application */
	protected $application;



	/**
	 * @param Container|\SystemContainer $context
	 * @param \Nette\Application\Application
	 */
	public function __construct(Container $context,\Nette\Application\Application $application)
	{
		$this->repository = $context->comments->commentsRepository;
		$this->application = $application;
	}



	/**
	 * @return array
	 */
	public function getSubscribedEvents()
	{
		return array(
			Events::onCreate,
			Events::onLoad,
			Events::onSave,
			Events::onRemove,
			Events::onRender
		);
	}



	public function onSave(\Venne\ContentExtension\EventArgs $args)
	{
		$form = $args->form;
		$page = $args->page;

		$values = $form->getContentExtensionContainer("comments")->getValues();
		if($values["use"]){
			if(!$form->entity->id || ($form->entity->id && !$this->repository->findOneByPage($form->entity->id))){
				$entity = $this->repository->createNew(array($form->entity->page));
				$this->repository->save($entity);
			}
		}else{
			if($form->entity->id){
				$entity = $this->repository->findOneByPage($form->entity->id);
				if($entity){
					$this->repository->delete($entity);
				}
			}
		}
	}



	public function onCreate(\Venne\ContentExtension\EventArgs $args)
	{
		$form = $args->form;

		$container = $form->addContentExtensionContainer("comments", "Comments settings");
		$container->addCheckbox("use", "Allow comments")->setDefaultValue(false);

		$form->setCurrentGroup();
	}



	public function onLoad(\Venne\ContentExtension\EventArgs $args)
	{
		$form = $args->form;
		$page = $args->page;

		if($form->entity->id){
			$entity = $this->repository->findOneByPage($form->entity->id);
			if($entity){
				$container = $form->getContentExtensionContainer("comments");
				$container["use"]->setValue(true);
			}
		}
	}


	public function onRender()
	{
		/** @var $presenter \Nette\Application\UI\Presenter */
		$presenter = $this->application->getPresenter();

		$component = new \Venne\Elements\CommentsControl();

		$presenter->addComponent($component,"contentExtension_comments");

		$component->render();
	}

}
