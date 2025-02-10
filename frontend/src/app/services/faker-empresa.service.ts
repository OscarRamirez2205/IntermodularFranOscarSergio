import { Injectable } from '@angular/core';
import { faker } from '@faker-js/faker';
import { Empresa } from "../../../interfaces/Empresa";
import { GenerarEmpresas } from "./empresa.service";

@Injectable({ providedIn: 'root' })
export class FakerGenerarEmpresas extends GenerarEmpresas {
  private empresas: Empresa[];

  constructor() {
    super()
    this.empresas = Array.from({ length: 20 }, () => ({
      id: faker.string.uuid(),
      name: faker.company.name(),
      image: faker.image.avatar(),
      phone: faker.phone.number(),
      email: faker.internet.email(),
      address: {
        region: faker.address.state(),
        town: faker.address.city(),
        street: faker.address.streetAddress(),
        position: {
          lat: faker.location.latitude(),
          lng: faker.location.longitude(),
        },
      },
      openings: [
        {
          year: faker.date.recent().getFullYear(),
          count: faker.number.int({ min: 0, max: 10 }),
        },
      ],
      categories: [faker.commerce.department()],
      workingHours: {
        start: '08:00',
        end: '18:00',
      },
      score: {
        teacher: faker.number.int({ min: 0, max: 100 }),
        student: faker.number.int({ min: 0, max: 100 }),
      },
    }));
  }

  getEmpresas(): Promise<Empresa[]> {
    return Promise.resolve(this.empresas);
  }
}
