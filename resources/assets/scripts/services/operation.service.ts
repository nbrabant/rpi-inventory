import { Injectable }    from '@angular/core';
import { Headers, Http } from '@angular/http';

import 'rxjs/add/operator/toPromise';

import { Operation, Operations } from '../class/operation';

@Injectable()
export class OperationService {

	private apiUrl = 'api/operations';  // URL to web api

    constructor (private http: Http) {
        this.http = http;
	}

	getOperations(): Promise<any> {
		return this.http.get(this.apiUrl)
			.toPromise()
			.then(response => response.json().data as Operations)
			.catch(this.handleError);
	}

	private handleError(error: any): Promise<any> {
		// console.error('An error occurred', error); // for demo purposes only
		return Promise.reject(error.message || error);
	}
}
