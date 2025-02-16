import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { FormService } from '../services/form.service';

export interface FormQuestion {
  id: number;
  question: string;
  type: string;  
  options?: string[];
}

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
  questions: FormQuestion[] = [];
  isLoading: boolean = true;

  constructor(
    private route: ActivatedRoute, 
    private fb: FormBuilder,
    private formService: FormService
  ) {
    this.form = this.fb.group({});  // Inicializamos vacío porque se construirá dinámicamente
  }

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.token = params['token'] || '';
      if (this.token) {
        this.loadFormQuestions();
      }
    });
  }

  private loadFormQuestions(): void {
    this.formService.getFormQuestions(this.token).subscribe({
      next: (questions: FormQuestion[]) => {
        this.questions = questions;
        this.buildForm();
        this.isLoading = false;
      },
      error: (error) => {
        console.error('Error al cargar las preguntas:', error);
        this.isLoading = false;
      }
    });
  }

  private buildForm(): void {
    const group: any = {};
    this.questions.forEach(question => {
      let initialValue = '';
      
      if (question.type === 'estrella') {
        initialValue = '0';
      }
      
      group[`question_${question.id}`] = [initialValue];
    });
    this.form = this.fb.group(group);
  }

  onSubmit(event: Event): void {
    event?.preventDefault();
    if (this.form.valid) {
      console.log('Formulario enviado:', this.form.value);
    }
  }

  isStarQuestion(type: string): boolean {
    return type === 'estrella';
  }

  isTextareaQuestion(type: string): boolean {
    return type === 'textarea';
  }

  onStarSelect(questionId: number, value: number): void {
    this.form.get(`question_${questionId}`)?.setValue(value.toString());
  }
}
