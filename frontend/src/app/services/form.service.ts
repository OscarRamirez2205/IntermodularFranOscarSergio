import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { FormQuestion } from '../form-component/form-component.component';

@Injectable({
  providedIn: 'root'
})
export class FormService {
  private apiUrl = 'TU_URL_API'; // Reemplaza con la URL de tu API

  constructor(private http: HttpClient) { }

  getFormQuestions(token: string | null): Observable<FormQuestion[]> {
    return this.http.get<FormQuestion[]>(`${this.apiUrl}/forms/${token}`);
  }
}