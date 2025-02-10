import { HttpClient } from '@angular/common/http';
import { Injectable, Inject } from '@angular/core';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
import { AbstractAuthService } from './abstarct-auth.service';
import { IAuth } from '../types';
import { API_URL } from '../tokens/api-url.token';

@Injectable({
  providedIn: 'root'
})
export class HttpAuthService extends AbstractAuthService {
  constructor(
    private http: HttpClient,
    @Inject(API_URL) private apiUrl: string
  ) {
    super();
  }

  login(username: string, password: string): Observable<IAuth> {
    return this.http.post<IAuth>(`${this.apiUrl}/auth/login`, { username, password })
      .pipe(
        tap(auth => {
          this.username.set(auth.username);
          this.role.set(auth.role);
          this.token.set(auth.token);
        })
      );
  }

  logout(): Observable<boolean> {
    return this.http.post<boolean>(`${this.apiUrl}/auth/logout`, {})
      .pipe(
        tap(() => {
          this.username.set(undefined);
          this.role.set(undefined);
          this.token.set(undefined);
        })
      );
  }
}