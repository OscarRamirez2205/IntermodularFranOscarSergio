import { Directive } from '@angular/core';
import { AbstractControl, NG_VALIDATORS, ValidationErrors, Validator } from '@angular/forms';

@Directive({
  selector: '[services-required]',
  standalone: true,
  providers: [{
    provide: NG_VALIDATORS,
    useExisting: ServicesRequiredValidatorDirective,
    multi: true
  }]
})
export class ServicesRequiredValidatorDirective implements Validator {
  validate(control: AbstractControl): ValidationErrors | null {
    const selectedServices = Object.values(control.value || {}).filter(value => value === true);
    return selectedServices.length === 0 ? { 'noServicesSelected': true } : null;
  }
}