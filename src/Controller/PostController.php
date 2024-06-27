<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = $this->getPosts();

        return $this->renderView("index", ["posts" => $posts]);
    }

    public function post()
    {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $post = new Post($title, $content);

        // Session as temporary DB replacement
        $posts = $this->getPosts();
        array_push($posts, $post);
        $_SESSION["posts"] = serialize($posts);

        // Redirect to home
        header('Location: ' . "/");
    }

    private function getPosts(): array
    {
        // Session as temporary DB replacement (thats why no direct $_SESSION in the view)
        return isset($_SESSION["posts"]) ? unserialize($_SESSION["posts"]) : [];
    }
}