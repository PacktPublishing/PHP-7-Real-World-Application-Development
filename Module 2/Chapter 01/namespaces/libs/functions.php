<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/19/16
 * Time: 3:31 PM
 */

namespace publishers\packt;

function getBook() : string
{
    return 'Its PHP 7';
}

function saveBook(string $book) : string
{
    return $book.' book Saved';
}