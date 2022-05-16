<?php declare(strict_types=1);
$game = $data['game'] ?? null;
if ($game) { ?>
    <header>
        <h1>Le Wordle</h1>
        <a href="/reset" class="button button-orange">Recommencer</a>
    </header>

    <span>Nombre de tentatives restantes : <?php echo $game->getAttempts(); ?>/6</span>

    <div>
        <?php foreach ($game->getProposals() as $proposal) { ?>
            <div class="proposal letters">
                <?php foreach ($proposal->getLetters() as $letter) { ?>
                    <span class="letter letter-status-<?php echo $letter->getStatus(); ?>"><?php echo $letter->getLetter(); ?></span>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <?php if ($game->getAttempts() > 0 && 1 != $game->getGameStatus()) { ?>
        <form action="/" method="post">
            <div class="inputs">
                <?php for ($i = 1; $i <= $game->word->getLength(); ++$i) { ?>
                    <div class="square input-wrapper">
                        <input id="<?php echo $i; ?>" type="text" name="wordle[]" maxlength="1"
                               required <?php echo 1 === $i ? 'autofocus' : ''; ?>>
                    </div>
                <?php } ?>
            </div>
            <input type="submit" value="Valider" class="button button-green submit-button">
        </form>
    <?php } ?>

    <?php if ($game->getLastProposal() && 1 === $game->getLastProposal()->getStatus()) { ?>
        <h2 class="game-status">Félicitation vous avez gagné en <?php echo 6 - $game->getAttempts(); ?>
            coup<?php echo $game->getAttempts() > 1 ? 's' : ''; ?> ! le mot
            était <span class="word-reveal">"<?php echo $game->word->getWord(); ?>"</span></h2>
    <?php } ?>

    <?php if ($game->getAttempts() <= 0) { ?>
        <h2 class="game-status">Mince, vous avez perdu ! le mot était
            <span class="word-reveal">"<?php echo $game->word->getWord(); ?>"</span>
        </h2>
    <?php } ?>
<?php } ?>
