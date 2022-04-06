<?php
$game = $data['game'] ?? null;
if ($game):?>
    <h1>Le Wordle : <?= $game->word->word ?></h1>
    <span>Nombre de tentatives restantes : <?= $game->attempts ?>/6</span>

    <div>
        <?php foreach ($game->proposals as $proposal): ?>
            <div class="proposal letters">
                <?php foreach ($proposal->letters as $letter): ?>
                    <span class="letter letter-status-<?= $letter->getStatus() ?>"><?= $letter->letter ?></span>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($game->attempts > 0 && !$game->getLastProposal() || ($game->getLastProposal() && $game->getLastProposal()->getStatus() != 1)): ?>
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

    <?php if ($game->getLastProposal() && $game->getLastProposal()->getStatus() === 1): ?>
        <h2>Félicitation vous avez gagné en <?= $game->attempts ?> coup<?= $game->attempts > 1 ? 's' : '' ?> ! le mot
            était <?= $game->word->word ?></h2>
    <?php endif; ?>

    <?php if ($game->attempts === 0): ?>
        <h2>Mince, vous avez perdu ! le mot était "<?= $game->word->word ?>"</h2>
    <?php endif; ?>

    <a href="/reset">Recommencer une nouvelle partie</a>
<?php endif; ?>
