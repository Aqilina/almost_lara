<?php


namespace app\controller;


use app\core\Controller;
use app\model\PostModel;
use app\model\UserModel;
use app\core\Request;

class PostsController extends Controller
{
    public PostModel $postModel;
    public UserModel $userModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->userModel = new UserModel();
    }

    public function index(Request $request)
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts,
        ];
        return $this->render('posts/posts', $data);
    }

    public function post(Request $request, $urlParam = null)
    {
        if ($urlParam['value']) : //value = id value

            $id = $urlParam['value'];

            //get post data by post id
            $post = $this->postModel->getPostById($id);
            //get user data by user id
            $user = $this->userModel->getUserById($post->user_id);

            $data = [
//                $urlParam['name'] => $urlParam['value'],
                'post' => $post,
                'user' => $user
            ];




            return $this->render('posts/singlePost', $data);
        endif;

        $request->redirect('/posts');
    }
}


//CREATE TABLE `31-almostlara`.`posts` ( `post_id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(150) NOT NULL , `body` TEXT NOT NULL , `created_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `user_id` INT NOT NULL , PRIMARY KEY (`post_id`)) ENGINE = InnoDB;

//ALTER TABLE `posts` ADD CONSTRAINT `postID_to_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;