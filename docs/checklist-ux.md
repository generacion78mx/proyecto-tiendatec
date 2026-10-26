# Hallazgos de TiendaTec (`docs/checklist-ux.md`)

Tareas evaluadas: (a) encontrar un producto de la categoría Periféricos, (b) abrir su ficha y regresar al catálogo, (c) agregar un producto nuevo. Recorridas en escritorio y en 375 px. Los hallazgos con prioridad "Sí" son los que se corrigen en el video.

| # | Heurística | Dónde ocurre | Sev. | Mejora (como acción) | Prioridad |
|---|---|---|---|---|---|
| 1 | H4 Consistencia y estándares | `producto-detalle` y `agregar-producto` no cargan `estilos.css` | 4 | Vincula `estilos.css` en todas las vistas | Sí |
| 2 | H1 Visibilidad del estado | Menú de todas las vistas: no indica en cuál estás | 3 | Marca la página actual con `aria-current` y un subrayado | Sí |
| 3 | H5 Prevención de errores y H10 Ayuda | Formulario: precio y existencias sin `required`, sin límites y sin texto de ayuda | 3 | Agrega `required`, `min` y `max`, y una línea de ayuda bajo cada campo | Sí |
| 4 | H3 Control y libertad | `producto-detalle`: solo se regresa con el menú | 3 | Agrega una ruta de migas de pan | No |
| 5 | H10 Ayuda y documentación | `contacto`: dice "Contáctanos" pero no da ningún medio | 3 | Agrega un correo de contacto | No |
| 6 | Accesibilidad: contraste | Hover del menú 2.80, etiqueta de categoría 3.83, "Ver detalle" 4.11, botón "Agregar producto +" 4.11 | 3 | Oscurece `--color-acento` a `#1f6a8a` y quita el color de hover del menú | Sí |
| 7 | H4 Consistencia (CSS) | Botón "Agregar producto +" sin relleno: `vac(` y `--espacio-base` mal escritos | 2 | Corrige los nombres para que usen `--espaciado-base` | No |
| 8 | H2 Lenguaje del usuario | Menú "Catálgo"; "detallle"; `alt` "Detalle de foto" en todas las imágenes | 2 | Corrige la ortografía y describe cada foto en su `alt` | No |
| 9 | H4 Consistencia | Todas las vistas repiten el `h1` "Bienvenido a Tienda Tec" | 2 | Escribe un `h1` que nombre la vista | No |
| 10 | Estructura del documento | Sin `<!DOCTYPE html>`, `lang`, `meta charset` ni `meta viewport` | 2 | Agrega los cuatro en todas las vistas | No |
| 11 | H8 Diseño minimalista | Pie de página pegado al borde y `<section>` sin cerrar en el formulario | 1 | Agrega `padding` al pie y cierra la sección | No |
| 12 | H1 Visibilidad del estado | Formulario: al enviar no hay confirmación (`action="#"`) | 3 | Se resuelve con servidor en U3; anótalo como pendiente | No |