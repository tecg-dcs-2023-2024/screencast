<?php
/** @var string $current_language */

?>
<form action="">
    <select name="language"
            class="p-2 rounded bg-white"
            id="lang">
        <?php
        foreach (AVAILABLE_LANGUAGES as $code => $language) : ?>
            <option class=""
                    value="<?= $code ?>"<?= $current_language === $code ? ' selected' : '' ?>><?= $language ?>
            </option>
        <?php
        endforeach;
        ?>
    </select>
    <label for="lang"
           aria-hidden="true"
           class="sr-only">Langue</label>
    <button type="submit"
            class="text-white bg-blue-600">Choisir cette langue
    </button>
</form>