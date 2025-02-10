import { Injectable, signal } from '@angular/core';
import { Observable } from 'rxjs';
import { IAuth } from '../types';

@Injectable()
export abstract class AbstractAuthService {
  // Señales para el estado de autenticación
  readonly username = signal<string|undefined>(undefined);
  readonly role = signal<'student'|'teacher'|'business'|'admin'|undefined>(undefined);
  readonly token = signal<string|undefined>(undefined);

  abstract login(username: string, password: string): Observable<IAuth>;
  abstract logout(): Observable<boolean>;
}