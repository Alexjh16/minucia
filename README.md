# Documentación de Modelos y Relaciones — Proyecto Minucia

## Modelos Principales

El sistema está basado en tres modelos principales:

- **User** (Usuario)
- **Proveedor** (Proveedor)
- **Pieza** (Componente/Parte)

---

## Relaciones entre Modelos

### 1. User (Usuario)

- **Relación con Pieza:**  
  Un usuario puede registrar muchas piezas (`hasMany`).  
  ```php
  public function piezas()
  {
      return $this->hasMany(Pieza::class);
  }
  ```
- **Relación con Proveedor:**  
  Un usuario puede registrar muchos proveedores (`hasMany`).  
  ```php
  public function proveedores()
  {
      return $this->hasMany(Proveedor::class);
  }
  ```

**Justificación:**  
Esto permite auditar y asociar cada pieza y proveedor con el usuario que la registró, facilitando la trazabilidad y la gestión multiusuario.

---

### 2. Proveedor

- **Relación con User:**  
  Cada proveedor es registrado por un usuario (`belongsTo`).  
  ```php
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  ```

**Justificación:**  
Permite saber qué usuario creó cada proveedor, útil para permisos, auditoría y gestión de datos.

---

### 3. Pieza

- **Relación con Proveedor:**  
  Cada pieza pertenece a un proveedor (`belongsTo`).  
  ```php
  public function proveedor()
  {
      return $this->belongsTo(Proveedor::class);
  }
  ```
- **Relación con User:**  
  Cada pieza es registrada por un usuario (`belongsTo`).  
  ```php
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  ```

**Justificación:**  
Esto permite asociar cada pieza tanto con el proveedor que la suministra como con el usuario que la registró, lo que es fundamental para la trazabilidad y la gestión de inventario.

---

## Otras Decisiones de Diseño

- **$fillable:**  
  Se definen los campos que pueden ser asignados masivamente para proteger contra asignación masiva no deseada.
- **$casts:**  
  Se usan para asegurar que ciertos campos (como `cantidad`) siempre sean tratados como enteros.
- **$with:**  
  En el modelo `Pieza`, se cargan automáticamente las relaciones `proveedor` y `user` para optimizar las consultas y evitar el problema N+1.
- **Scopes personalizados:**  
  El scope `search` en `Pieza` permite búsquedas flexibles por código, nombre o descripción.

---

## Ventajas de esta Estructura

- **Escalabilidad:**  
  Permite agregar fácilmente más relaciones (por ejemplo, categorías, ubicaciones, etc.).
- **Seguridad:**  
  El uso de `$fillable` y relaciones bien definidas protege la integridad de los datos.
- **Trazabilidad:**  
  Siempre se puede saber quién creó o modificó cada registro.
- **Facilidad de uso:**  
  Las relaciones Eloquent simplifican las consultas y la manipulación de datos.

---

## Ejemplo de Uso

Obtener todas las piezas de un usuario:
```php
$user = User::find(1);
$piezas = $user->piezas;
```

Obtener el proveedor de una pieza:
```php
$pieza = Pieza::find(1);
$proveedor = $pieza->proveedor;
```

---

## Conclusión

La estructura de modelos y relaciones está pensada de manera sencilla.