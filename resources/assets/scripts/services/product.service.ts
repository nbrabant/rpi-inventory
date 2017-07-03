import { Injectable }    from '@angular/core';
import { Headers, Http } from '@angular/http';

import 'rxjs/add/operator/toPromise';

import { Product, Products } from '../class/product';

@Injectable()
export class ProductService {

	private apiUrl = 'api/products';  // URL to web api

    constructor (private http: Http) {
        this.http = http;
	}

	getProducts(): Promise<any> {
		return this.http.get(this.apiUrl)
			.toPromise()
			.then(response => response.json().data as Products)
			.catch(this.handleError);
	}

	private handleError(error: any): Promise<any> {
		// console.error('An error occurred', error); // for demo purposes only
		return Promise.reject(error.message || error);
	}
}