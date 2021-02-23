<?php


namespace app\controller;


use app\core\Controller;
use app\model\PostModel;

class PostsController extends Controller
{
    public PostModel $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts,
        ];
        return $this->render('posts/posts', $data);
    }

    public function post()
    {
        $data = [];
        return $this->render('posts/singlePost', $data);

    }
}


//CREATE TABLE `31-almostlara`.`posts` ( `post_id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(150) NOT NULL , `body` TEXT NOT NULL , `created_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `user_id` INT NOT NULL , PRIMARY KEY (`post_id`)) ENGINE = InnoDB;

//ALTER TABLE `posts` ADD CONSTRAINT `postID_to_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;