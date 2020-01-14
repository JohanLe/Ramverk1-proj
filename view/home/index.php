<?php

namespace Anax\View;

?>

<div class="">
    <h3>What is going on?</h3>
    <div>
        <h5> Latest Questions</h5>

        <?php foreach ($questions as $question) : ?>
            
            <a href="<?= url("question/update/{$question->id}"); ?>"><?= $question->id ?></a>
            <?= $question->title ?>
            Asked by: <?= $question->user_id ?>
            <?= $question->date ?>
            
            </br>
        <?php endforeach; ?>

    </div>

    <div>
        <h5> Treding tags</h5>
        <?php foreach ($tags as $tag) : ?>
             <a href="<?= url("tag/update/{$tag->id}"); ?>"><?= $tag->text ?></a> 
            </br>
        <?php endforeach; ?>
    </div>

    <div>
        <h5> Most Active users</h5>
        <p>TODO -  Count numer of questions+answers+comments</p>
        <?php foreach ($users as $user) : ?>
            
            <a href="<?= url("user/update/{$user->id}"); ?>"><?= $user->username ?></a>
            <?= $user->email ?>
    
            </br>
        <?php endforeach; ?>
    </div>
</div>