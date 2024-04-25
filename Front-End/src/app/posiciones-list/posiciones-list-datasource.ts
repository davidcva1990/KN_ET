import { DataSource } from '@angular/cdk/collections';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { map } from 'rxjs/operators';
import { Observable, of as observableOf, merge } from 'rxjs';
import { modelposiciones } from './model';
import { ServicioListadoService } from '../servicio-listado.service'
/*
// TODO: Replace this with your own data model type
export interface PosicionesListItem {
  name: string;
  id: number;
}*/

// TODO: replace this with real data from your application
/*
const DATA: modelposiciones[] = [
  {id: 1, idEmpresa: 1, idProducto: 3, fechaEntregaInicio: '2024-04-05', moneda: 'ARS', precio: 25000},
  ];

*/

const DATA: modelposiciones[] = [];

/**
 * Data source for the PosicionesList view. This class should
 * encapsulate all logic for fetching and manipulating the displayed data
 * (including sorting, pagination, and filtering).
 */
export class PosicionesListDataSource extends DataSource<modelposiciones> {
  data: modelposiciones[] = [];
  paginator: MatPaginator | undefined;
  sort: MatSort | undefined;

  constructor (private servicioListadoService: ServicioListadoService) { 
    super();
  }

  /**
   * Connect this data source to the table. The table will only update when
   * the returned stream emits new items.
   * @returns A stream of the items to be rendered.
   */
  connect(): Observable<modelposiciones[]> {
    if (this.paginator && this.sort) {
      // Combine everything that affects the rendered data into one update
      // stream for the data-table to consume.
      return merge(observableOf(this.data), this.paginator.page, this.sort.sortChange)
        .pipe(map(() => {
          return this.getPagedData(this.getSortedData([...this.data ]));
        }));
    } else {
      throw Error('Please set the paginator and sort on the data source before connecting.');
    }
  }

  /**
   *  Called when the table is being destroyed. Use this function, to clean up
   * any open connections or free any held resources that were set up during connect.
   */
  disconnect(): void {}

  /**
   * Paginate the data (client-side). If you're using server-side pagination,
   * this would be replaced by requesting the appropriate data from the server.
   */
  private getPagedData(data: modelposiciones[]): modelposiciones[] {
    if (this.paginator) {
      const startIndex = this.paginator.pageIndex * this.paginator.pageSize;
      return data.splice(startIndex, this.paginator.pageSize);
    } else {
      return data;
    }
  }

  /**
   * Sort the data (client-side). If you're using server-side sorting,
   * this would be replaced by requesting the appropriate data from the server.
   */
  private getSortedData(data: modelposiciones[]): modelposiciones[] {
    if (!this.sort || !this.sort.active || this.sort.direction === '') {
      return data;
    }

    return data.sort((a, b) => {
      const isAsc = this.sort?.direction === 'asc';
      switch (this.sort?.active) {
        case 'id': return compare(+a.id, +b.id, isAsc);
        case 'idEmpresa': return compare(a.idEmpresa, b.idEmpresa, isAsc);
        case 'idProducto': return compare(a.idProducto, b.idProducto, isAsc);
        case 'fechaEntregaInicio': return compare(+a.fechaEntregaInicio, +b.fechaEntregaInicio, isAsc);
        case 'moneda': return compare(a.moneda, b.moneda, isAsc);
        case 'precio': return compare(a.precio, b.precio, isAsc);
        
        default: return 0;
      }
    });
  }
}

/** Simple sort comparator for example ID/Name columns (for client-side sorting). */
function compare(a: string | number, b: string | number, isAsc: boolean): number {
  return (a < b ? -1 : 1) * (isAsc ? 1 : -1);
}
