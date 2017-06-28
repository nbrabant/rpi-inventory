export interface Product {
	id: number;
	categorie_id: number;
	nom: string;
	description: string;
	quantite: string;
	quantite_min: string;
	unite: string;
	// readonly category: string;
}

export declare type Products = Product[];
