<?php
$app->get('/(:page)', function($page = 1) use ($app, $settings) {
    $p = Posts::count();
    $pages = ceil($p / $settings->post_per_page);
    if ($page > $pages) $app->pass();

    $posts = Posts::orderBy('creation', 'desc')->skip($settings->post_per_page * ($page - 1))->take($settings->post_per_page)->get();
    $arr = array(); //Posts
    foreach ($posts as $post) {
        if ($post['active'] == 'true') {
            $post['author'] = Users::get_author($post['user_id']);
            $post['date'] = date('d-m-Y H:i', $post['creation']);
            $post['url'] = $app->request->getUrl() . $app->request->getPath() . 'post/' . $post['id'];

            if ($settings->truncate == 'true') {
                $text = truncate_to_n_words($post['text'], 70, $post['url']);
                $post['text'] = $app->markdown->parse($text);
            } else {
                $post['text'] = $app->markdown->parse($post['text']);
            }

            $post['count'] = Posts::find($post['id'])->comments->count();
            $arr[] = $post;
        }
    }


    $app->render('posts.html', array('posts' => $arr, 'pages' => $pages, 'page' => $page));
})->conditions(array('page' => '\d+'));