<?php
namespace App\Action;

use Application\MiddleWare\Session\Validator;
use Zend\Diactoros\ { Request, Response };
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SessionValidateAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $inbound   = new Response();
        $validator = new Validator($request, time()+10);
        $inbound   = $validator($request, $response);
        if ($inbound->getStatusCode() != 200) {
            // take some action
            session_destroy();
            setcookie('PHPSESSID', 0, time()-300);
            $params = json_decode($inbound->getBody()->getContents(), TRUE);
            echo '<h1>',$params[Validator::KEY_TEXT],'</h1>';
            echo '<pre>';
            var_dump($inbound);
            echo '</pre>';
            exit;
        }
        return $next($request,$response);
    }
}
