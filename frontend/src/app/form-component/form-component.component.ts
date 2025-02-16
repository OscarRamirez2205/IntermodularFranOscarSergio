import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormService } from '../services/form.service';
import { FormQuestion } from '../interfaces/form-question.interface';

@Component({
  selector: 'app-form-component',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './form-component.component.html',
  styleUrl: './form-component.component.scss'
})
export class FormComponentComponent implements OnInit {
  form!: FormGroup;
  questions: FormQuestion[] = [];
  isLoading = true;
  token: string | null = null;

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private formService: FormService
  ) {}

  ngOnInit() {
    // Obtener el token de la URL
    this.route.queryParams.subscribe(params => {
      this.token = params['token'];
      console.log('Token obtenido de URL:', this.token); // Debug
      
      if (this.token) {
        this.loadFormQuestions();
      } else {
        console.error('No se encontró token en la URL');
      }
    });
  }

  private loadFormQuestions(): void {
    if (!this.token) {
      console.error('Token no disponible');
      return;
    }

    this.formService.getFormQuestions(this.token!).subscribe({
      next: (questions: FormQuestion[]) => {
        console.log('Preguntas recibidas:', questions);
        this.questions = questions;
        this.buildForm();
        this.isLoading = false;
      },
      error: (error) => {
        console.error('Error al cargar preguntas:', error);
        this.isLoading = false;
      }
    });
  }

  private buildForm(): void {
    const group: any = {};
    this.questions.forEach(question => {
      group['question_' + question.id] = [''];
    });
    this.form = this.formBuilder.group(group);
  }

  isStarQuestion(type: string): boolean {
    return type.toLowerCase() === 'star';
  }

  isTextareaQuestion(type: string): boolean {
    return type.toLowerCase() === 'textarea';
  }

  onStarSelect(questionId: number, value: number): void {
    this.form.get('question_' + questionId)?.setValue(value);
  }

  onSubmit(event: Event): void {
    event.preventDefault();
    if (this.form.valid) {
      console.log('Formulario enviado:', this.form.value);
    }
  }
}
