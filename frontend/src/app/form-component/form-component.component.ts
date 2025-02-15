import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'app-form-component',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './form-component.component.html',
  styleUrl: './form-component.component.scss',
})
export class FormComponentComponent implements OnInit {

  //Insertar token a input
  form: FormGroup;
  token: string | null = '';

  constructor(private route: ActivatedRoute, private fb: FormBuilder) {
    
    this.form = this.fb.group({
      token: [''], 
    });
  }

  ngOnInit(): void {
    
    this.route.queryParams.subscribe(params => {
      this.token = params['token'] || ''; 
      this.form.patchValue({ token: this.token }); 
    });
  }

  onSubmit(event: Event): void {
    event?.preventDefault();
    console.log('Formulario enviado:', this.form.value);
  }
}
