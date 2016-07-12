<?php

use App\Recette;
use Illuminate\Database\Seeder;

class RecetteTableSeeder extends Seeder
{

	private $_datasToSeed = [
		[
			'nom' 				=> 'Filets de poulet au maroilles',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>étape 1 :Cuire les pommes de terre dans de l&#39;eau bouillante pendant 15 minutes. étape 2 :Dans un plat à four, disposer les filets de poulet, mettre un peu d&#39;huile d&#39;olive.Disposer tout autour les pommes de terre coupées en quartiers.Mettre l&#39;oignon, les gousses d&#39;ail et le maroilles sur les pommes de terre et les filets. Ajouter les herbes de Provence. étape 3 :Enfourner à four préchauffé, à 200°C pendant 25 minutes.</p>',
			'nombre_personnes' 	=> '2 personnes',
			'temps_preparation' => 0,
			'temps_cuisson' 	=> 25,
			'complement' 		=> '2 gousses d"ail \n\n Herbes de Provence \n\n 1 oignon \n\n 50g de maroilles \n\n 4 petites pommes de terre \n\n 2 filets de poulet'
		],
		[
			'nom' 				=> 'Clafoutis aux cerises',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>étape 1 :Dans une terrine, mélangez le sucre et&nbsp;les oeufs. Ajouter la farine en mélangeant bien à la cuillère en bois ou au fouet et ajoutez l&#39;huile. étape 2 :Délayez le mélange avec&nbsp;le lait tiède.Ajouter une pincée de sel et de la cannelle en poudre. étape 3 :Dans un grand plat allant au four, copieusement beurré, disposez les cerises non dénoyautées. étape 4 :Versez doucement la préparation sur les cerises. étape 5 :Cuire au four à 180°C pendant 30 à 40 minutes.Dégustez tiède !</p>',
			'nombre_personnes' 	=> '6 personnes',
			'temps_preparation' => 0,
			'temps_cuisson' 	=> 0,
			'complement' 		=> '25 cl de lait \n\n 1/4 c à c de cannelle \n\n 1 pincée de sel \n\n Du sucre glace \n\n 30g de beurre \n\n 500g de cerises type Montmorency \n\n 1 c à c d''huile neutre \n\n 4 œufs entiers \n\n 50g de sucre en poudre \n\n 125g de farine'
		],
		[
			'nom' 				=> 'Pâte bolognaise',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Emincer l&#39;oignon.<br />\r\nLe faire suer dans l&#39;huile.<br />\r\nAjouter ensuite l&#39;ail, la viande hachée, les sauces et laisser revenir 10 min.<br />\r\nRajouter le concentré de tomate, mouiller avec un peu d&#39;eau, couvrir et laisser mijoter 1 h.<br />\r\nEnviron 20 min avant la fin de la cuisson, cuire les p&acirc;tes al dente à l&#39;eau bouillante salée.<br />\r\nLes égoutter et les mélanger à la sauce dans la casserole.<br />\r\nSaupoudrer de parmesan et servir.</p>',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 30,
			'temps_cuisson' 	=> 60,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Bananes au jambon',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Eplucher les bananes. Les entourer ensuite d&#39;une tranche de jambon [comme des <a href="http://www.marmiton.org/magazine/diaporamiam_endives_1.aspx">endives</a>). Les mettre dans un plat (avec des bords). Etaler le gruyère r&acirc;pé sur le jambon et ajouter de la crème fra&icirc;che par dessus de fa&ccedil;on à ce que les bananes ne sèchent pas trop à la cuisson.<br />\r\nMettre au four à 200°C environ 30 mn.</p>',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 20,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Riz à la béchamel et au thon',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Faire cuire le riz comme indiqué sur l&#39;emballage.<br />\r\nPendant ce temps fairechauffer la béchamel dans une casserole.<br />\r\nUne fois qu&#39;elle est arrivée à température, ajouter le thon égoutté et émietté.<br />\r\nDécouper les cornichons en petits morceaux et les ajouter (je met 3 cornichons moyens pour 1/2 litre de béchamel mais ceci est laissé à l&#39;appréciation de chacun).<br />\r\nEgoutter le riz puis mélanger la préparation &quot;béchamel-thon-cornichon&quot; au riz.<br />\r\nDéguster.</p>',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 5,
			'temps_cuisson' 	=> 10,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Chili con carne express',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Hacher oignon et ail. Faire chauffer l&#39;huile dans une cocotte, faire fondre l&#39;oignon et l&#39;ail.<br />\r\nAjouter la viande hachée, la laisser prendre couleur. Ajouter la poudre a chili (suivant les go&ucirc;ts, + ou - pimenté).<br />\r\nEgoutter les haricots, les versez dans la cocotte avec les tomates. Remuer et assaisonner. Laisser frémir 20 minutes.</p>',
			'nombre_personnes' 	=> '3',
			'temps_preparation' => 5,
			'temps_cuisson' 	=> 30,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Feuilleté au jambon',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Dérouler la p&acirc;te feuilletée dans un plat allant au four. Sur une moitié, étaler le jambon haché, puis les champignons, le <a href="http://www.marmiton.org/magazine/tout-un-fromage.aspx">fromage</a>, et enfin les oeufs.<br />\r\nReplier la deuxième moitié de p&acirc;te de fa&ccedil;on à former un gros chausson. Bien fermer les extrémités.<br />\r\nFaire cuire a four assez chaud (thermostat 7/210°C) une vingtaine de minutes.</p>',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 15,
			'temps_cuisson' 	=> 20,
			'complement' 		=> NULL
		],
		[
			'nom' 				=>  'Gnocchis sauce bacon',
			'type_recette' 		=>  'entrée',
			'instructions' 		=>  '<p>Faire bouillir de l&#39;eau dans une casserole, et y plonger les gnocchis.<br />\r\nLorsqu&#39;ils sont cuits, les égoutter avec une passoire.<br />\r\nCouper le munster en cubes, et les tranches de bacon en petits morceaux.<br />\r\nMélanger gnocchis, munster et bacon; et mettre le tout dans un plat allant au four.<br />\r\nDans un bol, mélanger la crème fra&icirc;che avec l&#39;oeuf, le poivre et le sel.<br />\r\nVerser cette sauce sur le mélange gnocchis, munster, bacon.<br />\r\nMettre au four pendant 15 min, à 180°C (th 6).</p>',
			'nombre_personnes' 	=> '4',
			'temps_preparation' =>  20,
			'temps_cuisson' 	=>  15,
			'complement' 		=>  NULL
		[
			'nom' 				=> 'Pâtes au thon',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Faire cuire les p&acirc;tes selon votre go&ucirc;t et le type de p&acirc;tes.<br />\r\nDans une casserole, faire revenir les oignons avec un peu d&#39;huile, ajouter le thon, le concentré de tomates, la crème, le sel et le poivre.<br />\r\nEgoutter les p&acirc;tes, et les mélanger avec la préparation.<br />\r\nAjouter le gruyère r&acirc;pé.</p>',
			'nombre_personnes' 	=> '2',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 10,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Poulet au curry ',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Emincer les oignons, les faire revenir dans une sauteuse avec l&#39;huile d&#39;olive.<br />\r\nUne fois les oignons colorés, faire revenir les blancs de poulet avec le curry pendant 5 minutes. Ajouter un peu d&#39;eau et laisser mijoter 20 minutes.<br />\r\nServir avec du riz blanc ou des <a href="http://www.marmiton.org/magazine/tendances-gourmandes_pommes-de-terre_1.aspx">pommes de terre</a> vapeur.<br />\r\n&nbsp;</p>',
			'nombre_personnes' 	=> '2',
			'temps_preparation' => 5,
			'temps_cuisson' 	=> 25,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Tagliatelles à la carbonara',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<p>Mettre 1,5 litre d&#39;eau salée à bouillir.<br />\r\nDans une poèle, faire chauffer les lardons et les champignons à feu vif, sans matière grasse.<br />\r\nQuand le contenu de la po&ecirc;le est doré, ajouter la crème fra&icirc;che.<br />\r\nQuand la crème fra&icirc;che est à ébullition, arr&ecirc;ter le feu et ajouter le<a href="http://www.marmiton.org/magazine/tout-un-fromage.aspx">fromage</a> r&acirc;pé; remuer.<br />\r\nFaire cuire les p&acirc;tes dans une casserole d&#39;eau bouillante salée, le temps indiqué sur le paquet.<br />\r\nEgoutter les p&acirc;tes, les disposer dans 4 assiettes, puis verser la sauce par dessus.<br />\r\nDécorer d&#39;1 jaune d&#39;oeuf par assiette, en le présentant dans une demi coquille d&#39;oeuf au centre de l&#39;assiette.<br />\r\nServir aussit&ocirc;t. Succès garanti, parole d&#39;étudiante pas riche !</p>',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 10,
			'complement' 		=> NULL
		]
	];

	// (1, 1, 15, 1, NULL),
	// (2, 1, 1, 2, NULL),
	// (4, 1, 72, 50, 'grammes'),
	// (28, 2, 17, 200, 'grammes'),
	// (29, 2, 8, 100, 'grammes'),
	// (30, 2, 21, 1, 'litre'),
	// (31, 3, 21, 25, 'centilitre'),
	// (32, 3, 23, 30, 'grammes'),
	// (33, 3, 22, 4, NULL),
	// (34, 3, 48, 50, 'grammes'),
	// (35, 3, 47, 125, 'grammes'),
	// (37, 4, 31, 300, 'grammes'),
	// (38, 4, 3, 450, 'grammes'),
	// (39, 4, 15, 1, NULL),
	// (40, 5, 9, 4, NULL),
	// (41, 5, 75, 4, NULL),
	// (42, 6, 32, 1, 'grand_verre'),
	// (43, 6, 77, 50, 'centilitre'),
	// (44, 6, 78, 1, NULL),
	// (45, 7, 15, 1, NULL),
	// (46, 7, 82, 1, NULL),
	// (47, 7, 3, 400, 'grammes'),
	// (48, 7, 80, 400, 'grammes'),
	// (49, 7, 34, 1, NULL),
	// (50, 7, 81, 2, 'cuillere_cafe'),
	// (51, 8, 86, 1, NULL),
	// (52, 8, 75, 3, NULL),
	// (53, 8, 35, 1, NULL),
	// (54, 8, 87, 1, NULL),
	// (55, 8, 22, 2, NULL),
	// (56, 9, 88, 600, 'grammes'),
	// (57, 9, 89, 200, 'grammes'),
	// (58, 9, 90, 150, 'grammes'),
	// (59, 9, 22, 1, NULL),
	// (60, 9, 73, 3, 'cuillere_soupe'),
	// (61, 10, 31, 400, 'grammes'),
	// (62, 10, 78, 1, 'grammes'),
	// (63, 10, 15, 1, NULL),
	// (64, 10, 91, 1, NULL),
	// (65, 10, 73, 1, 'verre_moutarde'),
	// (66, 10, 76, 1, NULL),
	// (67, 11, 1, 300, 'grammes'),
	// (68, 11, 15, 2, NULL),
	// (69, 11, 92, 2, 'cuillere_cafe'),
	// (70, 11, 85, 1, 'cuillere_soupe'),
	// (71, 12, 93, 200, 'grammes'),
	// (72, 12, 73, 2, 'cuillere_soupe'),
	// (73, 12, 35, 1, NULL),
	// (74, 12, 22, 4, NULL);

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach ($this->_datasToSeed as $datas) {
			Recette::create($datas);
		}
    }
}
