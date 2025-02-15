// logout.guard.ts
import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { AuthService } from './auth-service.service';

@Injectable({
  providedIn: 'root',
})
export class LogoutGuard implements CanActivate {
  constructor(private authService: AuthService, private router: Router) {}

  canActivate(): boolean {
    this.authService.logout();
    console.log('llega 1');

    this.router.navigate(['/']);
    console.log('llega 2');

    return false;
  }
}
