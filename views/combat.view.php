<h1>Je suis un combat</h1>

<p>Player : <?=$this->combat->player->name ?><br>Vie : <?=$this->combat->player->getLife(); ?></p>
<p>Enemy : <?= "type a définir"//$this->combat->enemey->getEnemyType() ?><br>Vie : <?= $this->combat->enemy->getLife(); ?></p>

<form method="post">
    <input type="hidden" value="combat-action" name="form">
    <label for="action">Choix de l'action</label>
    <select name="action" id="action">
        <option value="attack">Attaquer</option>
        <option value="heal">Healer</option>
        <option value="special">Pouvoir antique</option>
    </select>
    <button type="submit" class="btn btn-primary">Turn</button>
</form>