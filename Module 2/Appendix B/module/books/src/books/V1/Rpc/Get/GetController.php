<?php
namespace books\V1\Rpc\Get;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;


class GetController extends AbstractActionController
{
    public function getAction()
    {
	    	$books = [ 'success' => [
		    			[
		    				'title' => 'PHP 7 High Performance',
		    				'author' => 'Altaf Hussain'	
		    			],
		    			[
		    				'title' => 'Magento 2',
		    				'author' => 'Packt Publisher'
		    			],
	    			]
    			];
    
    	return new ViewModel($books);
    }
}
