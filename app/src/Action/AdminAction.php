<?php
namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\User;

class AdminAction extends BaseAction
{
    public function __invoke(Request $request, Response $response)
    {
        $this->setViewData('messages', $this->flash->getMessages());

        $this->view->render($response, 'pages/admin.twig', $this->viewData);
    }

    public function login(Request $request, Response $response)
    {
        $args = $request->getParsedBody();
        $username = $args['username'];
        $password = $args['password'];

        $user = User::where('username', '=', $username)->first();

        /*$options = [
            'cost' => 12,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        echo password_hash("admin", PASSWORD_BCRYPT, $options)."\n";*/

        if (password_verify($password, $user['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $user['id'];

            $uri = $request->getUri()->withPath($this->router->pathFor('admin-dashboard'));

            return $response = $response->withRedirect($uri, 403);
        }

        $this->flash->addMessage('error', $this->translator->trans('Username or password not valid'));

        $uri = $request->getUri()->withPath($this->router->pathFor('admin'));

        return $response = $response->withRedirect($uri, 403);
    }

    public function dashboard(Request $request, Response $response)
    {
        $this->viewData['route'] = $this->getRouteName($request);
        $this->view->render($response, 'pages/admin-dashboard.twig', $this->viewData);
    }

    private function getRouteName(Request $request)
    {
        $route = $request->getAttribute('route');

        return $route->getName();
    }
}
