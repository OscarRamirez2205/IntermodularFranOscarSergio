import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Preguntas } from '../types';

@Injectable()
export abstract class AbstractPreguntasService {
  abstract getPreguntas(): Observable<Preguntas[]>;
  abstract getPregunta(id: string): Observable<Preguntas>;
}