<?php
return array(
    'books\\V1\\Rpc\\Get\\Controller' => array(
        'description' => 'This service returns all the books.',
        'GET' => array(
            'description' => 'This service does not accept any parameters and returns all books.',
            'response' => '{
   "title": "This field will hold the title of the book",
   "author": "This field will hold author of the book"
}',
        ),
    ),
);
