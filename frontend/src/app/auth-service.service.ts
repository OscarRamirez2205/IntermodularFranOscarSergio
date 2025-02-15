import { Injectable, InjectionToken, Inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_URL } from './tokens/api-url.token';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient,
    @Inject(API_URL) private apiUrl: string) {

   }

   login(credentials: { email: string; password: string }): Observable<any> {
    console.log(credentials);

    return this.http.post(`${this.apiUrl}/api/login`, credentials);
  }

  logout() : void{
    // Eliminamos los items del localStorage
    localStorage.clear();
  }


  saveToken(token: string): void {
    localStorage.setItem('token', token);
  }

  register(user: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/api/register`, user);
  }

  isAdmin(): boolean {
    const roles = JSON.parse(localStorage.getItem('roles') || '[]');
    return roles.includes('Administrador');
  }
}


