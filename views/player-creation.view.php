<p class="lead">
    Soyez la bienvenue sur Gab Quest, entrez le nom de votre personnage pour commencer l'aventure.
</p>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nom du personnage</label>
        <input type="text" name="player-name" class="form-control" />
    </div>

    <div class="mb-3">
        <label for="archertype">Archetype du joueur</label>
        <select name="archetype" id="archetype">
            <option value="warrior">Guerrier</option>
            <!-- Add other  -->
        </select>
    </div>

    <input type="hidden" name="form" value="create-player"/>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
