import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormQuestion } from '../interfaces/form-question.interface';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class FormService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {
    console.log('API URL:', this.apiUrl); // Debug
  }

  getFormQuestions(token: string | null) {
    if (!token) {
      console.error('Token no proporcionado');
      return;
    }
    
    const url = `${this.apiUrl}/form/preguntas/${token}`;
    console.log('Realizando petición a:', url); // Debug
    
    return this.http.get<FormQuestion[]>(url);
  }
}