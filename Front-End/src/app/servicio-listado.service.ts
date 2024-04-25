import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class ServicioListadoService {
  url:string = `http://localhost:8000/api/posiciones/listado`;
  constructor(private http: HttpClient) { }

  obtenerDatos(): Observable<any> {
    
    return this.http.get<any>(this.url);
  }
}
