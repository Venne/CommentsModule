<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Venne\Elements;

use Venne;
use Venne\Application\UI\Control;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class CommentsControl extends Control {

	/** @var \App\CommentsModule\Entities\CommentsEntity */
	protected $item;

	public function startup()
	{
		parent::startup();

		$repository = $this->presenter->context->comments->commentsRepository;

		$this->item = $item = $repository->findOneBy(array("page" => $this->presenter->page->page->id));
		if ($item) {
			$this->template->show = true;
			$this->template->items = $item->items;
		}
	}



	public function createComponentForm($name)
	{
		$repository = $this->presenter->context->comments->commentRepository;
		$entity = $repository->createNew();
		$entity->comments = $this->item;

		$form = $this->presenter->context->comments->createCommentForm();
		$form->setEntity($entity);
		$form->addSubmit("submit", "Send");
		$form->onSuccess[] = function($form) use ($repository){
			$repository->save($form->entity);
			$form->presenter->flashMessage("Comment has been saved", "success");
			$form->presenter->redirect("this");
		};
		return $form;
	}



	public function handleDelete($id)
	{
		$repository = $this->presenter->context->comments->commentRepository;
		$repository->delete($repository->find($id));
		$this->presenter->flashMessage("Comment has been removed", "success");
		$this->redirect("this");
	}

}
