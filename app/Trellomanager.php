<?php

namespace App;

use Gregoriohc\LaravelTrello\Facades\Wrapper as Trello;

class Trellomanager
{
    private $trelloUsers = [
        '5475d84e12b4e8e6664d2ef1',
        '55da1690984b5375687860ce'
    ];

    public static function exportToTrello($listeCourse = null) {
        if(is_null($listeCourse) || !($listeCourse instanceof Liste)) {
            $listeCourse = Liste::firstOrCreate(['termine' => 0]);
        }

        if(is_null($listeCourse) || !($listeCourse instanceof Liste)) {
            return array('status' => false, 'message' => 'Aucune liste créée actuellement.');
        }

		$card = self::getTrelloCard($listeCourse->trello_card_id);
		// Enregistrement de l'id de la card Trello juste après sa création
        if (is_null($listeCourse->trello_card_id)) {
			$listeCourse->trello_card_id = $card->getId();
        	$listeCourse->save();
		}

        // si une checklist a déjà été créée auparavant,
        // on la supprime afin de pouvoir entrer les nouvelles données
        $checklists = $card->getChecklists();
        if(is_array($checklists) && !empty($checklists))  {
            $checklist = reset($checklists)->remove();
        }

        $checklist = Trello::manager()->getChecklist();
        $checklist
            ->setCard($card)
            ->setName('Liste de courses')
            ->save();

        // Add checlist items
        foreach ($listeCourse->lignesproduits as $ligneProduit) {
            Trello::checklist()->items()->create($checklist->getId(), $ligneProduit->quantite.' '.$ligneProduit->produit->nom);
        }
        return array('status' => true, 'message' => 'Liste exportée sur Trello avec succès.');
    }

	protected static function getTrelloCard($trelloCardId) {
		try {
            return Trello::manager()->getCard($trelloCardId);
        } catch (Exception $e) {
			return self::createTrelloCard();
        }
	}

	protected static function createTrelloCard() {
		$card = Trello::manager()->getCard();
		$card
		   ->setBoardId(Trello::getDefaultBoardId())
		   ->setListId(Trello::getDefaultListId())
		   ->setName('Liste de courses')
		   ->setDescription('Liste de courses créées le '.date('d/m/Y à H:i:s'))
		   ->setPosition('top')
		   // ->addMember(Trello::manager()->getMember('5475d84e12b4e8e6664d2ef1'))
		   // ->addMember(Trello::manager()->getMember('55da1690984b5375687860ce'))
		   ->save();
		return $card;
	}

}
