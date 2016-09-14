<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/19/16
 * Time: 3:07 PM
 */

include 'libs/book.php';
include 'libs/ebook.php';
include 'libs/video.php';
include 'libs/presentation.php';
include 'libs/constants.php';
include 'libs/functions.php';

/*$book = new \publishers\packt\Book();
$ebook = new \publishers\packt\Ebook();
$video = new \publishers\packt\Video();
$pres = new \publishers\packt\Presentation();

echo \publishers\packt\getBook().'<br>';
echo \publishers\packt\saveBook('PHP 7 High Performance').'<br>';
echo \publishers\packt\COUNT.'<br>';
echo \publishers\packt\KEY.'<br>';*/

/*use publishers\packt\Book;
use publishers\packt\Ebook;
use publishers\packt\Video;
use publishers\packt\Presentation;
use function publishers\packt\saveBook;
use function publishers\packt\getBook;
use const publishers\packt\COUNT;
use const publishers\packt\KEY;*/

use publishers\packt\{ Book, Ebook, Video, Presentation,  const COUNT, function getBook, function saveBook};

$book = new Book();
$ebook = new Ebook();
$video = new Video();
$pres = new Presentation();

echo getBook().'<br>';
echo saveBook('Php 7 High Performance').'<br>';
echo COUNT.'<br>';


echo $book->get().'<br>';
echo $ebook->get().'<br>';
echo $video->get().'<br>';
echo $pres->get().'<br>';