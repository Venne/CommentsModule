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

use Venne\ORM\Column;

/**
 * @author Josef Kříž
 * @Entity
 * @Table(name="commentsItem")
 * 
 * @property string $key
 * @property integer $order
 * @property $datetime
 * @property string $author
 * @property string $text
 */
class CommentsItemEntity extends \Venne\Doctrine\ORM\BaseEntity {

	/** @Column(type="string", name="`key`") */
	protected $key;
	/** @Column(type="integer", name="`order`") */
	protected $order;
	/** @Column(type="datetime") */
	protected $created;
	/** @Column(type="string") */
	protected $author;
	/** @Column(type="text") */
	protected $text;
	
	public function __construct()
	{
		if(!$this->created) $this->created = new \Nette\DateTime;
		$this->key = "";
		$this->order = 0;
	}

}
