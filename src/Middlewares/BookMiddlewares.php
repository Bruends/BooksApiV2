<?php

namespace BookshelfApi\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class BookMiddlewares{
    public static function addMiddlewares($app) {
        // enabling CORS
        $app->add(function(Request $request, RequestHandler $handler){

            $response = $handler->handle($request);

            return $response
                ->withHeader("Access-Control-Allow-Origin", ALLOWED_CORS_DOMAINS)
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        });

        return $app;
    }
}
