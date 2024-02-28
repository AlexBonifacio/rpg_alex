<h1> <?=$this->combat->player->name ?> vous entrez dans un combat</h1>

<p>Player : <?=$this->combat->player->name ?><br>Vie : <?=$this->combat->player->getLife(); ?></p>
<p>Enemy : <?= "L'ennemie a"//$this->combat->enemey->getEnemyType() ?><br>Vie : <?= $this->combat->enemy->getLife(); ?></p>

<form method="post">
    <input type="hidden" value="combat-action" name="form">
    <label for="action"><?=$this->combat->player->name ?> il est temps de choisir votre meilleur atout</label>
    <select name="action" id="action">
        <option value="attack">Attaquer</option>
        <option value="heal">Healer</option>
        <option value="special">Pouvoir antique</option>
    </select>
    <button type="submit" class="btn btn-primary">Lancer le tour</button>
</form>