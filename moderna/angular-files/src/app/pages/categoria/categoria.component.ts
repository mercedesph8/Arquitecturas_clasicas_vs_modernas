import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductosService } from '../../services/productos.service';
import { CategoriasService } from '../../services/categorias.service';
import { ProductoModel } from '../../models/producto.model';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html'
})
export class CategoriaComponent implements OnInit {
  slug = '';
  nombreCategoria = 'Categoría';
  productos: ProductoModel[] = [];
  cargando = true;

  constructor(
    private route: ActivatedRoute,
    private productosSvc: ProductosService,
    private categoriasSvc: CategoriasService
  ) {}

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.slug = params.get('slug') ?? '';
      this.cargarDatos();
    });
  }

  private cargarDatos(): void {
    this.cargando = true;

    this.categoriasSvc.getCategorias().subscribe(cats => {
      const cat = cats.find(c => c.slug === this.slug);
      this.nombreCategoria = cat ? `Categoría: ${cat.nombre}` : 'Categoría no encontrada';
    });

    this.productosSvc.getProductosPorCategoria(this.slug).subscribe({
      next: prods => { this.productos = prods; this.cargando = false; },
      error: _ => { this.productos = []; this.cargando = false; }
    });
  }
}
