<?php 

class Book
{
	public $book;

	public function __construct($book)
	{
		$this->book = $book;
	}
	
	public function getBook()
	{
		return $this->book;
	}
}
