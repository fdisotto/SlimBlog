<?php
namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Article;

class HomeAction extends BaseAction
{
    public function __invoke(Request $request, Response $response)
    {
        $this->setViewData('articles', Article::all()->toArray());
        $this->setViewData('messages', $this->flash->getMessages());

        $this->view->render($response, 'pages/homepage.twig', $this->viewData);
    }

    public function logout(Request $request, Response $response)
    {
        unset($_SESSION['logged']);
        unset($_SESSION['user_id']);

        $this->flash->addMessage('info', $this->translator->trans('Logged out succesfully'));

        $uri = $request->getUri()->withPath($this->router->pathFor('homepage'));

        return $response = $response->withRedirect($uri, 403);
    }
}
