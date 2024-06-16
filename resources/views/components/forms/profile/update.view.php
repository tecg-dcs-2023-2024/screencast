<?php
/** @var stdClass $user */

?>
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
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'password',
            'label' => 'Nouveau mot de passe<small class="block font-normal">au moins 8 caractères, des lettres, des chiffres et des caractères spéciaux (+-*/%!?_)</small>',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'ch4nge_th1s',
        ]);
        ?>
    </div>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'old-password',
            'label' => 'Ancien mot de passe<small class="block font-normal">si vous voulez le changer, histoire de vérifier que c’est bien vous</small>',
            'type' => 'text',
            'value' => '',
            'placeholder' => '',
        ]);
        ?>
    </div>
    <div>
        <?php
        component('forms.controls.button', ['text' => 'Modifier mon profil']);
        ?>
    </div>
</form>