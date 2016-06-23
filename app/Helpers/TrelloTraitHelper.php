<?php

namespace App\Helpers;

use Gregoriohc\LaravelTrello\Facades\Wrapper as Trello;

trait TrelloTraitHelper
{

	private $trelloUsers = [
        '5475d84e12b4e8e6664d2ef1',
        '55da1690984b5375687860ce'
    ];

    public function exportToTrello()
	{
        $card = $this->getTrelloCard($this->trello_card_id);
		// Enregistrement de l'id de la card Trello juste après sa création
        if (is_null($this->trello_card_id)) {
			$this->trello_card_id = $card->getId();
        	$this->save();
		}

		// Nettoyage des checklists existantes
        $this->clearChecklists($card);

		$categorie = $checklist = null;
		$this->listecourante->each( function($ligneListeCourante) use ($card, &$checklist, &$categorie) {
			if(is_null($categorie) || $categorie != $ligneListeCourante->categorie) {
				$checklist = $this->createChecklist($card, $ligneListeCourante->categorie);
				$categorie = $ligneListeCourante->categorie;
			}
			Trello::checklist()->items()->create($checklist->getId(), $ligneListeCourante->quantite.' '.$ligneListeCourante->unite.' '.$ligneListeCourante->produit);
		});
        return array('status' => true, 'message' => 'Liste exportée sur Trello avec succès.');
    }

	protected function getTrelloCard($trelloCardId)
	{
		try
		{
			if(is_null($trelloCardId)) {
				return $this->createTrelloCard();
			}
            return Trello::manager()->getCard($trelloCardId);
        }
		catch (\Exception $e)
		{
			return $this->createTrelloCard();
        }
	}

	protected static function createTrelloCard()
	{
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

	public function createChecklist($card, $categoryName)
	{
		$checklist = Trello::manager()->getChecklist();
        $checklist
            ->setCard($card)
            ->setName($categoryName)
            ->save();
		return $checklist;
	}

	public function clearChecklists($card)
	{
		try {
			// si une checklist a déjà été créée auparavant,
	        // on la supprime afin de pouvoir entrer les nouvelles données
	        $checklists = $card->getChecklists();
	        if(is_array($checklists) && !empty($checklists))
			{
				foreach ($checklists as $checklist)
				{
					$checklist->remove();
				}
	        }
		} catch (\Exception $e) {
			return true;
		}
	}
}
