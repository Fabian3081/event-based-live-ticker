<?php

declare(strict_types=1);

namespace tickerEvents;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostIsAuthenticatedAction
{
    /**
     * @var UserLoader
     */
    private UserLoader $userLoader;

    public function __construct(
        UserLoader $userLoader
    ) {
       $this->userLoader = $userLoader;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $post = json_decode($request->getBody()->getContents(), true);

        $username = $post["username"];
        $password = $post["password"];

        if (password_verify($password, $this->userLoader->loadPasswordHash($username))) {
            $responseMsg = [
                "authenticated" => true,
                "requestedUsername" => $username
            ];
        } else {
            $responseMsg = [
                "authenticated" => false,
                "requestedUsername" => $username
            ];
        }

        $response->getBody()->write(json_encode($responseMsg));

        return $response
            ->withHeader('Content-type', ['application/json', 'charset=UTF-8'])
            ->withStatus(200);
    }
}
