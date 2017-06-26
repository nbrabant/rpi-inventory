import { Injectable }    from '@angular/core';
import { Headers, Http } from '@angular/http';

import 'rxjs/add/operator/toPromise';

import { Category, Categories } from '../class/category';

@Injectable()
export class CategoryService {

	private apiUrl = 'api/categories';  // URL to web api

    constructor (private http: Http) {
        this.http = http;
	}

	getCategories(): Promise<any> {
		return this.http.get(this.apiUrl)
			.toPromise()
			.then(response => response.json().data as Categories)
			.catch(this.handleError);
	}

	private handleError(error: any): Promise<any> {
		// console.error('An error occurred', error); // for demo purposes only
		return Promise.reject(error.message || error);
	}
}
