<?php

namespace Anax\View;

$userHelper = new \Anax\User\UserHelper();

?>
<h5 class="user-info"><?= $userHelper->logedInAs()?> </h5>

<div class="">
    <h3>What is going on?</h3>
    <div>
        <h5> Latest Questions</h5>
        <?php foreach ($questions as $question) : ?>
            
            <a href="<?= url("question/update/{$question->id}"); ?>"><?= $question->title ?></a>
        
            Asked by: <?= $question->user_id ?>
            <?= $question->date ?>
            
            </br>
        <?php endforeach; ?>

    </div>

    <div>
        <h5> Treding tags</h5>
     
        <?php foreach ($tags as $tag) : ?>
             
             <a href="<?= url("tag/update/{$tag->id}"); ?>"><?= $tag->text ?></a>
             <?= $tag->amount ?> times.

            </br>
        <?php endforeach; ?>
    </div>

    <div>
        <h5> Most Active users</h5>
        <?php foreach ($users as $user) : ?>
            
            <a href="<?= url("user/update/{$user->id}"); ?>"><?= $user->username ?></a>
            Posts: <?= $user->amount ?>
    
            </br>
        <?php endforeach; ?>
    </div>
</div>