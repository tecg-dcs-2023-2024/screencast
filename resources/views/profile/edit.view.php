<?php
/** @var stdClass $user */

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Jiris - Modifier votre profil</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <?php
    partials('common_html_start');
    ?>
    <h1 class="font-bold text-2xl">Modifier votre profil</h1>
    <form action="/profile"
          method="post"
          class="flex flex-col gap-6 bg-slate-50 rounded p-4">
        <?php
        method('patch') ?>
        <?php
        csrf_token() ?>
        <div class="flex flex-col gap-2">
            <?php
            component('forms.controls.label-and-input', [
                'name' => 'name',
                'label' => 'Votre nom <span class="block font-normal">moins de 255 caract&egrave;res</span>',
                'type' => 'text',
                'value' => $user->name,
                'placeholder' => 'John Doe',
            ]);
            ?>
        </div>
        <div class="flex flex-col gap-2">
            <?php
            component('forms.controls.label-and-input', [
                'name' => 'email',
                'label' => 'Adresse email<small class="block font-normal">doit être valide et n’avoir jamais été utilisée dans notre système.</small>',
                'type' => 'email',
                'value' => $user->email,
                'placeholder' => 'jon@doe.com',
            ]);
            ?>

        </div>
        <div>
            <?php
            component('forms.controls.button', ['text' => 'Modifier mon profil']);
            ?>
        </div>
    </form>
    <?php
    partials('common_html_end');
    ?>
</html>