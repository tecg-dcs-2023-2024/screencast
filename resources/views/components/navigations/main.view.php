<nav id="main-menu"
     class="font-bold">
    <h2 class="sr-only">Menu principal</h2>
    <ul class="flex flex-col sm:flex-row gap-4 sm:gap-8 sm:items-center">
        <?php

        use Core\Auth;

        if (Auth::check()) : ?>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/jiris">Jiris</a></li>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/contacts">Contacts</a></li>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/projects">Projets</a></li>
            <li>
                <?php
                $current_language = CURRENT_LANGUAGE;
                component('forms.lang.choose', compact('current_language')) ?>
            </li>
            <li class="flex-grow text-right"><a class="underline text-white uppercase tracking-wider"
                                                href="/profile/edit">Profil</a></li>
            <li class="mt-4 sm:mt-auto sm:ml-auto">
                <?php
                component('forms.logout.delete') ?>
            </li>
        <?php
        else : ?>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/register">S&rsquo;enregister</a></li>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/login">S&rsquo;identifier</a></li>
        <?php
        endif ?>
    </ul>
</nav>