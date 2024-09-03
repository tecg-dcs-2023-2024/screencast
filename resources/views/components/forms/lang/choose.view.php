<?php
/** @var string $current_language */

?>
<form action="">
    <select name="language"
            class="p-2 rounded bg-white"
            id="lang">
        <option class=""
                value="en"<?= $current_language === 'en' ? ' selected' : '' ?>>English
        </option>
        <option class=""
                value="fr"<?= $current_language === 'fr' ? ' selected' : '' ?>>Français
        </option>
    </select>
    <label for="lang"
           aria-hidden="true"
           class="sr-only">Langue</label>
    <button type="submit"
            class="text-white bg-blue-600">Choisir cette langue
    </button>
</form>