<?php //var_dump($post) ?>

    <!--SINGLE POST VIEW /posts/show/ID-->
    <a href="/posts" class="btn btn-light my-3"><i class="fa fa-chevron-left"></i> Back</a>

    <h1 class="display-3"><?php echo $post->title ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <strong><?php echo $user->name ?></strong>
        On : <?php echo $post->created_at ?>
    </div>
    <p class="lead"><?php echo $post->body ?></p>


    <!-------------------------------------------------------------------------------------------------------->
    <!--MYGTUKAI 'EDIT' IR 'DELETE'-->
    <hr>
<?php //if ($post']->user_ === $_SESSION['user_id']) : ?>
    <!--PARODO PARAM ID-->
    <a href="<?php echo '/posts/edit/' . $post->post_id ?>" class="btn btn-info"><i
                class="fa fa-pencil"></i> Edit</a>

    <!--forma apdorojama posts/delete-->
    <form action="<?php echo '/posts/delete/' . $post->post_id ?>" method="post" class="float-right">
        <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Delete</button>
    </form>

    <div id="out"></div>
<?php
//endif;