import { TestBed } from '@angular/core/testing';

import { ServicioListadoService } from './servicio-listado.service';

describe('ServicioListadoService', () => {
  let service: ServicioListadoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ServicioListadoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
