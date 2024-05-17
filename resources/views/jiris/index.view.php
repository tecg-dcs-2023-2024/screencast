<?php
/** @var array $upcoming_jiris */

/** @var array $jiris */

/** @var array $past_jiris */
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Jiris</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <?php
    partials('common_html_start');
    ?>
    <h1 class="font-bold text-2xl">Jiris</h1>
    <?php
    component('forms.search', ['label' => 'Nom du jiri']); ?>

    <section>
        <h2 class="font-bold">Jiris à venir</h2>
        <?php
        component('jiris.list', [
            'title' => 'Jiris à venir',
            'jiris' => $upcoming_jiris,
        ]) ?>
    </section>

    <section>
        <h2 class="font-bold">Jiris passés</h2>
        <?php
        component('jiris.list', [
            'title' => 'Jiris passés',
            'jiris' => $past_jiris,
        ]) ?>
    </section>

    <div>
        <a href="/jiri/create"
           class="underline text-blue-500">Créer un nouveau jiri</a>
    </div>
    <?php
    partials('common_html_end');
    ?>
</html>