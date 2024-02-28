<p class="lead">
    C'est ici que tout commence <strong><?= $this->player->name ?></strong>, la classe <?= $this->player->getArchetype() ?> est un choix judicieux pour aller au bout de cette aventure.
</p>

<form method="post">

    <input type="hidden" value="new-combat" name="form">
    <button type="submit" class="btn btn-primary">Entrer dans un combat</button>

</form>