<?php

include(__DIR__.'/../Book.php');

class BookTest extends PHPUnit_Framework_TestCase
{
	public function testBookClass()
	{
		$bookObj = new Book('PHP');
		$book = $bookObj->getBook();

		$this->assertEquals('PHP 7', $book);
	}
}

?>
