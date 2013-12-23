<?php
$app->get('/post/:id', function($id) use ($app) {
    if ($post = Posts::find($id)) {
        $flash = $app->view()->getData('flash');
        $error = isset($flash['error']) ? $flash['error'] : '';

        $post->author = Users::get_author($post->user_id);
        $post->date = date('d-m-Y H:i', $post->creation);
        $post->text = $app->markdown->transformMarkdown($post->text);
        $post->count = Posts::find($post->id)->comments->count();

        $comments = Posts::find($post->id)->comments;

        $redirect = $app->request->getUrl() . $app->request->getPath();

        $app->render('post.html', array('post' => $post, 'error' => $error, 'comments' => $comments, 'redirect' => $redirect));
    }
})->conditions(array('page' => '\d+'));

$app->post('/post/comment/new', function() use($app, $settings) {
    $username = $app->request->post('username');
    $url = filter_var($app->request->post('url'), FILTER_SANITIZE_URL);
    $email = $app->request->post('email');
    $text = filter_var($app->request->post('text'), FILTER_SANITIZE_STRING);
    $post_id = $app->request->post('post_id');
    $redirect = $app->request->post('redirect');

    if($username == "") {
        $app->flash('error', 'Please check username.');
        $app->redirect($settings->base_url . '/post/' . $post_id);
    }
    if($url == "") {
        $app->flash('error', 'Please check url.');
        $app->redirect($settings->base_url . '/post/' . $post_id);
    }
    if($email == "" OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $app->flash('error', 'Please check email.');
        $app->redirect($settings->base_url . '/post/' . $post_id);
    }
    if($text == "") {
        $app->flash('error', 'Please check text.');
        $app->redirect($settings->base_url . '/post/' . $post_id);
    }

    Comments::insert(array('username' => $username, 'url' => $url, 'email' => $email, 'text' => $text, 'posts_id' => $post_id));
    $app->render('success.html', array('redirect' => $redirect));
});