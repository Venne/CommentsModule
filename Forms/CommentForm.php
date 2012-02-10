<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\CommentsModule\Forms;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class CommentForm extends \Venne\Forms\EntityForm
{


	public function startup()
	{
		parent::startup();

		$this->addGroup();
		$this->addText("author", "Name")->addRule(self::FILLED, "Enter name");
		$this->addTextArea("text", "Comment")->addRule(self::FILLED, "Enter comment");
	}


}
