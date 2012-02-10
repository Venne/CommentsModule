<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\CommentsModule\Entities;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\Venne\Doctrine\ORM\BaseRepository")
 * @Table(name="comments")
 */
class CommentsEntity extends \Venne\Doctrine\ORM\BaseEntity {

	/**
	 * @var \App\CoreModule\Entities\PageEntity
	 * @ManyToOne(targetEntity="\App\CoreModule\Entities\PageEntity", cascade={"persist"})
	 * @JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $page;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @OneToMany(targetEntity="CommentEntity", mappedBy="comments")
	 * @OrderBy({"id" = "ASC"})
	 */
	protected $items;


	public function __construct(\App\CoreModule\Entities\PageEntity $page)
	{
		$this->page = $page;
		$this->items = new \Doctrine\Common\Collections\ArrayCollection();
	}



	public function setItems($items)
	{
		$this->items = $items;
	}



	public function getItems()
	{
		return $this->items;
	}



	/**
	 * @param \App\CoreModule\Entities\PageEntity $page
	 */
	public function setPage($page)
	{
		$this->page = $page;
	}



	/**
	 * @return \App\CoreModule\Entities\PageEntity
	 */
	public function getPage()
	{
		return $this->page;
	}


}
