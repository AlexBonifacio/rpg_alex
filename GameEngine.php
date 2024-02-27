<?php

namespace Rpg;

// Appel de la class Warrior
use Rpg\Models\Archetypes\Warrior;
use Rpg\Models\Combat;
use Rpg\Models\Enemy;
use Rpg\Models\Player;

class GameEngine {
    private SessionStorage $storage;
    public ?Player $player;
    public array $logs;
    public int $gameLevel;
    public bool $is_in_combat = false;
    private ?Combat $combat;

    public function __construct(){
        $this->storage = new SessionStorage();
        $this->gameLevel = 1;
    }

    // Accède à l'objet storage afin d'alimenter les attributs dans notre moteur
    private function retrieveDataFromSession() : void {
        $this->logs = $this->storage->get('logs') ?: [];
        $this->player = $this->storage->get('player');
        $this->combat = $this->storage->get("combat") ?: null;
        $this->is_in_combat = $this->storage->get("is_in_combat") ?: false;
    }

    // Ajoute un message à la boîte de log en bas à droite
    private function logAction(string $action) : void {
        $message = date("H:i:s") . " : " . $action;
        $this->logs[] = $message;
        $this->storage->save('logs', $this->logs);
    }

    // Réinitialise le storage, associé au bouton en bas à droite
    private function resetStorage() : void {
        $this->storage->reset();
    }

    // Utilisation du formulaire de choix de nom
    private function createPlayer(array $formData) : void {
        if($formData["archetype"] == "warrior"){
            $this->player = new Warrior($formData["player-name"]);
        }
        // add other archetypes
        $this->storage->save('player', $this->player);
        $this->logAction("Personnage créé : " . $this->player->name);
    }

    private function handleNewCombat() : void {
        // Créer un nouveau combat et met a jours le combat dans le game engine
        $this->combat = new Combat($this->player, $this->gameLevel);
        // Met le jeu en mode combat
        $this->is_in_combat = true;
        // Stocke le combat
        $this->storage->save('combat', $this->combat);
        $this->storage->save('is_in_combat', $this->is_in_combat);
        $this->logAction("Vous êtes en combat");
    }

    private function handleCombatTurn(array $formData): void{
        $this->combat->turn($formData["action"]);
        if($this->combat->is_win){
            $this->is_in_combat = false;
            $this->player->levelUp();
        }
        $this->storage->save('combat', $this->combat);
    }

    // Méthode appelée lorsqu'on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    // Une fois la requête traitée, on redirige sur la page par défaut
    private function handleForm(array $formData) : void {
        // Chaque case est une action en front
        switch($formData['form']){
            case 'reset-storage':
                $this->resetStorage();
                break;
            case 'create-player':
                $this->createPlayer($formData);
                break;
            case 'new-combat':
                $this->handleNewCombat();
                break;
            case 'combat-action':
                $this->handleCombatTurn($formData);
                break;
            default:
                $this->logAction("No form handler");
                break;
        }

        // Redirection sur la page par défaut
        header('Location: /');
        exit;
    }

    public function run() : void {
        // Récupération des données
        $this->retrieveDataFromSession();

        // Traitement des formulaires
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->handleForm($_POST);
        } else {
            $this->logAction(serialize($this->is_in_combat));
            // Choix du template d'affichage selon l'état du jeu
            if($this->is_in_combat){
                require 'views/combat.view.php';
            } else if($this->player){
                require 'views/example.view.php';
            }
            else {
                require 'views/player-creation.view.php';
            }
        }
    }
}