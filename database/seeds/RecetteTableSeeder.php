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
			'complement' 		=> '25 cl de lait \n\n 1/4 c à c de cannelle \n\n 1 pincée de sel \n\n Du sucre glace \n\n 30g de beurre \n\n 500g de cerises type Montmorency \n\n 1 c à c d\'huile neutre \n\n 4 œufs entiers \n\n 50g de sucre en poudre \n\n 125g de farine'
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
		],
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
			'nom' 				=> 'Poulet au curry',
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
		],
		[
			'nom' 				=> 'Quiche au saumon',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Faites cuire le pav&eacute; de saumon au four eh 6 (180&deg;) pendant 10 minutes.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-quiche-au-saumon#xG45LJEDgHAjjLBR.99</li>\r\n	<li>Etalez la p&acirc;te bris&eacute;e dans un moule &agrave; tarte recouvert de papier cuisson. Piquez la p&acirc;te avec une fourchette et faites la cuire &agrave; blanc 10 minutes.</li>\r\n	<li>Emiettez grossi&egrave;rement le saumon sur le fond de tarte.</li>\r\n	<li>Dans un bol, m&eacute;langez les oeufs avec la cr&egrave;me fra&icirc;che et la ciboulette cisel&eacute;e. Poivrez. Versez sur le saumon.</li>\r\n	<li>Enfournez 30 minutes th 6/7 (200&deg;). Servez cette quiche avec une salade.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 20,
			'temps_cuisson' 	=> 50,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Courgettes geainées',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Lavez et coupez les courgettes dans le sens de la longueur. Retirez la chair des courgettes &agrave; l&#39;aide d&#39;une cuill&egrave;re.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-courgettes-gratinees#clBeboUG8hEh6M5d.99</li>\r\n	<li>Faites revenir la chair des courgettes dans une casserole avec un filet d&#39;huile d&#39;olive. Ajoutez la cr&egrave;me et l&#39;oeuf battu. Salez, poivrez et m&eacute;langez.</li>\r\n	<li>Garnissez les courgettes de cette farce et recouvrez de gruy&egrave;re r&acirc;p&eacute;. Enfournez th 7 (210&deg;) 20 minutes.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 20,
			'temps_cuisson' 	=> 35,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Escalope de poulet à la moutarde',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Faites cuire &agrave; feu moyen les escalopes de poulet dans une po&ecirc;le avec une noisette de beurre.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-escalope-de-poulet-a-la-moutarde#4jHvv2jw2AuaAh8e.99</li>\r\n	<li>Dans un bol, m&eacute;langez la cr&egrave;me fra&icirc;che, la moutarde et le poivre.</li>\r\n	<li>Dans une petite casserole, faites chauffer quelques instants la sauce &agrave; feu doux.</li>\r\n	<li>Nappez les escalopes de poulet de sauce.</li>\r\n	<li>Servez les escalopes chaudes avec des p&acirc;tes, des pommes noisette ou du riz.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 15,
			'temps_cuisson' 	=> 15,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Pâtes au saumon fumé',
			'type_recette' 		=>  'entrée',
			'instructions' 		=>  '<ul>\r\n	<li>Faites cuire les p&acirc;tes dans une casserole d&#39;eau bouillante avec un filet d&#39;huile d&#39;olive une dizaine de minutes.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-pates-au-saumon-fume#b7OzR2YXslq2CwD5.99</li>\r\n	<li>Pendant ce temps, coupez le saumon fum&eacute; en morceaux.</li>\r\n	<li>Egouttez les p&acirc;tes. Reversez-les dans la casserole puis ajoutez sur feu doux la cr&egrave;me fra&icirc;che et le saumon fum&eacute;.</li>\r\n	<li>M&eacute;langez le tout et poivrer. Parsemez d&#39;un peu d&#39;aneth puis servez bien chaud.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=>  '2',
			'temps_preparation' =>  10,
			'temps_cuisson' 	=>  12,
			'complement' 		=>  NULL
		],
		[
			'nom' 				=> 'Quiche lorraine',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Pr&eacute;chauffez votre four &agrave; 200&deg;C, th 6/7.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-quiche-lorraine#qaehioFSi9qS5lR7.99</li>\r\n	<li>Placez la p&acirc;te bris&eacute;e dans un plat &agrave; tarte pr&eacute;alablement beurr&eacute; et piquez le fond avec une fourchette.</li>\r\n	<li>Dans une po&ecirc;le, faites dorer les lardons.</li>\r\n	<li>Pendant ce temps, m&eacute;langer les oeufs entiers (jaunes et blancs) avec la cr&egrave;me fra&icirc;che et le gruy&egrave;re rap&eacute;.</li>\r\n	<li>Ajoutez les lardons &agrave; la pr&eacute;paration, poivrez et ajoutez une pinc&eacute;e de noix de muscade r&acirc;p&eacute;e.</li>\r\n	<li>Versez le tout dans le plat &agrave; tarte, sur la p&acirc;te, puis enfournez 30 minutes.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 30,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Salade de riz',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Faites cuire le riz dans une casserole d&#39;eau bouillante le temps indiqu&eacute; sur l&#39;emballage, &eacute;gouttez le et passez-le sous l&#39;eau froide.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-salade-de-riz#g8u2oxegFfjfW87O.99</li>\r\n	<li>Egouttez le mais et le thon et ajoutez-les dans un saladier avec le riz.</li>\r\n	<li>Faites cuire les oeufs dans une casserole d&#39;eau 13 minutes puis passez les sous l&#39;eau froide, &eacute;caillez-les, coupez-les en morceaux et ajoutez les &agrave; la salade.</li>\r\n	<li>Lavez, &eacute;p&eacute;pinez et coupez les tomates en d&eacute;s puis ajoutez-les au saladier.</li>\r\n	<li>Dans un bol, m&eacute;langez l&#39;huile et le vinaigre puis m&eacute;langez la vinaigrette avec la salade de riz.</li>\r\n	<li>Salez, poivrez puis r&eacute;server au r&eacute;frig&eacute;rateur au moins 1 heure avant de servir.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 10,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Tomates farcies',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Pr&eacute;chauffez votre four th 6 (180&deg;C). Hachez l&#39;oignon, l&#39;&eacute;chalote ainsi que l&#39;ail et faites-les revenir dans l&#39;huile d&#39;olive, dans une po&ecirc;le.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-tomates-farcies#67MY4yjEgxJMu9T2.99</li>\r\n	<li>Sortez les condiments de la po&ecirc;le et ajoutez la viande hach&eacute;e et la chapelure. Salez et poivrez.</li>\r\n	<li>Lavez les tomates et d&eacute;capitez les (gnark!!!) sur 1 cm de hauteur. Enlevez la chair et les p&eacute;pins pour les vider puis remplissez les de farce.</li>\r\n	<li>Enfournez environ 45 minutes sans le haut de la tomate.</li>\r\n	<li>5 minutes avant la fin de cuisson, ajoutez le couvercle sur les tomates.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '2',
			'temps_preparation' => 15,
			'temps_cuisson' 	=> 45,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Riz au curry et crevettes',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Faite cuire le riz dans une casserole d&#39;eau bouillante sal&eacute;e.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-riz-au-curry-et-crevettes#XS5gSR7IoHVVJZAC.99</li>\r\n	<li>Pendant ce temps, lavez, &eacute;p&eacute;pinez et coupez les morceaux de poivrons en d&eacute;s.</li>\r\n	<li>Faites les revenir dans une casserole avec un filet d&#39;huile d&#39;olive pendant une dizaine de minutes.</li>\r\n	<li>Ajoutez les crevettes d&eacute;cortiqu&eacute;es et poursuivez la cuisson 2 minutes.</li>\r\n	<li>Egouttez le riz, reversez-le dans la casserole et ajoutez-y les l&eacute;gumes.</li>\r\n	<li>Saupoudrez de curry et versez un filet d&#39;huile d&#39;olive. Salez, poivrez et servez chaud.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '2',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 20,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Pommes de terre sautées',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>&Eacute;pluchez les pommes de terre, coupez-les en gros morceaux puis faites les cuire dans une casserole d&#39;eau pendant 15 minutes.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-pommes-de-terre-sautees#IfyH3FXLg3ZVgBDg.99</li>\r\n	<li>Pendant ce temps, &eacute;pluchez les gousses d&#39;ail et hachez-les. Faites revenir l&#39;ail &agrave; la po&ecirc;le dans 15 g de beurre et un filet d&#39;huile d&#39;olive.</li>\r\n	<li>Egouttez les pommes de terre et ajoutez les dans la po&ecirc;le pour les faire rissoler 10 minutes, en les retournant fr&eacute;quemment.</li>\r\n	<li>Salez, poivrez et saupoudrez de thym.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 30,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Soufflé au fromage',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Dans un bol, d&eacute;layez la Ma&iuml;zena dans 2 cuill&egrave;res &agrave; soupe de lait.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-souffle-au-fromage#b8lDq40U7MmJekHo.99</li>\r\n	<li>Dans une casserole, versez le reste du lait, salez, poivrez, saupoudrez de muscade et portez &agrave; &eacute;bullition. Incorporez la Ma&iuml;zena et remuer sur feu doux pour que la pr&eacute;paration &eacute;paississe.</li>\r\n	<li>S&eacute;parez les blancs et les jaunes d&#39;oeufs. Retirez la casserole du feu et ajoutez les jaunes d&#39;oeufs et le fromage r&acirc;p&eacute;. M&eacute;langez.</li>\r\n	<li>Montez les blancs d&#39;oeufs en neige avec une pinc&eacute;e de sel et incorporez-les &agrave; la pr&eacute;paration.</li>\r\n	<li>Versez le tout dans un moule &agrave; souffl&eacute; et enfournez 30 minutes th 6 (180&deg;).</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 10,
			'temps_cuisson' 	=> 30,
			'complement' 		=> NULL
		],
		[
			'nom' 				=> 'Quiche aux épinards',
			'type_recette' 		=> 'entrée',
			'instructions' 		=> '<ul>\r\n	<li>Lavez les feuilles d&#39;&eacute;pinards. Epluchez et &eacute;mincez l&#39;oignon.</li>\r\n	<br />\r\n	<li>En savoir plus sur http://www.unjourunerecette.fr/recette-quiche-epinards#REUm3i8uI82H1W4z.99</li>\r\n	<li>Faites fondre une noisette de beurre dans une casserole et faites-y revenir l&#39;oignon &eacute;minc&eacute; pendant 5 minutes. Ajoutez les feuilles d&#39;&eacute;pinards et poursuivez la cuisson 3 minutes.</li>\r\n	<li>Dans un bol, m&eacute;langez les oeufs battus avec la cr&egrave;me fra&icirc;che et le parmesan. Salez et poivrez.</li>\r\n	<li>Etalez la p&acirc;te feuillet&eacute;e dans un moule &agrave; quiche et faites-la cuire &agrave; blanc 10 minutes au four th 5/6 (160&deg;).</li>\r\n	<li>Recouvrez le fond de tarte d&#39;&eacute;pinards et d&#39;oignons. Versez la pr&eacute;paration &agrave; la cr&egrave;me fra&icirc;che dessus et enfournez th 6 (180&deg;) pendant 25 minutes.</li>\r\n</ul>\r\n',
			'nombre_personnes' 	=> '4',
			'temps_preparation' => 15,
			'temps_cuisson' 	=> 40,
			'complement' 		=> NULL
		],
	];

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
