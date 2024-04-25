import { Injectable } from '@angular/core';

import { HttpClient, HttpHeaders }    from '@angular/common/http';

@Injectable()
export class APIServiceService {

  constructor(private http: HttpClient) { }

  getData() : Promise<any>{
    return this.http.get('https://jsonplaceholder.typicode.com/todos').
    toPromise();
    //https://jsonplaceholder.typicode.com/todos
  }

}