import { Component } from '@angular/core';
import { AuthService } from '../auth-service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  template: `
    <form (ngSubmit)="login()">
      <input type="email" name="email" [(ngModel)]="credentials.email">
      <input type="password" name="password" [(ngModel)]="credentials.password">
      <button type="submit">Iniciar sesión</button>
    </form>
  `
})
export class LoginComponent {
  credentials = { email: '', password: '' };

  constructor(private authService: AuthService, private router: Router) { }

  login() {
    this.authService.login(this.credentials).subscribe(
      response => {
        // Guardar datos del usuario y roles en el almacenamiento local
        localStorage.setItem('user', JSON.stringify(response.user));
        localStorage.setItem('roles', JSON.stringify(response.roles));

        // Redirigir según el rol
        if (this.authService.isAdmin()) {
          window.location.href = '/admin'; // Redirigir a la página de administración en Laravel
        } else {
          this.router.navigate(['/']); // Redirigir a la página principal en Angular
        }
      },
      error => {
        console.error(error);
      }
    );
  }
}
