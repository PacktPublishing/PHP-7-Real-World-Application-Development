<?php
return array(
    'controllers' => array(
        'factories' => array(
            'books\\V1\\Rpc\\Get\\Controller' => 'books\\V1\\Rpc\\Get\\GetControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'books.rpc.get' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/books/get',
                    'defaults' => array(
                        'controller' => 'books\\V1\\Rpc\\Get\\Controller',
                        'action' => 'get',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'books.rpc.get',
        ),
    ),
    'zf-rpc' => array(
        'books\\V1\\Rpc\\Get\\Controller' => array(
            'service_name' => 'get',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'books.rpc.get',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'books\\V1\\Rpc\\Get\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'books\\V1\\Rpc\\Get\\Controller' => array(
                0 => 'application/vnd.books.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'books\\V1\\Rpc\\Get\\Controller' => array(
                0 => 'application/vnd.books.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'books\\V1\\Rpc\\Get\\Controller' => array(
            'input_filter' => 'books\\V1\\Rpc\\Get\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'books\\V1\\Rpc\\Get\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'title',
                'description' => 'This field will hold the title of the book',
                'error_message' => 'This is a required field',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'author',
                'description' => 'This field will hold author of the book',
                'error_message' => 'Author is required',
            ),
        ),
    ),
);
