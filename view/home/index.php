<?php

namespace Anax\View;

$userHelper = new \Anax\User\UserHelper();


?>


<div class="">
    <h3>What is going on?</h3>
    <div>
        <h5> Latest Questions</h5>
        <?php foreach ($questions as $question) : ?>
            <a href="<?=url("question/view/$question->id")?>"><?=$question->title?></a>

            Asked by: <?=$question->username?>
            <?=$question->date?>

            </br>
        <?php endforeach;?>

    </div>

    <div>
        <h5> Treding tags</h5>

        <?php foreach ($tags as $tag) : ?>
            <span>
                <a href="<?=url("tag/view/{$tag->id}");?>"><?=$tag->text?></a>
                - Used  <?=$tag->amount?> times.
            </span>

            </br>
        <?php endforeach;?>
    </div>

    <div>
        <h5> Most Active users<span> (Questions, answers & comments) </span> </h5>
        <?php foreach ($users as $user) : ?>
            <a href="<?=url("user/view/{$user->id}");?>"><?=$user->username?></a>
            Posts: <?=$user->amount?>

            </br>
        <?php endforeach;?>
    </div>
</div>