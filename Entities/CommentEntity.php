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
 * @Table(name="commentsItem")
 */
class CommentEntity extends \Venne\Doctrine\ORM\BaseEntity {

	/**
	 * @ManyToOne(targetEntity="CommentEntity", inversedBy="id")
	 * @JoinColumn(name="comment_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $parent;

	/**
	 * @ManyToOne(targetEntity="CommentsEntity", inversedBy="id")
	 * @JoinColumn(name="comments_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $comments;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @OneToMany(targetEntity="CommentEntity", mappedBy="parent")
	 * @OrderBy({"order" = "ASC"})
	 */
	protected $childrends;

	/** @Column(type="datetime") */
	protected $created;

	/** @Column(type="string") */
	protected $author;

	/** @Column(type="text") */
	protected $text;



	public function __construct()
	{
		$this->created = new \Nette\DateTime;
		$this->childrends = new \Doctrine\Common\Collections\ArrayCollection();
		$this->author = "";
		$this->text = "";
	}



	public function setAuthor($author)
	{
		$this->author = $author;
	}



	public function getAuthor()
	{
		return $this->author;
	}



	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $childrends
	 */
	public function setChildrends($childrends)
	{
		$this->childrends = $childrends;
	}



	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getChildrends()
	{
		return $this->childrends;
	}



	public function setComments($comments)
	{
		$this->comments = $comments;
	}



	public function getComments()
	{
		return $this->comments;
	}



	public function setCreated($created)
	{
		$this->created = $created;
	}



	public function getCreated()
	{
		return $this->created;
	}



	public function setDatetime($datetime)
	{
		$this->datetime = $datetime;
	}



	public function getDatetime()
	{
		return $this->datetime;
	}



	public function setParent($parent)
	{
		$this->parent = $parent;
	}



	public function getParent()
	{
		return $this->parent;
	}



	public function setText($text)
	{
		$this->text = $text;
	}



	public function getText()
	{
		return $this->text;
	}


}
