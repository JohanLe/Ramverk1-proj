<?php

namespace Anax\View;

$userHelper = new \Anax\User\UserHelper();


?>

<div class="whats-new">
    <h3>What is going on?</h3>
    <div class="latest-questions">
        <h5> Latest Questions</h5>
        <?php foreach ($questions as $question) : ?>
            <div class="item">
                <a href="<?=url("question/view/$question->id")?>"><?=$question->title?></a>
                <p>Asked by: <?=$question->username?> <?=$question->date?></p>
            </div>
        <?php endforeach;?>

    </div>

    <div class="trending-tags">
        <h5> Treding tags</h5>

        <?php foreach ($tags as $tag) : ?>
            <div class="item">
                <a href="<?=url("tag/view/{$tag->id}");?>"><?=$tag->text?></a>
                <p>- Used  <?=$tag->amount?> times.</p>
            </div>
        <?php endforeach;?>
    </div>

    <div class="active-users">
        <h5> Most Active users<span> (Questions, answers & comments) </span> </h5>
        <?php foreach ($users as $user) : ?>
            <div class="item">
                <a href="<?=url("user/view/{$user->id}");?>"><?=$user->username?></a>
                <p>Posts: <?=$user->amount?></p>

            </div>
        <?php endforeach;?>
    </div>
</div>
