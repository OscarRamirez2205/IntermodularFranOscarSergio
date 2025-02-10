import { Component } from '@angular/core';
import { AbstractAuthService } from '../services/abstarct-auth.service';

@Component({
  selector: 'app-admin-profile',
  standalone: true,
  template: `
    <div class="container mt-4">
      <h2>Perfil de administrador</h2>
      <p>Usuario: {{authService.username()}}</p>
    </div>
  `
})
export class AdminProfileComponent {
  constructor(public authService: AbstractAuthService) {}
}