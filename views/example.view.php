<p class="lead">
    <?= $this->player->name ?>, c'est ici que tout commence...
    La classe de mon joueur est : <?= $this->player->getArchetype() ?>
</p>

<form method="post">

    <input type="hidden" value="new-combat" name="form">
    <button type="submit" class="btn btn-primary">Entrer dans un combat</button>

</form>