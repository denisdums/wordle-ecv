<?php
$game = $data['game'] ?? null;
if ($game):?>
    <header>
        <h1>Le Wordle</h1>
        <a href="/reset" class="button button-orange">Recommencer</a>
    </header>

    <span>Nombre de tentatives restantes : <?= $game->getAttempts() ?>/6</span>

    <div>
        <?php foreach ($game->getProposals() as $proposal): ?>
            <div class="proposal letters">
                <?php foreach ($proposal->getLetters() as $letter): ?>
                    <span class="letter letter-status-<?= $letter->getStatus() ?>"><?= $letter->getLetter() ?></span>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($game->getAttempts() > 0 && $game->getGameStatus() != 1): ?>
        <form action="/" method="post">
            <div class="inputs">
                <?php for ($i = 1; $i <= $game->word->getLength(); $i++): ?>
                    <div class="square input-wrapper">
                        <input id="<?= $i ?>" type="text" name="wordle[]" maxlength="1"
                               required <?= $i === 1 ? 'autofocus' : '' ?>>
                    </div>
                <?php endfor; ?>
            </div>
            <input type="submit" value="Valider" class="button button-green submit-button">
        </form>
    <?php endif; ?>

    <?php if ($game->getLastProposal() && $game->getLastProposal()->getStatus() === 1): ?>
        <h2 class="game-status">Félicitation vous avez gagné en <?= 6 - $game->getAttempts() ?>
            coup<?= $game->getAttempts() > 1 ? 's' : '' ?> ! le mot
            était <span class="word-reveal">"<?= $game->word->getWord() ?>"</span></h2>
    <?php endif; ?>

    <?php if ($game->getAttempts() <= 0): ?>
        <h2 class="game-status">Mince, vous avez perdu ! le mot était
            <span class="word-reveal">"<?= $game->word->getWord() ?>"</span>
        </h2>
    <?php endif; ?>
<?php endif; ?>
