import { Component, OnInit } from '@angular/core';
import { CategoriasService } from '../../services/categorias.service';
import { ProductosService } from '../../services/productos.service';
import { CategoriaModel } from '../../models/categoria.model';
import { ProductoModel } from '../../models/producto.model';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})
export class HomeComponent implements OnInit {
  categorias: CategoriaModel[] = [];
  productos:  ProductoModel[] = [];
  cargando = true;
  error: string | null = null;

  constructor(
    private categoriasSvc: CategoriasService,
    private productosSvc: ProductosService
  ) {}

  ngOnInit(): void {
    this.cargando = true;
    this.error = null;

    this.categoriasSvc.getCategorias().subscribe({
      next: c => this.categorias = c,
      error: e => this.error = 'Error cargando categorías'
    });

    this.productosSvc.getProductos().subscribe({
      next: p => { this.productos = p; this.cargando = false; },
      error: e => { this.error = 'Error cargando productos'; this.cargando = false; }
    });
  }
}
