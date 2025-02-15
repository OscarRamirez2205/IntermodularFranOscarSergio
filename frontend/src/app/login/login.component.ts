import { Component } from '@angular/core';
import { AuthService } from '../auth-service.service';
import { Router } from '@angular/router';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-login',
  imports: [ FormsModule, CommonModule,],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {
  credentials = { email: '', password: '' };

  constructor(public authService: AuthService, private router: Router) { }

  selectedRole: string = '';
  selecRol() {
    if (this.selectedRole) {
      localStorage.setItem('roles', JSON.stringify([this.selectedRole]));
      console.log("Selected Role:", this.selectedRole);
      this.router.navigate(['/dashboard']);
    } else {
      alert("No hay rol seleccionado.");
    }
  }

  login() {
    console.log(this.credentials);

    this.authService.login(this.credentials).subscribe({
      next: (response) => {
        console.log(response);

        localStorage.setItem('user', JSON.stringify(response.user));
        localStorage.setItem('roles', JSON.stringify(response.roles));
        this.authService.saveToken(response.access_token);


        if (this.authService.isAdmin()) {
          const email = encodeURIComponent(this.credentials.email);
          const password = encodeURIComponent(this.credentials.password);
          console.log(email, password);

          window.location.href = `http://localhost:8000/loginAdmin/?email=${email}&password=${password}`;
        } else {
          this.router.navigate(['/']);
        }
      },
      error: (error) => {
        console.error(error);
      }
    });

  }
}
