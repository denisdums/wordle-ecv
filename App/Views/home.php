<?php
$game = $data['game'] ?? null;

if ($game):?>
    <h1>Le Wordle : <?= $game->word->word ?></h1>
    <form action="/" method="post">
        <div class="inputs">
            <?php for ($i = 1; $i <= $game->word->length; $i++): ?>
                <div class="square input">
                    <input type="text" name="wordle[]" maxlength="1">
                </div>
            <?php endfor; ?>
        </div>
        <input type="submit" value="Valider">
    </form>
<?php endif; ?>
