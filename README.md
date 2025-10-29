# INASE-Desafio

## Descripción
Aplicación para la gestión de muestras de semillas, la carga y consulta de resultados de análisis, y la visualización de reportes con filtros. Orientada a facilitar el seguimiento de todo el ciclo de vida de una muestra, desde el alta hasta la reportería.

## Funcionalidades
- Página de Samples (Muestras)
  - Alta y edición de muestras de semillas.
  - Visualización del detalle de cada muestra.
  - Carga y visualización de los resultados asociados a cada muestra desde la misma página.
- Reportes
  - Sección de reportería para consultar métricas y listados de muestras/resultados.
  - Filtrado por especie para focalizar los datos mostrados.

## Flujo de uso

### Inicio rápido
1) Construir y levantar los servicios en segundo plano:
```bash
docker-compose up --build -d
```
2) Verificar estado y logs:
```bash
docker-compose ps
docker-compose logs -f
```

### Acceso
- App (Samples): http://localhost:8080/samples  
- Desde la navegación de la app podés ir a la sección de Reportes.

### Flujo funcional
1) Crear muestra:
   - En “Samples”, seleccioná “Nueva muestra”, completá los campos obligatorios y guardá.
2) Cargar y consultar resultados:
   - En el detalle de la muestra, usá “Cargar resultados” para adjuntar datos/archivo. Los resultados quedan visibles en la misma vista.
3) Reportes con filtros:
   - Ingresá a “Reportes”, aplicá el filtro por especie y, si corresponde, combiná con otros filtros (fecha/estado). Visualizá la reportería consolidada.

### Comandos útiles
- Reiniciar con reconstrucción:
```bash
docker-compose up --build -d
```
- Detener servicios:
```bash
docker-compose down
```
- Limpiar (incluye volúmenes; borra datos persistidos):
```bash
docker-compose down -v
```
- Ver logs en tiempo real:
```bash
docker-compose logs -f
```
