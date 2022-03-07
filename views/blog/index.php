<h1>Mes derniers articles</h1>

<?php

foreach ($params['posts'] as $post) : ?>

    <div>
        <h2><?= $post->title ?></h2>
        <div>
            <?php foreach ($post->getTags() as $tag) : ?>
                <span><a href="/tags/"><?= $tag->name ?></a></span>
            <?php endforeach ?>
        </div>
        <small>Publié le <?= $post->getCreatedAt() ?></small>
        <p><?= $post->getExcerpt() ?></p>
        <?= $post->getButton() ?>
    </div>

<?php endforeach ?>