import { HttpClient } from '@angular/common/http';
import { Injectable, Inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Preguntas } from '../types';
import { API_URL } from '../tokens/api-url.token';
import { AbstractPreguntasService } from './abstract-preguntas.service';

@Injectable({
  providedIn: 'root'
})
export class HttpPreguntasService extends AbstractPreguntasService{

  constructor(
    private http: HttpClient,
    @Inject(API_URL) private apiUrl: string
  ) {
    super();
  }

  getPreguntas(): Observable<Preguntas[]> {
    return this.http.get<Preguntas[]>(`${this.apiUrl}/preguntas`);
  }

  getPregunta(id: string|number): Observable<Preguntas> {
    return this.http.get<Preguntas>(`${this.apiUrl}/pregunta/${id}`);
  }
}
