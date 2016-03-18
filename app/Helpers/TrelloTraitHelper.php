<?php

namespace App\Helpers;

use Gregoriohc\LaravelTrello\Facades\Wrapper as Trello;

trait TrelloTraitHelper
{

	private $trelloUsers = [
        '5475d84e12b4e8e6664d2ef1',
        '55da1690984b5375687860ce'
    ];

    public function exportToTrello() {
        $card = $this->getTrelloCard($this->trello_card_id);
		// Enregistrement de l'id de la card Trello juste après sa création
        if (is_null($this->trello_card_id)) {
			$this->trello_card_id = $card->getId();
        	$this->save();
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
        foreach ($this->lignesproduits as $ligneProduit) {
            Trello::checklist()->items()->create($checklist->getId(), $ligneProduit->quantite.' '.$ligneProduit->produit->nom);
        }
        return array('status' => true, 'message' => 'Liste exportée sur Trello avec succès.');
    }

	protected function getTrelloCard($trelloCardId) {
		try {
            return Trello::manager()->getCard($trelloCardId);
        } catch (Exception $e) {
			return $this->createTrelloCard();
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
