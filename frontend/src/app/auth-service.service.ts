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

  login(credentials: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/api/login`, credentials);
  }

  logout(): Observable<any> {
    return this.http.post(`${this.apiUrl}/api/logout`, null);
  }

  register(user: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/api/register`, user);
  }

  isAdmin(): boolean {
    const roles = JSON.parse(localStorage.getItem('roles') || '[]');
    return roles.includes('admin');
  }
}


