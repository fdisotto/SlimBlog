<?php
namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Article;

class ArticleAction extends BaseAction
{
    public function __invoke(Request $request, Response $response, $args)
    {
        $slug = $args['slug'];

        $article = Article::where('slug', '=', $slug)->first()->toArray();

        $this->setViewData('article', $article);

        $this->view->render($response, 'pages/article.twig', $this->viewData);
    }
}
