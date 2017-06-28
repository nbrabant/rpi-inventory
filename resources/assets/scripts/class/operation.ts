export interface Operation {
	id: number;
	produit_id: number;
	nom: string;
	description: string;
	created_at: Date;
}

export declare type Operations = Operation[];
