<?php

$is_logged = function ($request, $response, $next) {
    $logged = isset($_SESSION['logged']) && $_SESSION['logged'] === true;

    if ($logged) {
        $uri = $request->getUri()->withPath($this->router->pathFor('admin-dashboard'));

        return $response = $response->withRedirect($uri, 403);
    }

    return $next($request, $response);
};

$is_not_logged = function ($request, $response, $next) {
    $logged = isset($_SESSION['logged']) && $_SESSION['logged'] === true;

    if (!$logged) {
        $uri = $request->getUri()->withPath($this->router->pathFor('admin'));

        return $response = $response->withRedirect($uri, 403);
    }

    return $next($request, $response);
};
