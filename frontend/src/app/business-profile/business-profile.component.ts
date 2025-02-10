import { Component } from '@angular/core';
import { AbstractAuthService } from '../services/abstarct-auth.service';

@Component({
  selector: 'app-business-profile',
  standalone: true,
  template: `
    <div class="container mt-4">
      <h2>Perfil de empresa</h2>
      <p>Usuario: {{authService.username()}}</p>
    </div>
  `
})
export class BusinessProfileComponent {
  constructor(public authService: AbstractAuthService) {}
}