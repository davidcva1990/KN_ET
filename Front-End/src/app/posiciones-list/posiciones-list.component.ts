import {Component, OnInit} from '@angular/core';
import {MatTableModule} from '@angular/material/table';
import { ServicioListadoService } from '../servicio-listado.service';


export interface PeriodicElement {
  name: string;
  position: number;
  weight: number;
  symbol: string;
}


/**
 * @title Basic use of `<table mat-table>`
 */
@Component({
  selector: 'app-posiciones-list',
  templateUrl: './posiciones-list.component.html',
  styleUrl: './posiciones-list.component.css',
  
})

export class PosicionesListComponent implements OnInit{

  data: any[] = [];

  constructor(private servicioListadoService: ServicioListadoService) { }

  ngOnInit(): void {
    this.obtenerPosiciones();
  }

  obtenerPosiciones() {
    this.servicioListadoService.obtenerDatos().subscribe(data => {
        this.data = data;
        console.log(this.data);
      },
      error => {
        console.error('Error al obtener las posiciones:', error);
      }
    );
  }

  displayedColumns: string[] = ['id', 'razonSocial', 'nombre', 'precio', 'moneda', 'fechaEntregaInicio'];
  dataSource = this.data;
}



/**  Copyright 2019 Google Inc. All Rights Reserved.
    Use of this source code is governed by an MIT-style license that
    can be found in the LICENSE file at http://angular.io/license */