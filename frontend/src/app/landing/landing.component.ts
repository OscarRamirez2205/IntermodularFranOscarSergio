import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { AbstractAuthService } from '../services/abstarct-auth.service';

@Component({
  selector: 'app-landing',
  standalone: true,
  imports: [CommonModule],
  template: ``,
  styles: [``]
})
export class LandingComponent {
  constructor(
    private authService: AbstractAuthService,
    private router: Router
  ) {
    // Si el usuario está autenticado, redirigir a /profile
    if (this.authService.username()) {
      this.router.navigate(['/profile']);
    }
  }
}